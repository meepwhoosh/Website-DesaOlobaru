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
            
            // Fix bg-slate-50 that was missed
            content = content.replace(/bg-slate-50(?! dark:)/g, 'bg-slate-50 dark:bg-[#141414]');
            
            // Also fix the bg-slate-100 on icons
            content = content.replace(/bg-slate-100(?! dark:)/g, 'bg-slate-100 dark:bg-white/5');
            
            // And bg-blue-50, green-50 etc if they missed dark mode
            content = content.replace(/bg-blue-50(?! dark:)/g, 'bg-blue-50 dark:bg-blue-900/30');
            content = content.replace(/bg-green-50(?! dark:)/g, 'bg-green-50 dark:bg-green-900/30');

            fs.writeFileSync(fullPath, content, 'utf8');
            console.log(`Updated ${fullPath}`);
        }
    }
}

traverseAndReplace(adminPath);
console.log('Done!');
