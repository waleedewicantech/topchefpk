<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../api/constants.php';
include_once '../api/menus.php';

$menus= new Menus();

function generateMenuCategoryList($menus){
    $resp = $menus->getMenuCategories();
    $categories = $resp->categories;
    for($i=0;$i<count($categories);$i++){
        echo "<option value='".$categories[$i]->value."'>".$categories[$i]->text."</option>";
    }
}

function generateCateringMenuItems($menus){
    $resp = $menus->getCateringMenuItems();
    // echo json_encode($resp);
    $categories = $resp->items;
    for($i=0;$i<count($categories);$i++){
        echo "<option value='".$categories[$i]->value."'>".$categories[$i]->text."</option>";
    } 
}

function generateDaawatItems($menus){
    $resp = '';
}

switch($_GET['list']){
    case 'menu-category':
        generateMenuCategoryList($menus);
        break;
    case 'catering':
        generateCateringMenuItems($menus);
        break;
    default:
        echo '';
        break;    
}
?>