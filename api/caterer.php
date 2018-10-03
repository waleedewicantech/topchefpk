<?php
include_once 'base.php';

class Caterers extends ApiBase{

    function _construct(){

    }

    private $table = 'vendorinfo';

    private function convertServiceTypeToDBServiceType($type){
        switch($type){
            case "catering":
                return "C";
            case "daawat":
                return "DW";
            case "lunchbox":
                return "LB";
            case "single_pick":
                return "SP";
            case "beemar_breakfast":
                return "B_BF";
            case "beemar_lunch":
                return "B_L";
            case "beemar_dinner":
                return "B_D";        
            default:
                return "invalid";                    
        }
    }

    public function getCaterersListByType($type){
        $convertedType = $this->convertServiceTypeToDBServiceType($type);
        if($convertedType == "invalid"){
            $response = new StdClass();
            $response->status = false;
            $response->message = "invalid type entered";
            return $response;
        }
        $query = "SELECT * FROM $this->table WHERE _status='AC' AND id IN (SELECT id FROM services WHERE $convertedType='YS');";

        //$result = mysqli_query($this->conn,$query);
        $result = $this->executeSelect($query);

        $resp = new StdClass();
        $resp->service = $type;
        $resp->status = false;
        $resp->caterers = array();
        if (mysqli_num_rows($result) > 0){
            $resp->status = true;

            $resp->caterers = array();
           while($row = mysqli_fetch_assoc($result)){
                $response =new StdClass();
                $response->id = $row['id'];
                $response->contact_no = $row['contactno'];
                $response->address = $row['address'];
                $response->business_name = $row['businessname'];
                $response->image_url = $row['image'];
                //$response->pass = $row['pass'];
                array_push($resp->caterers,$response);
           }
        }        
    return $resp;
    }

    public function getStandardCateringMenus(){
        
    }
}
