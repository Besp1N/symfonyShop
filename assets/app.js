const currentPath = window.location.pathname;
const isProductPage = /^\/\d+$/.test(currentPath);

import './styles/app.css';
import './scripts/home.js';
import './scripts/nav.js';

if (isProductPage) {
    import('./scripts/available_product.js')
        .then(() => {
            console.log('Skrypt available_product.js załadowany');
        })
        .catch(error => {
            console.error('Błąd podczas ładowania skryptu available_product.js:', error);
        });
}



