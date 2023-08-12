function updateCartTotals() {
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || {};
    let cartSubTotal = 0;

    document.getElementById("cart-items-body").innerHTML = "";

    for (const key in cartItems) {
        if (cartItems.hasOwnProperty(key)) {
            const item = cartItems[key];
            const productSubTotal = parseFloat(item.productPrice) * parseFloat(item.productQuantity);

            document.getElementById("cart-items-body").innerHTML += `
                <tr>
                    <td><button class="cart-remove-btn" onclick="removeFromCart('${key}')">Remove</button></td>
                    <td>${item.productName}</td>
                    <td>₹ ${item.productPrice}</td>
                    <td>${item.productSize}</td>
                    <td><input type="number" value="${item.productQuantity}" class="cart-quantity-input" onchange="updateCartItemQuantity('${key}', this.value)"></td>
                    <td>₹ ${productSubTotal.toFixed(2)}</td>
                </tr>
            `;
            5

            cartSubTotal += productSubTotal;
        }
    }
    const shipping = 0;
    const total = cartSubTotal + shipping;

    document.getElementById("cart-shipping-fee").textContent = shipping > 0 ? "Free" : "₹ 0.00";

    document.getElementById("cart-subtotal").textContent = "₹ " + cartSubTotal.toFixed(2);
    document.getElementById("total").textContent = "₹ " + total.toFixed(2);



    localStorage.setItem("cartSubTotal", cartSubTotal.toFixed(2));
    localStorage.setItem("total", total.toFixed(2));

}


function removeFromCart(productName) {
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || {};

    if (cartItems.hasOwnProperty(productName)) {
        delete cartItems[productName];
        localStorage.setItem("cartItems", JSON.stringify(cartItems));
        updateCartTotals();
    }
}

function updateCartItemQuantity(productName, quantity) {
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || {};

    if (cartItems.hasOwnProperty(productName)) {
        cartItems[productName].productQuantity = parseInt(quantity, 10);
        localStorage.setItem("cartItems", JSON.stringify(cartItems));
        updateCartTotals();
    }
}
function updateCartData(cartData) {
    document.getElementById('cart-data').value = JSON.stringify(cartData);
}

function openCheckoutPopup() {
    popup.style.display = 'flex';
    // Retrieve and set the cart data


    let cartData = JSON.parse(localStorage.getItem("cartItems")) || {};
    updateCartData(cartData);
}

document.addEventListener("DOMContentLoaded", function () {
    updateCartTotals();
});

