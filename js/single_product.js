document.addEventListener("DOMContentLoaded", function() {
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
});
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
    var myCookie = getCookie("user");
    if (myCookie != "") {
        let productName = document.getElementById('pname').textContent;
        let productPrice = document.getElementById('price').textContent;
        let productSize = document.getElementById('size').value;
        let productQuantity = document.querySelector('input[type="number"]').value;

        const item = {
            productName: productName,
            productPrice: productPrice,
            productSize: productSize,
            productQuantity: productQuantity,
        };

        let cartItems = JSON.parse(localStorage.getItem("cartItems")) || {};

        const key = productName;

        if (cartItems[key]) {
            cartItems[key].productQuantity = productQuantity;
        } else {
            cartItems[key] = item;
        }

        localStorage.setItem("cartItems", JSON.stringify(cartItems));

        // Check if the user is logged in
        // Simulate a successful login (replace with your actual login logic)
        // For demonstration purposes, setTimeout is used here
        setTimeout(function() {
            // If login is successful, redirect to cart.php
            window.location.href = "cart.php";
        }, 2000); // Delay for 2 seconds (adjust as needed)

        showPopup();
    } else {
        // If user is not logged in, redirect to login.php
        document.cookie = "redirect_url=" + encodeURIComponent(window.location.href);
        window.location.href = "login.php";
    }
}
function updateProductDetails(name, price, description, imageData) {
    document.getElementById('MainImg').src = 'data:image/jpeg;base64,' + imageData;
    document.getElementById('ProductName').textContent = name;
    document.getElementById('ProductPrice').textContent = price;
    document.getElementById('ProductDescription').textContent = description;
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
