function redirectToSingleProduct(element) {
    var productName = element.dataset.name;
    var productPrice = element.dataset.price;
    var productImage = element.dataset.image;

    // Create a form dynamically
    var form = document.createElement("form");
    form.method = "post";
    form.action = "singproduct.php";

    // Add hidden fields for the data
    var nameInput = document.createElement("input");
    nameInput.type = "hidden";
    nameInput.name = "name";
    nameInput.value = productName;
    form.appendChild(nameInput);

    var priceInput = document.createElement("input");
    priceInput.type = "hidden";
    priceInput.name = "price";
    priceInput.value = productPrice;
    form.appendChild(priceInput);

    var imageInput = document.createElement("input");
    imageInput.type = "hidden";
    imageInput.name = "image";
    imageInput.value = productImage;
    form.appendChild(imageInput);

    // Add the form to the document and submit it
    document.body.appendChild(form);
    form.submit();
}

function redirectToSingleProductFromImage(imageElement) {
    var buttonParent = imageElement.parentElement;
    var productName = buttonParent.dataset.name;
    var productPrice = buttonParent.dataset.price;
    var productImage = buttonParent.dataset.image;

    // Create a form dynamically
    var form = document.createElement("form");
    form.method = "post";
    form.action = "singproduct.php";

    // Add hidden fields for the data
    var nameInput = document.createElement("input");
    nameInput.type = "hidden";
    nameInput.name = "name";
    nameInput.value = productName;
    form.appendChild(nameInput);

    var priceInput = document.createElement("input");
    priceInput.type = "hidden";
    priceInput.name = "price";
    priceInput.value = productPrice;
    form.appendChild(priceInput);

    var imageInput = document.createElement("input");
    imageInput.type = "hidden";
    imageInput.name = "image";
    imageInput.value = productImage;
    form.appendChild(imageInput);

    // Add the form to the document and submit it
    document.body.appendChild(form);
    form.submit();
}