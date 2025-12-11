// DARK MODE
document.getElementById("toggle-dark").addEventListener("click", () => {
    document.body.classList.toggle("dark");
    localStorage.setItem("darkMode", document.body.classList.contains("dark"));
});
if (localStorage.getItem("darkMode") === "true") {
    document.body.classList.add("dark");
}

// SIDEBAR COLLAPSE
document.getElementById("toggle-sidebar").addEventListener("click", () => {
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.querySelector(".main-content").classList.toggle("collapsed");

    localStorage.setItem("sidebarCollapsed",
        document.getElementById("sidebar").classList.contains("collapsed")
    );
});
if (localStorage.getItem("sidebarCollapsed") === "true") {
    document.getElementById("sidebar").classList.add("collapsed");
    document.querySelector(".main-content").classList.add("collapsed");
}
