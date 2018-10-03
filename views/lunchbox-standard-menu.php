<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../api/constants.php';

include_once '../api/caterer.php';
include_once '../api/menus.php';

function insertMenuBlock($menuObj,$menus){
    $menu_details = $menus->getMenuDetails($menuObj->menu_id);
    if($menu_details->status && count($menu_details->items)>0){
        echo '<div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title underline-menu">'.$menuObj->title.'</h4>
                <p style="text-align:right;">PRICE/HEAD:'.$menuObj->price.'</p>
                <div class="card-text">';
                for($i=0;$i<count($menu_details->items);$i++){
                    echo '<p>'.$menu_details->items[$i]->item_name.'</p>';
                }
                
                echo '
                    <p style="text-align:center;"><a class="href-btn" href="JavaScript:addMenuToCart('."'$menuObj->menu_id'".');">Add For Quote</a></p>
                </div>
            </div>
        </div>
        </div>';
    }
}

$menus= new Menus();
$resp = $menus->getMenusByService(1,'lunchbox');

$lunchBoxMenus = array();

if($resp->status == true){
    $lunchBoxMenus = $resp->menus;
}

for($i=0;$i<count($lunchBoxMenus);$i++){
    insertMenuBlock($lunchBoxMenus[$i],$menus);
}


?>