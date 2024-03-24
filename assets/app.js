const currentPath = window.location.pathname;
const isProductPage = /^\/\d+$/.test(currentPath);
const isCheckoutPage = currentPath.endsWith('/cart/checkout');

import './styles/app.css';
import './scripts/home.js';
import './scripts/nav.js';

if (isCheckoutPage) {
    import('./scripts/checkout.js')
        .then(() => {
            console.log('Skrypt checkout.js został załadowany');
        })
        .catch(error => {
            console.error('Błąd podczas ładowania skryptu checkout.js:', error);
        });
}

if (isProductPage) {
    import('./scripts/available_product.js')
        .then(() => {
            console.log('Skrypt available_product.js został załadowany');
        })
        .catch(error => {
            console.error('Błąd podczas ładowania skryptu available_product.js:', error);
        });
}
