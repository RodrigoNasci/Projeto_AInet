/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project


//select color
document.getElementById('input-color').addEventListener('change', function () {
    var colorSelect = document.getElementById('input-color');
    var tshirtImage = document.getElementById('tshirt-color');
    tshirtImage.src = "/storage/tshirt_base/" + colorSelect.value + ".jpg";
    console.log(colorSelect.value);
});
