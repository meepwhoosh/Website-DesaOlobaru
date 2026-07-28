const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else if (file.endsWith('.blade.php') || file.endsWith('.php')) {
            results.push(file);
        }
    });
    return results;
}

const viewsDirs = [
    path.join(__dirname, 'resources', 'views', 'admin'),
    path.join(__dirname, 'resources', 'views', 'components', 'admin')
];

let updatedFiles = 0;

viewsDirs.forEach(dir => {
    if (!fs.existsSync(dir)) return;
    const files = walk(dir);

    files.forEach(file => {
        let content = fs.readFileSync(file, 'utf8');
        let original = content;

        // Make inputs dark mode friendly if they aren't already
        content = content.replace(/(class="[^"]*w-full[^"]*rounded-[^"]*)/g, (match) => {
            // Only add if it looks like an input class string and doesn't already have dark mode
            if (!match.includes('dark:bg-')) {
                return match + ' dark:bg-slate-800 dark:text-white dark:border-slate-700';
            }
            return match;
        });

        if (content !== original) {
            fs.writeFileSync(file, content, 'utf8');
            updatedFiles++;
        }
    });
});

console.log(`Successfully updated inputs in ${updatedFiles} files.`);
