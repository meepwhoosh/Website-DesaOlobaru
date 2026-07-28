const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(function(file) {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else {
            if (file.endsWith('.blade.php')) {
                results.push(file);
            }
        }
    });
    return results;
}

const adminDir = path.join(__dirname, 'resources', 'views', 'admin');
const files = walk(adminDir);

let changedFiles = 0;

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    let originalContent = content;

    // Fix Card Containers
    content = content.replace(/class="bg-white border border-slate-200/g, 'class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/5');
    
    // Fix Headings (Page titles)
    content = content.replace(/text-slate-900"/g, 'text-slate-900 dark:text-white"');
    content = content.replace(/text-slate-900([^"]+)"/g, 'text-slate-900 dark:text-white$1"');

    // Fix Subtitles / Labels
    content = content.replace(/text-slate-500"/g, 'text-slate-500 dark:text-slate-300"');
    content = content.replace(/text-slate-500([^"]+)"/g, 'text-slate-500 dark:text-slate-300$1"');
    
    content = content.replace(/text-slate-700"/g, 'text-slate-700 dark:text-slate-200"');
    content = content.replace(/text-slate-700([^"]+)"/g, 'text-slate-700 dark:text-slate-200$1"');

    content = content.replace(/text-slate-600"/g, 'text-slate-600 dark:text-slate-300"');
    content = content.replace(/text-slate-600([^"]+)"/g, 'text-slate-600 dark:text-slate-300$1"');

    // Fix Inputs & Selects & Textareas
    content = content.replace(/border-slate-200 focus:border-green-600/g, 'border-slate-200 dark:border-white/10 focus:border-green-600 dark:focus:border-green-500');
    // If input lacks dark background, add it. (Regex looks for text-slate-700 dark:text-slate-200 and adds bg-white dark:bg-[#0f0f0f] if not present)
    content = content.replace(/(<(?:input|textarea|select)[^>]+class="[^"]*)(text-slate-700 dark:text-slate-200)([^"]*)"/g, function(match, p1, p2, p3) {
        if (!match.includes('dark:bg-')) {
            return p1 + p2 + p3 + ' bg-white dark:bg-[#0f0f0f]"';
        }
        return match;
    });

    // Fix Tables
    content = content.replace(/bg-slate-50"/g, 'bg-slate-50 dark:bg-[#0f0f0f]"');
    content = content.replace(/bg-slate-50([^"]+)"/g, 'bg-slate-50 dark:bg-[#0f0f0f]$1"');
    content = content.replace(/border-b"/g, 'border-b dark:border-white/5"');
    content = content.replace(/border-b border-slate-100"/g, 'border-b border-slate-100 dark:border-white/5"');
    content = content.replace(/border-slate-100"/g, 'border-slate-100 dark:border-white/5"');
    content = content.replace(/hover:bg-slate-50"/g, 'hover:bg-slate-50 dark:hover:bg-[#222]"');

    // Prevent duplicated dark classes
    content = content.replace(/dark:text-white\s+dark:text-white/g, 'dark:text-white');
    content = content.replace(/dark:text-slate-300\s+dark:text-slate-300/g, 'dark:text-slate-300');
    content = content.replace(/dark:text-slate-200\s+dark:text-slate-200/g, 'dark:text-slate-200');
    content = content.replace(/dark:bg-\[\#1a1a1a\]\s+dark:bg-\[\#1a1a1a\]/g, 'dark:bg-[#1a1a1a]');
    content = content.replace(/dark:border-white\/5\s+dark:border-white\/5/g, 'dark:border-white/5');
    content = content.replace(/dark:bg-\[\#0f0f0f\]\s+dark:bg-\[\#0f0f0f\]/g, 'dark:bg-[#0f0f0f]');
    content = content.replace(/bg-white dark:bg-\[\#0f0f0f\] dark:bg-\[\#0f0f0f\]/g, 'bg-white dark:bg-[#0f0f0f]');

    if (content !== originalContent) {
        fs.writeFileSync(file, content);
        changedFiles++;
        console.log(`Updated: ${file}`);
    }
});

console.log(`Total files updated: ${changedFiles}`);
