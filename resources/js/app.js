import './bootstrap';

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuButton && mobileMenu) {
        // Toggle menu on button click
        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !menuButton.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
        
        // Close menu when clicking a link inside it
        mobileMenu.querySelectorAll('a, button').forEach(item => {
            item.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }
});
