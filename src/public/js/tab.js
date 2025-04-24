document.addEventListener('DOMContentLoaded', function () {
  const tabLinks = document.querySelectorAll('.tab__button');
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
  const tabButtons = document.querySelectorAll('.tab__button');
  const tabContents = document.querySelectorAll('.item__inner');

  tabButtons.forEach(button => {
    button.addEventListener('click', function () {
      // 全てのタブボタンとコンテンツの active クラスを削除
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));

      // クリックされたタブボタンと対応するコンテンツに active クラスを追加
      this.classList.add('active');
      const tabContent = document.getElementById(this.getAttribute('data-tab'));
      tabContent.classList.add('active');
    });
  });
});
