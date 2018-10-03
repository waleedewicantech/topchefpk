<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../api/constants.php';
include_once '../api/caterer.php';
$catering = new Caterers();

function insertCatererCard($caterer){
    echo "<td>
    <img src=\"".$caterer->image_url."\" class=\"rounded-circle\"  style=\"width:90%\">
    <h6 style=\"font-family:'Lucida Calligraphy',cursive\" class=\"title\"><a class=\"vendor-link\" href=\"JavaScript:navigateTo('caterer',".$caterer->id.",'".$caterer->business_name."')\">".$caterer->business_name."</a></h6>
    </td>"; 
}

$resp = $catering->getCaterersListByType('catering');
$caterers = array();
if($resp->status){
$caterers = $resp->caterers;
}

$column= 1;

for($i=0;$i<count($caterers);$i++){
    if($caterers[$i]->id=="1"){
        continue;
    }
    if($column == 1){
        echo '<tr>';
    }

    insertCatererCard($caterers[$i]);
    $column++;
    if($column > 3){
        echo '</tr>';
        $column =1;
    }
}

?>