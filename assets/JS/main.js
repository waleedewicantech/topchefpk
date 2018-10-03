function changeHeaderBackground(imgSrc) {
    $(".header").css("background-image", "url('" + imgSrc + "')");
}

function navigateTo(service, id, vendorName) {
    window.location.href = "./" + service + ".html?id=" + id + "&vendor=" + vendorName;
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}
$(document).ready(function() {
    $("#custom-menu-btn").click(function() {
        window.location.href = "./createMenu.html";
    });
});

function addMenuToCart(id) {
    // preventDefault();
    $.post("./api/router.php?method=addToCart&menu_id=" + id, function(data, status) {
        var resp = {};
        if (typeof data != 'object') {
            resp = JSON.parse(data);
        } else {
            resp = data;
        }
        if (resp.status == true) {
            var msg = "Successfully added to cart for quote.\n";
            msg += 'You can visit the cart by using the \"Request For Quote\" link at the bottom right of page';
            alert(msg);
        }
        return false;
    });
    return false;
}