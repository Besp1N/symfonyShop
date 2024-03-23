const checkoutTotal = document.getElementById('checkout-total');


// Pobierz kontener dla opcji płatności
const methodContainer = document.querySelector('.checkout-method ul');

// Dodaj nasłuchiwanie zmian dla kontenera opcji płatności
methodContainer.addEventListener('change', function(event) {
    // Sprawdź, czy zdarzenie zostało spowodowane przez radio input
    if (event.target.type === 'radio' && event.target.checked) {
        console.log('Użytkownik wybrał metodę płatności:', event.target.value);
    }
});