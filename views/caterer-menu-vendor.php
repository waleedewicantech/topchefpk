<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../api/constants.php';

include_once '../api/caterer.php';
include_once '../api/menus.php';

function insertMenuBlock($menuObj,$menus){
    $menu_details = $menus->getMenuDetails($menuObj->menu_id);
    if($menu_details->status && count($menu_details->items)>0){
        echo '<div class="col-sm-4">
        <span class="border border-white">
                <h2>'.$menuObj->title.'</h2>';
                    for($i=0;$i<count($menu_details->items);$i++){
                        echo '<h4>'.$menu_details->items[$i]->item_name.'</h4>';
                    }
            echo '<div class="btn-group float-right mt-2">
            <button href="kababjeesmenu.html" type="button" class="btn btn-info" position:"left">Request a Quote</button>
            </div>
            </span>
        </div>';
        return true;
    }
    return false;
}

$menus= new Menus();
$resp = $menus->getMenusByService($_GET['id'],'catering');

$cateringMenus = array();

if($resp->status == true){
    $cateringMenus = $resp->menus;
}

for($i=0;$i<count($cateringMenus);$i++){

    insertMenuBlock($cateringMenus[$i],$menus);
}


?>