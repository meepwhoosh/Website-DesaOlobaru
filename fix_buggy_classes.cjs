const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(dirPath);
    });
}

walkDir(path.join(__dirname, 'resources/views/admin'), function(filePath) {
    if (filePath.endsWith('.blade.php')) {
        let content = fs.readFileSync(filePath, 'utf8');
        let newContent = content;
        
        // Fix the specific buggy class string
        newContent = newContent.replace(/dark:bg-white\s+dark:bg-slate-900\/5/g, 'dark:bg-white/10');
        // Fix duplicate dark:text-white
        newContent = newContent.replace(/dark:text-white\s+dark:text-white/g, 'dark:text-white');
        
        // Also fix the case where it might be dark:bg-white dark:bg-slate-900/5/50
        newContent = newContent.replace(/dark:bg-white\s+dark:bg-slate-900\/5\/50/g, 'dark:bg-[#141414]');

        // If changed, write back
        if (content !== newContent) {
            fs.writeFileSync(filePath, newContent, 'utf8');
            console.log('Fixed:', filePath);
        }
    }
});
