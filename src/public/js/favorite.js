document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.favorite__icon').forEach(function (element) {
    element.addEventListener('click', function () {
      this.closest('form').submit();
    });
  });
});
