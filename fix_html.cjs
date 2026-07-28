const fs = require('fs');
let c = fs.readFileSync('resources/views/welcome.blade.php', 'utf8');

// The malformed class looks like this:
// class="group bg-white data-aos="fade-up" data-aos-delay="100" dark:bg-[#1e293b] ... "
// We need to extract the data-aos attributes and pull them out of the class.

c = c.replace(/class="([^"]*?)data-aos="fade-up" data-aos-delay="(\d+)"(.*?)"/g, 'data-aos="fade-up" data-aos-delay="$2" class="$1$3"');
c = c.replace(/class="([^"]*?)data-aos="fade-up"(.*?)"/g, 'data-aos="fade-up" class="$1$2"');

// Fix extra spaces
c = c.replace(/class="\s+/g, 'class="');

fs.writeFileSync('resources/views/welcome.blade.php', c, 'utf8');
console.log('Fixed malformed HTML in welcome.blade.php');
