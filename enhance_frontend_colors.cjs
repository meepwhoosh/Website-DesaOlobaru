const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

function enhanceColors(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            // Skip admin and auth
            if (!['admin', 'auth', 'components'].includes(file)) {
                enhanceColors(fullPath);
            }
        } else if (file.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;
            
            // 1. Fix typos
            content = content.replace(/text-slate-555/g, 'text-slate-600');
            
            // 2. Standardize Text Colors for better contrast
            // Headings / Main text
            content = content.replace(/text-slate-900(?! dark:)/g, 'text-slate-900 dark:text-white');
            content = content.replace(/text-slate-800(?! dark:)/g, 'text-slate-800 dark:text-slate-100');
            // Paragraphs / Subtext (Change dark:text-slate-400/500 to dark:text-slate-300 for readability)
            content = content.replace(/dark:text-slate-400/g, 'dark:text-slate-300');
            content = content.replace(/dark:text-slate-500/g, 'dark:text-slate-400');
            // Missing dark mode for slate-600, slate-500
            content = content.replace(/text-slate-600(?! dark:)/g, 'text-slate-600 dark:text-slate-300');
            content = content.replace(/text-slate-500(?! dark:)/g, 'text-slate-500 dark:text-slate-400');
            
            // 3. Standardize Backgrounds
            content = content.replace(/bg-slate-50(?!.*dark:bg-)/g, 'bg-slate-50 dark:bg-slate-900/50');
            // Ensure white backgrounds in dark mode become slate-800 or #1e293b
            content = content.replace(/bg-white(?!.*dark:bg-)/g, 'bg-white dark:bg-[#1e293b]');
            // Enhance existing dark:bg-slate-800 to look more premium
            content = content.replace(/dark:bg-slate-800/g, 'dark:bg-[#1e293b]');
            
            // 4. Standardize Borders
            content = content.replace(/border-slate-100(?!.*dark:border-)/g, 'border-slate-100 dark:border-slate-700/50');
            content = content.replace(/border-slate-200(?!.*dark:border-)/g, 'border-slate-200 dark:border-slate-700/50');
            
            // Enhance existing dark:border-slate-700
            content = content.replace(/dark:border-slate-700(?!(\/50))/g, 'dark:border-slate-700/50');
            content = content.replace(/dark:border-slate-800/g, 'dark:border-[#334155]/50');

            // 5. Standardize Accents (Green, Blue, Orange, Purple)
            const colors = ['green', 'blue', 'orange', 'purple', 'yellow'];
            colors.forEach(c => {
                // Backgrounds
                content = content.replace(new RegExp(`bg-${c}-50(?!.*dark:bg-)`, 'g'), `bg-${c}-50 dark:bg-${c}-900/20`);
                // Text
                content = content.replace(new RegExp(`text-${c}-700(?!.*dark:text-)`, 'g'), `text-${c}-700 dark:text-${c}-400`);
                content = content.replace(new RegExp(`text-${c}-800(?!.*dark:text-)`, 'g'), `text-${c}-800 dark:text-${c}-300`);
            });

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated ${fullPath}`);
            }
        }
    }
}

enhanceColors(viewsDir);
console.log('Done!');
