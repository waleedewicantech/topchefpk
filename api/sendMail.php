<?php

include_once 'constants.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
// header('Content-Type: application/json');

if(isset($_POST['key']) && $_POST['key']!=KEY){
    echo '{"status":false,"error":"invalid key"}';
    die();
}

if(isset($_POST['receiver']) && isset($_POST['subject']) && isset($_POST['message'])){
    $response = new StdClass();
    $response->status = false;
    try{
        $msg = $_POST['message'];

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        if(isset($_POST['htmlmail'])){
            $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($_POST['receiver'],$_POST['subject'],$msg,$headers );
        }else{
            mail($_POST['receiver'],$_POST['subject'],$msg);
        }
        // send email
        $response->status=true;
        $response->message="mail sent";

    }catch(Exception $e){
        $response->message = $e->getMessage();
    }

    echo json_encode($response);
}
?>