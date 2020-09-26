function toggleMenu() {
    var x = document.getElementById("navbarTop");
    if (x.className === "navbar-top") {
        x.className += " responsive";
    } else {
        x.className = "navbar-top";
    }
}