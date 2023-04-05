function toggleMenuSidebar() {
    let sidebar = document.querySelector('#sidebar');
    let header__toggle_sidebar = document.querySelector('.header__toggle-sidebar');
    let sidebar__heading_menu = document.querySelector('.sidebar__heading-menu');
    let sidebar__heading_reports = document.querySelector('.sidebar__heading-reports');
    let sidebar__heading_charts = document.querySelector('.sidebar__heading-charts');

    sidebar.classList.toggle('active');
    header__toggle_sidebar.classList.toggle('active');
    sidebar__heading_menu.classList.toggle('active');
    sidebar__heading_reports.classList.toggle('active');
    sidebar__heading_charts.classList.toggle('active');
}
