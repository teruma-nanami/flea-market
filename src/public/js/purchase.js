document.addEventListener('DOMContentLoaded', function () {
  const paymentMethodSelect = document.getElementById('payment_method');
  const selectedPaymentMethod = document.getElementById('selected-payment-method');

  paymentMethodSelect.addEventListener('change', function () {
      const selectedOption = paymentMethodSelect.options[paymentMethodSelect.selectedIndex].text;
      selectedPaymentMethod.textContent = selectedOption;
  });
});
