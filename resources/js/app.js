import './bootstrap';

import './shop-homepage'

//select color
document.getElementById('input-color').addEventListener('change', function () {
    var colorSelect = document.getElementById('input-color');
    var tshirtImage = document.getElementById('tshirt-color');
    tshirtImage.src = "/storage/tshirt_base/" + colorSelect.value + ".jpg";
    console.log(colorSelect.value);
});
