class Menu {
    "use strict";
    navbar = null;
    menu = null;
    menuButton = null;
    topLevelMenu = null;
    submenus = [];

    constructor() {
        // Get DOM references
        this.navbar = document.getElementById('navbar');
        this.menu = document.getElementById('mobile-menu');
        this.menuButton = document.getElementById('mobile-menu-button');
        this.topLevelItems = this.menu.querySelectorAll('.top-level-menu li a');
        this.submenus = this.menu.querySelectorAll('.submenu');

        // Add event listener to mobile button
        this.menuButton.addEventListener('click', this.toggle.bind(this), false);

        // Hide Header on on scroll down
        window.addEventListener("scroll", this.onScroll.bind(this), false);
    }

    toggle() {
        this.menu.classList.contains("is-active") ? this.hide() : this.show();
    }

    show() {
        this.menu.classList.add('is-active');
        document.getElementsByTagName("html")[0].classList.add('overflow-hidden', 'scrollbar-gutter-stable', 'bg-gray-50');
    }

    hide() {
        this.menu.classList.remove('is-active');
        document.getElementsByTagName("html")[0].classList.remove('overflow-hidden', 'scrollbar-gutter-stable', 'bg-gray-50');
    }

    onScroll() {
        // only on mobile
        if (window.matchMedia("(width >= 64rem)").matches) return;

        // only after 100px
        if (document.documentElement.scrollTop < 10) return;

        var st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > this.lastScrollTop) {
            this.navbar.classList.add('-top-24!');
        } else {
            this.navbar.classList.remove('-top-24!');
        }
        this.lastScrollTop = st;
    }

    openSubmenu(index, topLevelItem) {
        if (!Number.isInteger(index)) return;
        if (topLevelItem) topLevelItem.classList.add("is-active");
        this.menu.dataset.submenu = true;
        this.submenus[index].classList.add('translate-x-0!', 'shadow-2xl!');
    }

    closeSubmenu() {
        delete this.menu.dataset.submenu;
        this.submenus.forEach(submenu => submenu.classList.remove('translate-x-0!', 'shadow-2xl!'));
        setTimeout(() => {
            this.topLevelItems.forEach(submenu => submenu.classList.remove('is-active'));
        }, 100);
    }
}

