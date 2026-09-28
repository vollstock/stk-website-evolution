class Menu {
    "use strict";
    navbar = null;
    menu = null;
    menuButton = null;

    #lastScrollTop = 0;

    constructor() {
        // Get DOM references
        this.navbar = document.getElementById('navbar');
        this.menu = document.getElementById('mobile-menu');
        this.menuButton = document.getElementById('mobile-menu-button');

        // Add event listener to mobile button
        this.menuButton.addEventListener('click', this.toggle.bind(this));

        // Hide Header on on scroll down
        window.addEventListener("scroll", function () {
            // Only on mobile
            if (window.matchMedia("(width >= 64rem)").matches) return;

            var st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > this.lastScrollTop) {
                this.navbar.classList.add('-top-24!');
            } else {
                this.navbar.classList.remove('-top-24!');
            }
            this.lastScrollTop = st;
        }, false);
    }

    toggle() {
        this.menu.classList.contains("is-active") ? this.hide() : this.show();
    }

    show() {
        this.menu.classList.add('is-active');
        document.body.classList.add('overflow-hidden');
    }

    hide() {
        this.menu.classList.remove('is-active');
        document.body.classList.remove('overflow-hidden');
        // close submenu
    }

    submenu(index) {
        console.log("submenu", index);
    }
}

