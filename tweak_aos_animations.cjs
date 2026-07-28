const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

function tweakAos(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            if (!['admin', 'auth', 'components', 'layouts'].includes(file)) {
                tweakAos(fullPath);
            }
        } else if (file.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;

            // 1. Change section fade-up to fade-in to be less intrusive
            content = content.replace(/<section data-aos="fade-up"/g, '<section data-aos="fade-in"');

            // 2. Add stagger to loops (forelse/foreach)
            // It matches: @forelse($items as $item) \n <div data-aos="fade-up"
            content = content.replace(/(@forelse\([^)]+\)\s*<div\s*[^>]*data-aos="fade-up")(?!\s*data-aos-delay)/g, '$1 data-aos-delay="{{ $loop->iteration * 100 }}"');
            content = content.replace(/(@foreach\([^)]+\)\s*<div\s*[^>]*data-aos="fade-up")(?!\s*data-aos-delay)/g, '$1 data-aos-delay="{{ $loop->iteration * 100 }}"');
            
            // For welcome.blade.php specific staggering and directions
            if (file === 'welcome.blade.php') {
                // Feature cards staggered
                let delay = 100;
                content = content.replace(/<a href="[^"]*" class="group bg-white dark:bg-\[\#1e293b\][^"]*"/g, (match) => {
                    let repl = match.replace('group bg-white', `group bg-white data-aos="fade-up" data-aos-delay="${delay}"`);
                    delay += 100;
                    if(delay > 400) delay = 100;
                    return repl;
                });
                
                // Kades image & text
                content = content.replace(/<div class="w-full md:w-1\/3 flex justify-center/g, '<div data-aos="fade-right" class="w-full md:w-1/3 flex justify-center');
                content = content.replace(/<div class="w-full md:w-2\/3 space-y-6/g, '<div data-aos="fade-left" class="w-full md:w-2/3 space-y-6');

                // Office image & text
                content = content.replace(/<div class="lg:col-span-5 relative">/g, '<div data-aos="fade-right" class="lg:col-span-5 relative">');
                content = content.replace(/<div class="lg:col-span-7 space-y-6">/g, '<div data-aos="fade-left" class="lg:col-span-7 space-y-6">');
                
                // Stat grid stagger
                let statDelay = 100;
                content = content.replace(/<div class="pt-4 lg:pt-0">/g, (match) => {
                    let repl = `<div data-aos="fade-up" data-aos-delay="${statDelay}" class="pt-4 lg:pt-0">`;
                    statDelay += 100;
                    return repl;
                });
            }

            // For profil.blade.php specific
            if (file === 'profil.blade.php') {
                content = content.replace(/<div class="lg:col-span-4 space-y-4">/g, '<div data-aos="fade-right" class="lg:col-span-4 space-y-4">');
                content = content.replace(/<div class="lg:col-span-8 bg-white/g, '<div data-aos="fade-left" class="lg:col-span-8 bg-white');
                content = content.replace(/<div class="lg:col-span-5 space-y-6">/g, '<div data-aos="fade-right" class="lg:col-span-5 space-y-6">');
                content = content.replace(/<div class="lg:col-span-7 space-y-8">/g, '<div data-aos="fade-left" class="lg:col-span-7 space-y-8">');
            }

            // Remove nested data-aos="fade-up" if the parent is already a loop item with fade-up
            // Wait, I already added data-aos to `<article` or `<div class="group bg-white` manually via regex in the first script.
            content = content.replace(/(<article[^>]*)(class="group flex flex-col bg-white)/g, '$1data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}" $2');

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated ${file}`);
            }
        }
    }
}

tweakAos(viewsDir);
console.log('Done tweaking AOS');
