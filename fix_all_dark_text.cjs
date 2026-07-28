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

const viewsDir = path.join(__dirname, 'resources', 'views');

let updatedFiles = 0;

if (fs.existsSync(viewsDir)) {
    const files = walk(viewsDir);

    files.forEach(file => {
        let content = fs.readFileSync(file, 'utf8');
        let original = content;

        // Upgrade existing dark text to be brighter
        content = content.replace(/dark:text-slate-400/g, 'dark:text-slate-200');
        content = content.replace(/dark:text-slate-300/g, 'dark:text-white');
        content = content.replace(/dark:text-gray-400/g, 'dark:text-gray-200');
        content = content.replace(/dark:text-gray-300/g, 'dark:text-white');

        // Headings and strong text missing dark mode
        content = content.replace(/text-slate-900(?! dark:text-)/g, 'text-slate-900 dark:text-white');
        content = content.replace(/text-slate-800(?! dark:text-)/g, 'text-slate-800 dark:text-white');
        content = content.replace(/text-gray-900(?! dark:text-)/g, 'text-gray-900 dark:text-white');
        content = content.replace(/text-gray-800(?! dark:text-)/g, 'text-gray-800 dark:text-white');
        
        // Subheadings and muted text missing dark mode
        content = content.replace(/text-slate-500(?! dark:text-)/g, 'text-slate-500 dark:text-slate-200');
        content = content.replace(/text-slate-600(?! dark:text-)/g, 'text-slate-600 dark:text-slate-200');
        content = content.replace(/text-slate-700(?! dark:text-)/g, 'text-slate-700 dark:text-slate-100');
        content = content.replace(/text-gray-500(?! dark:text-)/g, 'text-gray-500 dark:text-gray-200');
        content = content.replace(/text-gray-600(?! dark:text-)/g, 'text-gray-600 dark:text-gray-200');
        content = content.replace(/text-gray-700(?! dark:text-)/g, 'text-gray-700 dark:text-gray-100');

        if (content !== original) {
            fs.writeFileSync(file, content, 'utf8');
            updatedFiles++;
        }
    });
}

console.log(`Successfully updated text colors in ${updatedFiles} files.`);
