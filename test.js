var menuObjCreated = {};
var submitToCart = function() {
    var itemsLength = Object.keys(menuObjCreated).length;
    if (itemsLength <= 0) {
        alert('your wishlist is empty');
        return;
    }

    var requestDetails = {
        menuText: prepareMenuTextFromObject(),
        contactDetails: prepareContactDetails()
    };

    $.post(
        "./api/sendMail.php", {
            receiver: 'khalidwaleed875@gmail.com',
            subject: 'new custom menu quote',
            message: requestDetails.menuText + requestDetails.contactDetails,
            key: '12jk123jk12kj3bn4h',
            htmlmail: true
        },
        function(result) {
            result = JSON.parse(result);
            if (result.status) {
                alert('your quote request has been sent');
                window.location.href = './home.html';
            } else {
                alert('server is currently down for maintainance');
            }
        }
    );
};


$(document).ready(function() {
    $('#request-cart').click(submitToCart);

    initializeMenuItemsList();
    $.post("./views/lists.php?list=menu-category", function(data, status) {
        $('#menuCategories').html(data);
    });

    $('#addItem').click(function(event) {
        var itemClicked = getClickedItem();
        if (!isMenuItemExists(itemClicked)) {
            addNewItem(itemClicked);
        }
    });

    $('#menuCategories').change(function(event) {
        initializeMenuItemsList();
    });
});

function initializeMenuItemsList() {
    var category = $('#menuCategories option:selected').val();
    category = !!category ? category : 'catering';
    $.post("./views/lists.php?list=" + category, function(data, status) {
        $('#menuItems').html(data);
    });
}

function getClickedItem() {
    var itemObject = {
        id: '',
        text: ''
    };

    itemObject.id = $('#menuItems option:selected').val();
    itemObject.text = $('#menuItems option:selected').text();

    return itemObject;
}

function addNewItem(itemToAdd) {
    var li = document.createElement("li");
    var t = document.createTextNode(itemToAdd.text);
    li.id = itemToAdd.id;
    li.appendChild(t);
    document.getElementById("myMenu").appendChild(li);
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    menuObjCreated[itemToAdd.id] = itemToAdd.text;
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);
    var close = document.getElementsByClassName('close');
    for (i = 0; i <
        close.length; i++) {
        close[i].onclick = removeMenuItemFromCart;
    }
    // console.log(menuObjCreated);
}

var removeMenuItemFromCart = function() {
    var itemid = $(this).parent().attr('id');
    delete menuObjCreated[itemid];
    var div = this.parentElement;
    div.style.display = "none";
    // console.log(menuObjCreated);
}

function isMenuItemExists(itemObject) {
    var id = itemObject.id;
    if (!!menuObjCreated && (menuObjCreated.hasOwnProperty(id) || !!menuObjCreated[id])) {
        alert('The menu item you are trying to add is already in your wishlist.');
        return true;
    } else {
        return false;
    }
}

function prepareMenuTextFromObject() {
    var type = $('#menuCategories option:selected').text();
    var persons = $('#persons').val();

    if (isNaN(persons) || (!isNaN(persons) && parseInt(persons) <= 0)) {
        alert('invalid number of persons entered');
        return;
    }
    var text = '<h4> Menu Details</h4>';
    text += '<p>Menu Type ordered ' + type + '</p>';
    text += '<p> Number of persons ' + persons + '</p>';
    text += '<ul>';
    for (var i in menuObjCreated) {
        text += '<li>' + menuObjCreated[i] + '</li>';
    }
    text += '</ul>';
    return text;
}

function prepareContactDetails() {
    var contactDetails = {
        name: $('#contact-name').val(),
        phone: $('#contact-phone').val(),
        email: $('#contact-email').val(),
        msg: $('#contact-msg').val()
    };

    var text = '<h4>Customer Details</h4>';
    text += '<p> Name:      : ' + contactDetails.name + '</p>';
    text += '<p> Contact No : ' + contactDetails.phone + '</p>';
    text += '<p> Email      : ' + contactDetails.email + '</p>';
    text += '<p> msg        : ' + contactDetails.msg + '</p>';
    return text;
}