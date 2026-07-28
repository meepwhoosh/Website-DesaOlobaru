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
            
            // Apply replacements
            content = content.replace(/text-slate-900/g, 'text-slate-900 dark:text-white');
            content = content.replace(/text-slate-800/g, 'text-slate-800 dark:text-white');
            content = content.replace(/text-slate-700/g, 'text-slate-700 dark:text-slate-300');
            content = content.replace(/text-slate-600/g, 'text-slate-600 dark:text-slate-400');
            content = content.replace(/text-slate-500/g, 'text-slate-500 dark:text-slate-400');
            
            content = content.replace(/bg-white(?!\/)/g, 'bg-white dark:bg-[#1a1a1a]');
            content = content.replace(/bg-slate-50(\/50)?(?! )/g, 'bg-slate-50$1 dark:bg-white/5');
            
            // Fix double darks just in case
            content = content.replace(/dark:text-white dark:text-white/g, 'dark:text-white');
            content = content.replace(/dark:text-slate-400 dark:text-slate-400/g, 'dark:text-slate-400');
            content = content.replace(/dark:text-slate-300 dark:text-slate-300/g, 'dark:text-slate-300');
            content = content.replace(/dark:bg-\[#1a1a1a\] dark:bg-\[#1a1a1a\]/g, 'dark:bg-[#1a1a1a]');
            content = content.replace(/dark:bg-white\/5 dark:bg-white\/5/g, 'dark:bg-white/5');

            content = content.replace(/border-slate-200/g, 'border-slate-200 dark:border-white/10');
            content = content.replace(/dark:border-white\/10 dark:border-white\/10/g, 'dark:border-white/10');

            content = content.replace(/divide-slate-200/g, 'divide-slate-200 dark:divide-white/10');
            content = content.replace(/dark:divide-white\/10 dark:divide-white\/10/g, 'dark:divide-white/10');
            
            content = content.replace(/hover:bg-slate-50/g, 'hover:bg-slate-50 dark:hover:bg-white/5');
            content = content.replace(/dark:hover:bg-white\/5 dark:hover:bg-white\/5/g, 'dark:hover:bg-white/5');
            
            // A specific fix for table headers:
            // "bg-slate-50 dark:bg-white/5 border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-400 uppercase tracking-wider"
            // Usually we want header bg to be #141414 like we did in pengunjung.
            // Let's replace "bg-slate-50 dark:bg-white/5 border-b" with "bg-slate-50 dark:bg-[#141414] border-b"
            content = content.replace(/bg-slate-50 dark:bg-white\/5 border-b/g, 'bg-slate-50 dark:bg-[#141414] border-b');

            fs.writeFileSync(fullPath, content, 'utf8');
            console.log(`Updated ${fullPath}`);
        }
    }
}

traverseAndReplace(adminPath);
console.log('Done!');
