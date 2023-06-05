import './bootstrap';

import './shop-homepage'

//select color
document.getElementById('input-color').addEventListener('change', function() {
    var colorSelect = document.getElementById('input-color');
    var tshirtImage = document.getElementById('tshirt-color');
    tshirtImage.src = colorSelect.value;
    console.log(colorSelect.value);
});
