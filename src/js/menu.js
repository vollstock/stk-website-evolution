class Menu {
    "use strict";

    menu = null;
    menuButton = null;
    menuIcon = null;
    isActive = false;

    constructor() {
        this.menu = document.getElementById('mobile-menu');

        this.menuButton = document.getElementById('mobile-menu-button');
        this.menuButton.addEventListener('click', this.toggle.bind(this));
        
        this.menuIcon = this.menuButton.querySelector('svg');
    }

    toggle() {
        this.isActive = !this.isActive;
        this.isActive ? this.show() : this.hide();
    }

    show() {
        this.menu.classList.remove('opacity-0', 'pointer-events-none');
        this.menuIcon.classList.remove('rotate-180');
    }

    hide() {
        this.menu.classList.add('opacity-0', 'pointer-events-none');
        this.menuIcon.classList.add('rotate-180');
    }
}

