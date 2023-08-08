document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('checkout-form');
    const orderSummary = document.getElementById('order-summary');

    // Simulated products and prices
    const products = [
        { name: 'Product 1', price: 19.99 },
        { name: 'Product 2', price: 29.99 },
        // Add more products here
    ];

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;

        // Display order summary
        orderSummary.innerHTML = '';
        products.forEach(product => {
            const item = document.createElement('div');
            item.textContent = `${product.name}: $${product.price.toFixed(2)}`;
            orderSummary.appendChild(item);
        });
    });
});
