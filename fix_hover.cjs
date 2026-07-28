const fs = require('fs');
const path = require('path');

const adminPath = path.join(__dirname, 'resources', 'views', 'admin');

function traverseAndReplace(dir) {
    const files = fs.readdirSync(dir);
    
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            traverseAndReplace(fullPath);
        } else if (file === 'index.blade.php') {
            let content = fs.readFileSync(fullPath, 'utf8');
            
            // Fix the broken hover state
            content = content.replace(/hover:bg-slate-50 dark:bg-\[#141414\]/g, 'hover:bg-slate-50 dark:hover:bg-[#202020]');
            content = content.replace(/hover:bg-slate-50 dark:hover:bg-white\/5/g, 'hover:bg-slate-50 dark:hover:bg-[#202020]');
            content = content.replace(/hover:bg-slate-50 dark:bg-white\/5\/80/g, 'hover:bg-slate-50 dark:hover:bg-[#202020]');
            
            fs.writeFileSync(fullPath, content, 'utf8');
            console.log(`Updated ${fullPath}`);
        }
    }
}

traverseAndReplace(adminPath);
console.log('Done!');
