const razorpayKey = "rzp_live_w2kXRSqpLF6spT"; //rzp_live_w2kXRSqpLF6spT

function sendDataToServer(paymentID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // The response from PHP will be available in xhr.responseText
                console.log("Data successfully sent to PHP.");
                console.log("Response from PHP:", xhr.responseText);
                // Redirect to process_data.php after a successful response
                // window.location.replace("process_data.php?paymentID=" + encodeURIComponent(paymentID));
            } else {
                console.error("Error sending data to PHP.");
            }
        }
    };
    xhr.send("paymentID=" + encodeURIComponent(paymentID));
}

function initiateRazorpayPayment() {
    const cartSubTotal = parseFloat(localStorage.getItem("cartSubTotal")) || 0;
    const couponCode = document.getElementById("coupon-code").value;
    const isValidCoupon = validateCoupon(couponCode);

    let totalAmount = cartSubTotal;

    if (isValidCoupon) {
        const couponDiscount = calculateCouponDiscount(cartSubTotal, couponCode);
        totalAmount -= couponDiscount;
    }
    var totalAmountInRupees = parseFloat(document.getElementById('total').innerText.replace('₹', ''));
    var totalAmountInPaise = totalAmountInRupees * 100; // Convert to paise

    const options = {
        key: razorpayKey,
        amount: totalAmountInPaise, // Pass the updated total amount in paise
        currency: "INR",
        name: "Cara",
        description: "Payment for your order",
        image: "img/logo.png",
        handler: function (response) {
            const paymentID = response.razorpay_payment_id;
            clearCartDetails();

            // Extract the required transaction data and log it
            const transactionData = {
                payment_id: paymentID,
                name: razorpayUserName,
                email: razorpayUserEmail,
                contact: razorpayUserContact,
                address: razorpayUserAddress,
                // Include any other relevant data you want to log
            };
            
            
            showPopup(paymentID);
            // redirect_transaction();
        },
        prefill: {
            name: razorpayUserName,
            email: razorpayUserEmail,
            contact: razorpayUserContact,
            address: razorpayUserAddress,
        },
        theme: {
            color: "#007bff",
        },
        test: true,
    };

    const razorpayInstance = new Razorpay(options);
    razorpayInstance.open();
}

function showPopup(paymentID) {
    const popup = document.getElementById("paymentSuccessPopup");
    const paymentIDElement = document.getElementById("paymentID");
    paymentIDElement.textContent = paymentID;
    // var dataToSend = "Hello, PHP!";
    sendDataToServer(paymentID);


    popup.style.display = "block";
}

function closePopup() {
    const popup = document.getElementById("paymentSuccessPopup");
    popup.style.display = "none";
    // window.location.replace("http://localhost/charmi/transaction_log.php");
}

function clearCartDetails() {
    localStorage.removeItem("cartItems");
    localStorage.removeItem("cartSubTotal");
    localStorage.removeItem("total");

    document.getElementById("cart-items-body").innerHTML = "";
    document.getElementById("cart-subtotal").textContent = "₹ 0.00";
    document.getElementById("cart-shipping-fee").textContent = "Free";
    document.getElementById("total").textContent = "₹ 0.00";
    document.getElementById("coupon-discount").textContent = "₹ 0.00";
}
let discountedAmount = 0;

function applyCoupon() {
    const couponCode = document.getElementById("coupon-code").value;
    const isValidCoupon = validateCoupon(couponCode);

    if (isValidCoupon) {
        const cartSubTotal = parseFloat(localStorage.getItem("cartSubTotal")) || 0;

        // Calculate the coupon discount
        const couponDiscountPercentage = calculateCouponDiscount(cartSubTotal, couponCode);
        const couponDiscount = cartSubTotal * couponDiscountPercentage;

        // Calculate the discounted amount by subtracting the coupon discount
        discountedAmount = cartSubTotal - couponDiscount;

        // Update the total amount after applying the coupon discount
        document.getElementById("total").textContent = "₹ " + discountedAmount.toFixed(2);

        // Display the applied coupon and its discount
        document.getElementById("coupon-details-row").style.display = "table-row";
        document.getElementById("applied-coupon").textContent = couponCode;
        document.getElementById("coupon-discount-row").style.display = "table-row";
        document.getElementById("coupon-discount").textContent = "₹ " + couponDiscount.toFixed(2);

        // Save the new total discount in localStorage
        localStorage.setItem("couponDiscount", couponDiscount.toFixed(2));

        // Add the applied coupon to the list of applied coupons
        let appliedCoupons = JSON.parse(localStorage.getItem("appliedCoupons")) || [];
        if (!appliedCoupons.includes(couponCode)) {
            appliedCoupons.push(couponCode);
            localStorage.setItem("appliedCoupons", JSON.stringify(appliedCoupons));
        }
    } else {
        alert("Invalid coupon code.");
    }
}

function redirect_transaction() {
    window.location.href = "transaction_log.php";
}

function validateCoupon(couponCode) {
    // Replace this function with your coupon code validation logic
    // Example: Check the coupon code against a list of valid coupon codes
    const validCouponCodes = ["SUMMER10", "SAVE20", "FIRSTPURCHASE"];

    return validCouponCodes.includes(couponCode);
}

function calculateCouponDiscount(cartSubTotal, couponCode) {
    // Replace this function with your coupon discount calculation logic
    // Example: Based on the coupon code, calculate the discount percentage or amount
    // You can have a predefined set of discounts for different coupon codes
    if (couponCode === "SUMMER10") {
        return 0.10; // 10% discount
    } else if (couponCode === "SAVE20") {
        return 0.20; // ₹20 discount
    } else if (couponCode === "FIRSTPURCHASE") {
        return 0.30; // 30% discount
    } else {
        return 0; // No discount
    }
}
