document.addEventListener('DOMContentLoaded', function () {
  const tabLinks = document.querySelectorAll('.tab-link');
  const tabPanes = document.querySelectorAll('.tab-pane');

  tabLinks.forEach(link => {
      link.addEventListener('click', function () {
          // Remove active class from all tab links and tab panes
          tabLinks.forEach(link => link.classList.remove('active'));
          tabPanes.forEach(pane => pane.classList.remove('active'));

          // Add active class to the clicked tab link and corresponding tab pane
          this.classList.add('active');
          const tabPane = document.getElementById(this.getAttribute('data-tab'));
          tabPane.classList.add('active');
      });
  });
});
