document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.search;
    const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');

    sidebarLinks.forEach(link => {
        if (link.href.includes(currentPath) && currentPath !== "") {
            link.classList.add('active');
        }
    });
});