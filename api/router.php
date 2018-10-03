<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'constants.php';
//include_once 'base.php';
include_once 'caterer.php';
include_once 'menus.php';
include_once 'customer.php';
$method = $_REQUEST['method'];
function router($methods){
    
    $catering = new Caterers();
    $menus= new Menus();
    $customer = new Customers();

    $response =new stdClass();
    switch($methods){
        case 'getCaterers':
        $response = $catering->getCaterersListByType($_GET['type']);
        break;
        case 'getStandardCateringMenus':
        $response = $catering->getStandardCateringMenus();
        break;
        // case 'getVendorTitle':
        // $response = $vendor;
        case 'getMenusByVendor':
        $response = $menus->getMenusByVendor($_GET['vendor']);
        break;
        case 'getMenusByVendorAndType':
        $response = $menus->getMenusByService($_GET['vendor'],$_GET['type']);
        break;
        case 'getMenusDetails':
        $response = $menus->getMenuDetails($_GET['menu']);
        break;
        case 'getCustomerByNumber':
        $response = $customer->getCustomerByMobNo();
        break;
        case 'upsertCustomer':
        $response = $customer->upsertCustomer();
        break;
        case 'getMenuCategories':
        $response = $menus->getMenuCategories();
        break;
        case 'addToCart';
        $response = $customer->addToCart();
        break;
        case 'getCart':
        $response = $customer->getCartObject();
        break;
        default:
        $response->status = false;
        $response->message ="invalid api method";
    }
return $response;
}

echo json_encode(router($method));

