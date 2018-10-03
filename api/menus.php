<?php
include_once 'base.php';

class Menus extends ApiBase{

    function _construct(){

    }

    private $table = 'menus';

    public function getMenusByVendor($vendorId){

        if(!is_numeric($vendorId)){
            $response = new StdClass();
            $response->status = false;
            $response->message = "invalid vendorid";
            return $response;
        }
        $query = "SELECT * FROM $this->table WHERE v_id = $vendorId;";

        //$result = mysqli_query($this->conn,$query);
        $result = $this->executeSelect($query);

        $resp = new StdClass();
        $resp->vendor_id = $vendorId;
        $resp->status = false;
        if (mysqli_num_rows($result) > 0){
            $resp->status = true;

            $resp->menus = array();
           while($row = mysqli_fetch_assoc($result)){
                $response =new StdClass();
                $response->menu_id = $row['menu_id'];
                $response->category = $row['menu_cat'];
                $response->title = $row['menu_title'];
                $response->description = $row['description'];
                $response->price = $row['price'];
                $response->range = $row['_range'];
                
                array_push($resp->menus,$response);
           }
        }        
    return $resp;
    }

    private function isWeeklyMenu($menuId){
        $query = "SELECT menu_id FROM menus WHERE (menu_id='$menuId' AND (BEE_BF='YS' OR WMP_BF='YS'));";
        $result = $this->executeSelect($query);
        if (mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }        
    }

    private function getItemsByDay($itemsArr,$itemsMap,$mobileView=false){
        $newMap = array();
        $mobileMap = array();
        $query = "SELECT item_id,item_name,description FROM items WHERE item_id IN (".implode(',',$itemsArr).")";
        $result = $this->executeSelect($query);
        if (mysqli_num_rows($result) > 0){
            $resp = new StdClass();
            $resp->status = true;

            $resp->items = array();
           while($row = mysqli_fetch_assoc($result)){
                $response =new StdClass();
                $mapKey = null;
                while($mapKey=array_search($row['item_id'],$itemsMap) != FALSE  ){
                    $mapKey = array_search($row['item_id'],$itemsMap);
                    $newMap[$mapKey]['item_id'] = $row['item_id'];
                    $newMap[$mapKey]['item_name'] = $row['item_name'];
                    $newMap[$mapKey]['item_description'] = $row['description'];
                    if($mobileView == true){
                        $itemObj= new StdClass();
                        $itemObj->item_id = $row['item_id'];
                        $itemObj->item_name = $row['item_name'];
                        $itemObj->item_description=$row['description'];
                        $itemObj->day = $mapKey;
                        array_push($mobileMap,$itemObj);
                    }
                    unset($itemsMap[$mapKey]);
                }
           }
        }
        if($mobileView ==true){
            return $mobileMap;
        }else{
            return $newMap;
        }
    }

    public function getMenuObject($menuId){
        $resp = new StdClass();
        $results = $this->executeGenericSelect(NULL,'menus',"menu_id='$menuId'");
        return $results[0];
    }

    public function getMenuDetails($menuId){
        if(!is_numeric($menuId)){
            $response = new StdClass();
            $response->status = false;
            $response->message = "invalid menuId";
            return $response;
        }

        $resp = new StdClass();
        $resp->menu_id = $menuId;
        $resp->status = false;

        if(!$this->isWeeklyMenu($menuId)){
            $query = "SELECT item_id,item_name,description FROM items WHERE item_id IN (SELECT item_id FROM menu_details WHERE menu_id=$menuId);";

            //$result = mysqli_query($this->conn,$query);
            $result = $this->executeSelect($query);
    
            
            if (mysqli_num_rows($result) > 0){
                $resp->status = true;
    
                $resp->items = array();
               while($row = mysqli_fetch_assoc($result)){
                    $response =new StdClass();
                    $response->item_id = $row['item_id'];
                    $response->item_name = $row['item_name'];
                    $response->description = $row['description'];
    
                    array_push($resp->items,$response);
               }
            }        
        }else{
            $query = "SELECT * FROM weekly_menu_details WHERE menu_id = $menuId;";
            $result = $this->executeSelect($query);
            if (mysqli_num_rows($result) > 0){
                $resp->items = null;
               while($row = mysqli_fetch_assoc($result)){
                    $itemsArr = [ $row['mon'], $row['tues'], $row['wed'], $row['thurs'], $row['fri'], $row['sat'], $row['sun']];
                    $menu =[];
                    $menu['monday']= $row['mon'];
                    $menu['tuesday'] = $row['tues'];
                    $menu['wednesday'] = $row['wed'];
                    $menu['thursday']= $row['thurs'];
                    $menu['friday'] = $row['fri'];
                    $menu['saturday'] = $row['sat'];
                    $menu['sunday'] = $row['sun'];
                    $resp->status=true;
                    if(!isset($_GET['mobile'])){
                        $itemMenuMap = $this->getItemsByDay($itemsArr,$menu);
                        $resp->items = $itemMenuMap; 
                    }else{
                        $itemMenuMap = $this->getItemsByDay($itemsArr,$menu,true);
                        $resp->items = $itemMenuMap;
                    }
                    
                    break;
               }
            }              
        }
        
        return $resp;
    }

    private function convertServiceTypeToDBServiceType($type){
        switch($type){
            case "catering":
                return "CT";
            case "daawat":
                return "DW";
            case "lunchbox":
                return "LB";
            case "picks_breakfast":
                return "WMP_BF";
            case "picks_lunch":
                return "WMP_L";
            case "picks_dinner":
                return "WMP_D";
            case "picks_monthly";
                return "WMP_M";                
            case "beemar_breakfast":
                return "BEE_BF";
            case "beemar_lunch":
                return "BEE_L";
            case "beemar_dinner":
                return "BEE_D";
            case "beemar_monthly":
                return "BEE_M";    
            default:
                return "invalid";                    
        }
    }

    public function getMonthlyMenuByType($convertedType){
        $resp = new StdClass();
        $resp->vendor_id = 1;
        $resp->type = $convertedType;
        $resp->status = false;
        $resp->menus = array();

        //changeshere
        $query = "SELECT * FROM monthly_menus WHERE type = '$convertedType'";
        
        $result = $this->executeSelect($query);

        if (mysqli_num_rows($result) > 0){
            $resp->status = true;

           while($row = mysqli_fetch_assoc($result)){
                $response =new StdClass();
                $response->menu_id = $row['id'];
                $response->title = $row['title'];
                $response->description = $row['description'];
                $response->price = $row['price'];
                $response->menu = json_decode($row['menu_json']);
                
                array_push($resp->menus,$response);
           }
        }        
        
        return $resp;
    }

    public function getMenusByService($vendorId,$service){
        $convertedType = $this->convertServiceTypeToDBServiceType($service);
        if($convertedType == "invalid"){
            $response = new StdClass();
            $response->status = false;
            $response->message = "invalid type entered";
            return $response;
        }
        if(!is_numeric($vendorId)){
            $response = new StdClass();
            $response->status = false;
            $response->message = "invalid vendorid";
            return $response;
        }

        if($convertedType == 'WMP_M' || $convertedType == 'BEE_M'){
            $resp = $this->getMonthlyMenuByType($convertedType);
            return $resp;            
        }

        $query = "SELECT * FROM $this->table WHERE v_id = $vendorId AND $convertedType='YS';";

        //$result = mysqli_query($this->conn,$query);
        $result = $this->executeSelect($query);

        $resp = new StdClass();
        $resp->vendor_id = $vendorId;
        $resp->type = $service;
        $resp->status = false;
        $resp->menus = array();

        if (mysqli_num_rows($result) > 0){
            $resp->status = true;

           while($row = mysqli_fetch_assoc($result)){
                $response =new StdClass();
                $response->menu_id = $row['menu_id'];
                $response->category = $row['menu_cat'];
                $response->title = $row['menu_title'];
                $response->description = $row['description'];
                $response->price = $row['price'];
                $response->range = $row['_range'];
                
                array_push($resp->menus,$response);
           }
        }        
    return $resp;

    }

    function getMenuCategories(){
        $resp = new StdClass();
        $resp->status = true;
        $resp->categories = array();
        $optionsText = [
        'Catering',
        'Daawat',
        'LunchBox',
        'Patients - Breakfast','Patients - Lunch','Patients - Dinner',
        'Weekly/Monthly Picks - Breakfast','Weekly/Monthly Picks - Lunch','Weekly/Monthly Picks - Dinner'];
        $optionsValue = [
            'catering',
            'daawat',
            'lunchbox',
            'picks_breakfast',
            'picks_lunch',
            'picks_dinner',
            'beemar_breakfast',
            'beemar_lunch',
            'beemar_dinner'
        ];
    
        for($i=0;$i<count($optionsValue);$i++){
            $category = new StdClass();
            $category->value = $optionsValue[$i];
            $category->text = $optionsText[$i];
            array_push($resp->categories,$category);
        }

        return $resp;
    }

    function getCateringMenuItems(){

        $resp = new StdClass();
        $resp->status = true;
        $resp->items = array();

        $options = [
            'Biryani','Qorma','Kheer','Chinese Rice','Wong Tong','Gaajar ka Haalwa',
            'Gola Kabab','Seekh Kabab','Chundun Kabab','Finger Fish'
        ];
        $optionsValue = [
            'biryani','qorma','kheer','chinese-rice','wong-tong','gaajar-halwa',
            'gola-kabab','seekh-kabab','chundun-kabab','finger-fish'
        ];

        for($i=0;$i<count($optionsValue);$i++){
            $category = new StdClass();
            $category->value = $optionsValue[$i];
            $category->text = $options[$i];
            array_push($resp->items,$category);
        }

        return $resp;
    }
}


