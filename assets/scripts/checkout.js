const checkoutTotal = document.getElementById('checkout-total');
const methodContainer = document.querySelector('.checkout-method ul');
let paymentMethod = "Credit Card";
const country = document.querySelector('.test');
const city = document.querySelector('input[placeholder="City"]');
const phoneNumber = document.querySelector('input[placeholder="Phone number"]');
const finalizeButton = document.getElementById('finalize-button');

const finalizeCard = document.getElementById('finalize-card');
const finalizeButtonContainer = document.getElementById('finalize-button-container');

const totalSpan = document.getElementById('total-span');
const paymentMethodSpan = document.getElementById('payment-method-span');
const countrySpan = document.getElementById('country-span');
const citySpan = document.getElementById('city-span');
const phoneNumberSpan = document.getElementById('phone-number-span');

methodContainer.addEventListener('change', function(event) {
    if (event.target.type === 'radio' && event.target.checked) {
        paymentMethod = event.target.value;
    }
});

finalizeButton.addEventListener('click', function () {
    finalizeCard.classList.remove('hidden-order');
    setTimeout(function() {
        finalizeCard.classList.add('show-order');

        totalSpan.innerText = checkoutTotal.innerText;
        paymentMethodSpan.innerText = paymentMethod;

        countrySpan.innerText = country.value;
        citySpan.innerText = city.value;
        phoneNumberSpan.innerText = phoneNumber.value;




        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }, 100);
});


