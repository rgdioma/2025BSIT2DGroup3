
document.addEventListener('DOMContentLoaded', function() {
 
    const menuButton = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
 
    menuButton.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });
   
    document.addEventListener('click', function(event) {
        const clickedInsideSidebar = sidebar.contains(event.target);
        const clickedMenuButton = menuButton.contains(event.target);
        
        if (!clickedInsideSidebar && !clickedMenuButton && sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        }
    });
});