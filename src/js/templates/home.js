// -----------------------------------------------------------------------------
// Hero scroll arrow
// -----------------------------------------------------------------------------

var scrollHint = document.getElementById("scroll-hint");
var scrollHintActive = true;

window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 10) {
        scrollHint.classList.add("opacity-0!", "-bottom-8!");
        scrollHintActive = false;
    } else if (document.documentElement.scrollTop <= 10) {
        scrollHint.classList.remove("opacity-0!", "-bottom-8!");
        scrollHintActive = true;
    }
});


// -----------------------------------------------------------------------------
// Blog carousel
// -----------------------------------------------------------------------------

var flkty = new Flickity('#blog-carousel', {
    contain: true
});