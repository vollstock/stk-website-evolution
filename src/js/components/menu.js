class Menu {
    menuItems;

    constructor() {
        this.element = document.querySelector("#navbar ul");
        this.items = this.element.querySelectorAll("li > button");

        // Array.prototype.forEach.call(this.menuItems, function (button, i) {

        //     button.addEventListener("pointerdown", function (event) {
        //         console.log(this);
        //         this.classList.toggle("is-open");
        //         //     this.setAttribute('aria-expanded', "true");

        //         // if (this.parentNode.className == "has-submenu") {
        //         //     this.parentNode.className = "has-submenu open";
        //         // } else {
        //         //     this.parentNode.className = "has-submenu";
        //         //     this.parentNode.querySelector('a').setAttribute('aria-expanded', "false");
        //         //     this.parentNode.querySelector('button').setAttribute('aria-expanded', "false");
        //         // }
        //         event.preventDefault();
        //     });
        // });
    }
}

var menu;
document.addEventListener('DOMContentLoaded', function () {
    menu = new Menu();
});
