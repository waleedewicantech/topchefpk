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
                <h4 class="card-title">'.$menuObj->title.'</h4>
                <p style="text-align:right;">PRICE/HEAD:'.$menuObj->price.'</p>
                <p class="card-text">';
                    for($i=0;$i<count($menu_details->items);$i++){
                        echo '<p>'.$menu_details->items[$i]->item_name.'</p>';
                    }
            echo '</p>
            <p style="text-align:center;"><a class="href-btn" href="JavaScript:addMenuToCart('."'$menuObj->menu_id'".');">Add For Quote</a></p>
            </div>
        </div>
        </div>';
        return true;
    }
    return false;
}

$menus= new Menus();
$resp = $menus->getMenusByService(1,'daawat');

$cateringMenus = array();

if($resp->status == true){
    $cateringMenus = $resp->menus;
}

$column= 1;

        echo "<h4 style=\" font-family:'Lucida Calligraphy',cursive\">Standard Menu</h4>";

for($i=0;$i<count($cateringMenus);$i++){
    if($column == 1){
        echo '<div class="row">';
    }
    if(insertMenuBlock($cateringMenus[$i],$menus)){$column++;}
    if($column > 2){
        echo '</div>';
        $column =1;
    }
}


?>