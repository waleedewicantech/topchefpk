<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include_once '../api/constants.php';
include_once '../api/caterer.php';
include_once '../api/menus.php';

function insertMenuBlock($menuObj,$menus){
    $menu_details = $menus->getMenuDetails($menuObj->menu_id);
    if($menu_details->status){
        echo '<div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title underline-menu">'.$menuObj->title.'</h4>
                <p style="text-align:right;">PRICE/HEAD:'.$menuObj->price.'</p>
                    <div class="card-text">
                        <table class="table table-borderless">';
                    echo '<tr>
                    <td>
                        <p class="item-head">Monday</p>
                        <p>'.$menu_details->items['monday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Tuesday</p>
                        <p>'.$menu_details->items['tuesday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Wednesday</p>
                        <p>'.$menu_details->items['wednesday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Thursday</p>
                        <p>'.$menu_details->items['thursday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Friday</p>
                        <p>'.$menu_details->items['friday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Saturday</p>
                        <p>'.$menu_details->items['saturday']['item_name'].'</p>
                    </td>
                </tr>';
                echo '<tr>
                    <td>
                        <p class="item-head">Sunday</p>
                        <p>'.$menu_details->items['sunday']['item_name'].'</p>
                    </td>
                </tr>';
            echo '</table>
            <p style="text-align:center;"><a class="href-btn" href="JavaScript:addMenuToCart('."'$menuObj->menu_id'".');">Add For Quote</a></p>

            </div>
        </div>
    </div>
</div>';
        return true;
    }
    return false;
}

$menus= new Menus();
$resp = $menus->getMenusByService('1','beemar_lunch');

$cateringMenus = array();

if($resp->status == true){
    $cateringMenus = $resp->menus;
}

for($i=0;$i<count($cateringMenus);$i++){

    insertMenuBlock($cateringMenus[$i],$menus);
}
