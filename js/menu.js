function toggleMenu(element) {
    var target = document.getElementById(element.getAttribute("aria-controls"));

    if (!target) {
        return;
    }

    var selected = target.getAttribute("aria-selected") === "true";

    target.setAttribute("aria-selected", !selected);
    target.setAttribute("aria-hidden", selected);
}
