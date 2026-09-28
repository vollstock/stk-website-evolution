class Menu {
    "use strict";

    menu = null;
    menuButton = null;

    constructor() {
        this.menu = document.getElementById('mobile-menu');

        this.menuButton = document.getElementById('mobile-menu-button');
        this.menuButton.addEventListener('click', this.toggle.bind(this));
    }

    toggle() {
        this.menu.classList.toggle('is-active');
        document.body.classList.toggle('overflow-hidden', this.menu.classList.contains("is-active"));
    }

    show() {
        this.menu.classList.remove('is-active');
        document.body.classList.remove('overflow-hidden');
    }

    hide() {
        this.menu.classList.add('is-active');
        document.body.classList.add('overflow-hidden');
    }
}

