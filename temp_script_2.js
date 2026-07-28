
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const themeTextMobile = document.getElementById('theme-text-mobile');

            // Set initial icon based on current theme
            if (document.documentElement.classList.contains('dark')) {
                lightIcon?.classList.remove('hidden');
                if (themeTextMobile) themeTextMobile.textContent = 'Mode Terang';
            } else {
                darkIcon?.classList.remove('hidden');
                if (themeTextMobile) themeTextMobile.textContent = 'Mode Gelap';
            }

            function toggleTheme() {
                darkIcon?.classList.toggle('hidden');
                lightIcon?.classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    if (themeTextMobile) themeTextMobile.textContent = 'Mode Gelap';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    if (themeTextMobile) themeTextMobile.textContent = 'Mode Terang';
                }
            }

            themeToggleBtn?.addEventListener('click', toggleTheme);
            themeToggleMobileBtn?.addEventListener('click', toggleTheme);
        });
    