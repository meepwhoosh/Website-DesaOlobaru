const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

function addAos(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            // Skip admin, layouts, components directories
            if (!['admin', 'layouts', 'components', 'auth'].includes(file)) {
                addAos(fullPath);
            }
        } else if (file.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;
            
            // Add to <section>
            content = content.replace(/(<section\s+)(?!.*data-aos)(class="[^"]*")/g, '$1data-aos="fade-up" $2');
            
            // Add to grid layouts that are main containers
            content = content.replace(/(<div\s+)(?!.*data-aos)(class="grid\s+(?:grid-cols-[^"]*)\s+gap-[^"]*")/g, '$1data-aos="fade-up" $2');
            
            // Add to standard white cards
            content = content.replace(/(<div\s+)(?!.*data-aos)(class="bg-white\s+dark:bg-slate-800[^"]*rounded-[^"]*")/g, '$1data-aos="fade-up" $2');
            
            // For specifically <div class="bg-gradient... (like Visi Misi box)
            content = content.replace(/(<div\s+)(?!.*data-aos)(class="bg-gradient-to-br[^"]*rounded-3xl[^"]*")/g, '$1data-aos="fade-up" $2');

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated ${file}`);
            }
        }
    }
}

addAos(viewsDir);
console.log('Done!');
