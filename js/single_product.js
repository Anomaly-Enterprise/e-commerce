var MainImg = document.getElementById("MainImg");
var smallimg = document.getElementsByClassName("small-img");
var valid;

smallimg[0].onclick = function () {
    MainImg.src = smallimg[0].src;
}

smallimg[1].onclick = function () {
    MainImg.src = smallimg[1].src;
}

smallimg[2].onclick = function () {
    MainImg.src = smallimg[2].src;
}

smallimg[3].onclick = function () {
    MainImg.src = smallimg[3].src;
}
function getCookie(username) {
    let name = username + "=";
    let spli = document.cookie.split(';');
    for (var j = 0; j < spli.length; j++) {
        let char = spli[j];
        while (char.charAt(0) == ' ') {
            char = char.substring(1);
        }
        if (char.indexOf(name) == 0) {
            return char.substring(name.length, char.length);
        }
    }
    return "";
}
function addToCart() {
    var myCoookie = getCookie("user");
    if (myCoookie != "") {
        let productName = document.getElementById('pname').textContent;
        let productPrice = document.getElementById('price').textContent;
        let productSize = document.getElementById('size').value;
        let productQuantity = document.querySelector('input[type="number"]').value;

        // Construct the item object with product details
        const item = {
            productName: productName,
            productPrice: productPrice,
            productSize: productSize,
            productQuantity: productQuantity,
        };

        // Get the existing cart items from localStorage or create an empty object
        let cartItems = JSON.parse(localStorage.getItem("cartItems")) || {};

        // Use the product name as the key for the cart item
        const key = productName;

        // Check if the product is already in the cart
        if (cartItems[key]) {
            // Update the quantity if the product is already in the cart
            cartItems[key].productQuantity = productQuantity;
        } else {
            // Add the new product to the cart
            cartItems[key] = item;
        }

        // Save the updated cart items to localStorage
        localStorage.setItem("cartItems", JSON.stringify(cartItems));

        // Redirect to cart.php
        // window.location.href = "cart.php";
        // alert("Product added to the Cart");
        showPopup();
    } else {
        window.location.href = "login.php";
    }
}


function redirect() {
    window.location.href = "cart.php";
}
function showPopup() {
    var popup = document.getElementById("customPopup");
    popup.style.display = "block";
}

function closePopup() {
    var popup = document.getElementById("customPopup");
    popup.style.display = "none";
}
