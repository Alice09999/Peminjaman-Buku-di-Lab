document.addEventListener('DOMContentLoaded', function() {
    var hamburger = document.querySelector('.sl-hamburger');
    var mobileMenu = document.querySelector('.sl-mobile-menu');
    var overlay = document.querySelector('.sl-mobile-overlay');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.toggle('open');
            if (overlay) {
                overlay.style.display = mobileMenu.classList.contains('open') ? 'block' : 'none';
            }
        });

        if (overlay) {
            overlay.addEventListener('click', function() {
                mobileMenu.classList.remove('open');
                overlay.style.display = 'none';
            });
        }
    }

    var toggleBtns = document.querySelectorAll('.sl-password-toggle');
    toggleBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var input = this.closest('.sl-password-wrap').querySelector('input');
            var icon = this.querySelector('.material-symbols-outlined');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        });
    });
});
