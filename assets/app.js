const currentPath = window.location.pathname;
const isProductPage = /^\/\d+$/.test(currentPath);
const isCheckoutPage = currentPath === '/checkout';

import './styles/app.css';
import './scripts/home.js';
import './scripts/nav.js';


if (isCheckoutPage) {
    import ('./scripts/checkout.js')
        .then(() => {
            console.log('Skrypt /scripts/checkout.js załadowany');
        })
        .catch(error => {
            console.error('Błąd podczas ładowania skryptu /scripts/checkout.js:', error);
        });
}

if (isProductPage) {
    import('./scripts/available_product.js')
        .then(() => {
            console.log('Skrypt available_product.js załadowany');
        })
        .catch(error => {
            console.error('Błąd podczas ładowania skryptu available_product.js:', error);
        });
}



