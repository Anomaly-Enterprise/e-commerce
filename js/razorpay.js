const razorpayKey = "rzp_live_djCjHAESCY14an"; // rzp_live_djCjHAESCY14an
function initiateRazorpayPayment() {

    const cartSubTotal = parseFloat(localStorage.getItem("cartSubTotal")) || 0;
    const couponCode = document.getElementById("coupon-code").value;
    const isValidCoupon = validateCoupon(couponCode);

    let totalAmount = cartSubTotal;

    if (isValidCoupon) {
        const couponDiscount = calculateCouponDiscount(cartSubTotal, couponCode);
        totalAmount -= couponDiscount;
    }
    
    // Create a cartDetails object with subtotal and total
    const cartDetails = {
        subtotal: cartSubTotal,
        total: totalAmount
    };

    var totalAmountInRupees = parseFloat(document.getElementById('total').innerText.replace('₹', ''));
    var totalAmountInPaise = totalAmountInRupees * 100; // Convert to paise
    var testTotal = document.getElementById('total').innerHTML.replace('₹','');
    var coupon = document.getElementById('applied-coupon').innerHTML;
    // Retrieve cart data from localStorage
    const cartData = JSON.parse(localStorage.getItem("cartItems")) || {};

    const options = {
        key: razorpayKey,
        amount: totalAmountInPaise,
        currency: "INR",
        name: "Cara",
        description: "Payment for your order",
        image: "img/logo.png",
        handler: function (response) {
            const paymentID = response.razorpay_payment_id;
            clearCartDetails();

            // Pass cartData and cartDetails to the showPopup function
            showPopup(paymentID, cartData, cartDetails, testTotal, coupon);
            // console.log(response);
            // window.location.href = "shop.php ";

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
        test: false,
    };

    const razorpayInstance = new Razorpay(options);
    // updateAddress();
    razorpayInstance.open();
}

function showPopup(paymentID, cartDataParam, cartDetails, testTotal, coupon) {
    const popup = document.getElementById("paymentSuccessPopup");
    const paymentIDElement = document.getElementById("paymentID");
    const trans_id = document.getElementById("trans_detail");
    const trans_status = document.getElementById("tran_status");

    // paymentIDElement.textContent = paymentID;
    // trans_id.textContent = paymentID;

    // trans_status.style.display = "block";
    // trans_id.style.display = "block";

    // Convert the cartDataParam array to JSON string
    const encodedCartData = encodeURIComponent(JSON.stringify(cartDataParam));
    const ajaxData = {
        paymentID: paymentID,
        subtotal: cartDetails.subtotal,
        cart_data_for_php: encodedCartData,
        test_total: testTotal,
        coupon: coupon
    };

    // Make an AJAX request to the processing script using POST
    if (typeof previousAjaxRequest !== "undefined" && previousAjaxRequest !== null) {
        previousAjaxRequest.abort();
    }

    // Make an AJAX request to the processing script using POST
    const currentAjaxRequest = $.ajax({
        type: "POST",
        url: "checkouttest.php", // Replace with the correct URL of your main processing script
        data: ajaxData,
        success: function(response) {
            // Process the response if needed
            console.log(response);
            window.location.replace("profile.php");
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error if needed
        }
    });

    // Store the current AJAX request to cancel it if necessary
    previousAjaxRequest = currentAjaxRequest;
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
