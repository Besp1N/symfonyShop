const size = document.getElementById('size');
const name = document.getElementById('product_name');
const stock = document.getElementById('stock');
const addToCartBtn = document.getElementById('add-to-cart-btn');
const buyNowBtn = document.getElementById('buy-now-btn');

isProductAvailable(size.value, name.value);
size.addEventListener('change', function () {
    isProductAvailable(size.value, name.value);
});
async function isProductAvailable(size, name) {
    try {
        const response = await fetch(`/api/available?size=${size}&name=${name}`);
        const data = await response.json();
        if (data.isAvailable) {
            stock.innerText = `Size ${size}: Available `;
            stock.classList.remove('not-available');
            stock.classList.add('available');
            addToCartBtn.disabled = false;
            buyNowBtn.disabled = false;
        } else {
            stock.innerText = `Size ${size}: Not Available`;
            stock.classList.remove('available');
            stock.classList.add('not-available');
            addToCartBtn.disabled = true;
            buyNowBtn.disabled = true;
        }
    } catch (error) {
        console.error('Wystąpił błąd:', error);
    }
}




