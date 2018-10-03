var menuObjCreated = {};

// var requestDetails = {
//     menuText: prepareMenuTextFromObject(),
//     contactDetails: prepareContactDetails()
//};

function initializeMenuItemsList() {

    var menuResp = {
        // status: true,
        // menus: [
        //     { title: 'title1', price: '123.32', id: 1, total: 0 },
        //     { title: 'title2', price: '222.22', id: 2, total: 0 },
        //     { title: 'title3', price: '444.44', id: 3, total: 0 }
        // ],
        // total: 123
    }

    $.post("./api/router.php?method=getCart", function(data, status) {
        var respJSON = {}
        if (typeof data != "object") {
            respJSON = JSON.parse(data);
        } else {
            respJSON = data;
        }

        if (respJSON.status) {
            menuResp = respJSON;

        }

        for (var i = 0; i < menuResp.menus.length; i++) {
            var menu = menuResp.menus[i];
            createCartEntryForMenu(menu);
            attachEventsToControls();
        }

        appendTotalLineToCart();
        calculateTotal();
    });
}

function appendTotalLineToCart() {
    var menuRowTextHtml = '<td></td>';
    menuRowTextHtml += '<td style="padding:0.5em;"></td>';
    menuRowTextHtml += '<td class="middle-cell"></td>';
    menuRowTextHtml += '<td><b id="total">0</b></td>';
    var tr = document.createElement("tr");
    tr.innerHTML = menuRowTextHtml;
    document.getElementById("myMenu").appendChild(tr);
};

function attachEventsToControls() {
    var close = document.getElementsByClassName('menu-remover');
    for (i = 0; i < close.length; i++) {
        close[i].onclick = removeMenuItemFromCart;
    }

    var personsInput = document.getElementsByClassName('invisible-textbox');
    for (var i = 0; i < personsInput.length; i++) {
        personsInput[i].onchange = adjustMenuObject;
    }
}

function createCartEntryForMenu(menu) {
    var menuRowTextHtml = '<td><span class="menu-remover">X</span></td>';
    menuRowTextHtml += '<td style="padding:0.5em;">' + menu.title + '</td>';
    menuRowTextHtml += '<td class = "middle-cell">';
    menuRowTextHtml += '<input class= "invisible-textbox" placeholder="enter number.." type= "number">';
    menuRowTextHtml += '</td>';
    menuRowTextHtml += '<td id="price-' + menu.id + '">' + menu.price + ' </td>';
    var tr = document.createElement("tr");
    tr.id = menu.id;
    tr.innerHTML = menuRowTextHtml;
    document.getElementById("myMenu").appendChild(tr);
    menuObjCreated[menu.id] = { title: menu.title, persons: 0, price: menu.price };
}

var removeMenuItemFromCart = function() {
    var itemid = $(this).parent().parent().attr('id');
    delete menuObjCreated[itemid];
    var div = this.parentElement.parentElement;
    div.style.display = "none";
    calculateTotal();
    // console.log(menuObjCreated);
};

var adjustMenuObject = function() {
    var inputVal = $(this).val();
    if (!inputVal || isNaN(inputVal)) {
        inputVal = 0;
        $(this).val(0);
    }
    var itemid = $(this).parent().parent().attr('id');
    menuObjCreated[itemid].persons = inputVal;
    console.log('changed', menuObjCreated[itemid]);
    var menutotal = parseFloat(parseInt(inputVal) * parseFloat(menuObjCreated[itemid].price)).toFixed(2);
    menuObjCreated[itemid].total = menutotal;
    console.log(menuObjCreated);
    $('#price-' + itemid).text(menutotal);
    calculateTotal();
};

function calculateTotal() {
    var total = 0.00;
    for (var i in menuObjCreated) {
        total += !isNaN(menuObjCreated[i].total) ? parseFloat(menuObjCreated[i].total) : 0.00;
    }
    menuObjCreated.total = parseFloat(total).toFixed(2);
    $('#total').text(total);
}

$(document).ready(function() {
    initializeMenuItemsList();
});