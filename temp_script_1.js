
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-icon-open');
            const closeIcon = document.getElementById('menu-icon-close');
            const header = document.getElementById('main-header');

            menuBtn.addEventListener('click', function () {
                // Toggle Menu Visibility
                mobileMenu.classList.toggle('hidden');
                
                // Toggle Icon
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Sticky Header Effect on Scroll
            window.addEventListener('scroll', function () {
                if (window.scrollY > 20) {
                    header.classList.add('shadow-md');
                    header.classList.remove('shadow-sm');
                } else {
                    header.classList.add('shadow-sm');
                    header.classList.remove('shadow-md');
                }
            });
        });
    