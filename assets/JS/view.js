function getStandardCateringMenus() {
    $.post("./views/catering-standard-menu.php", function(data, status) {
        $('#standard-menu').html(data);
    });
}

function getStandardDaawatMenus() {
    $.post("./views/daawat-standard-menu.php", function(data, status) {
        $('#standard-menu').html(data);
    });
}

function getVendorsListForCatering() {
    $.post("./views/catering-vendor-list.php", function(data, status) {
        $('#vendor-menu-list').html(data);
    });
}

function getVendorsListForDaawat() {
    $.post("./views/daawat-vendor-list.php", function(data, status) {
        $('#vendor-menu-list').html(data);
    });
}

function getLunchBoxesStandard() {
    $.post("./views/lunchbox-standard-menu.php", function(data, status) {
        $('#lunchbox-menu-list').html(data);
    });
}

function getCateringMenusByVendor() {
    var catererId = getUrlParameter('id');
    var vendor = getUrlParameter('vendor');
    if (!!vendor) {
        $('#vendor-title').html(vendor);
    }
    if (!!catererId) {
        $.post("./views/caterer-menu-vendor.php?id=" + catererId, function(data, status) {
            $('#caterer-menu-container').html(data);
        });

    } else {
        var data = "<h3 style=\"color:white;\">Something Went Wrong try reloading the page or revisiting the page through the link</h3>";
        $('#caterer-menu-container').html(data);
    }
}

function getWeeklyBreakfastMenus() {
    $.post("./views/picks-breakfast.php", function(data, status) {
        $('#pickmenus').html(data);
    });
}

function getWeeklyLunchMenus() {
    $.post("./views/picks-lunch.php", function(data, status) {
        $('#pickmenus').html(data);
    });
}

function getWeeklyDinnerMenus() {
    $.post("./views/picks-dinner.php", function(data, status) {
        $('#pickmenus').html(data);
    });
}

function getWeeklyPatientsDinnerMenus() {
    $.post("./views/patients-dinner.php", function(data, status) {
        $('#patientsmenus').html(data);
    });
}

function getWeeklyPatientsBreakfastMenus() {
    $.post("./views/patients-breakfast.php", function(data, status) {
        $('#patientsmenus').html(data);
    });
}

function getWeeklyPatientsLunchMenus() {
    $.post("./views/patients-lunch.php", function(data, status) {
        $('#patientsmenus').html(data);
    });
}

function getMonthlyPicksMenus() {
    $.post("./views/picks-monthly.php", function(data, status) {
        $('#pickmenus').html(data);
    });
}

function getWeeklyPatientsMonthlyMenus() {
    $.post("./views/patients-monthly.php", function(data, status) {
        $('#patientsmenus').html(data);
    });
}