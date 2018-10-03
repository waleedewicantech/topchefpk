<?php
include_once 'base.php';
include_once 'menus.php';
class Customers extends ApiBase{
    private $menu;
    
    function __construct() {
        $this->menu= new Menus();
    }

    public function addToCart(){
        $resp = new StdClass();
        $resp->status = false;
        $cart = '';
        if(!isset($_GET['menu_id'])){
            return $resp;
        }
        session_start();
        if(!isset($_SESSION['cart'])){
            $cart = '';
        }else{
            $cart = $_SESSION['cart'].',';
        }

        if(isset($_GET['menu_id'])){
            $menuArray = isset($_SESSION['cart'])?explode(',',$_SESSION['cart']):array();
            if(in_array($_GET['menu_id'], $menuArray))
            {
                $resp->status=true;
                return $resp;
            }
            $cart = $cart.$_GET['menu_id'];
            $_SESSION['cart'] = $cart;
            $resp->status=true;
        }
        return $resp;
    }

    private function extractMenuDetails($menuId){
        $menuObj = $this->menu->getMenuObject($menuId);
        $resp = new StdClass();
        $resp->title=$menuObj['menu_title'];
        $resp->price=$menuObj['price'];
        $resp->id=$menuObj['menu_id'];
        $resp->total=0;
        return $resp;
    }

    public function getCartObject(){
        $menusResp= new StdClass();
        $menusResp->status = false;
        $menusResp->menus = array();
        session_start();
        if(!isset($_SESSION['cart'])){
            return $menusResp;
        }else{
            $menuArray = explode(',',$_SESSION['cart']);
            $menusResp->status = true;
            for($i=0;$i<count($menuArray);$i++){
                $menuId = $menuArray[$i];
                array_push($menusResp->menus,$this->extractMenuDetails($menuId));
            }   
        }
        return $menusResp;
    }

    private $table = "customer";

    public function getCustomerByMobNo(){
        $response = new StdClass();
        $response->status = false;
        $response->message = "missing sessionKey";

        if(isset($_POST['key']) && $_POST['key'] == KEY){
            if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
                //handling of select call
                $query = "SELECT * FROM $this->table WHERE mobno='".$_POST['mobile']."';";
                $result = $this->executeSelect($query);
                $resp = new StdClass();
                $response->status = true;
                unset($response->message);
                $response->customers = array();
                if (mysqli_num_rows($result) > 0){
                    $resp->status = true;
        
                   while($row = mysqli_fetch_assoc($result)){
                        $resp =new StdClass();
                        $resp->id = $row['cust_id'];
                        $resp->user_name = $row['username'];
                        $resp->email = $row['email'];
                        $resp->password = $row['pass'];
                        $resp->name = $row['_name'];
                        $resp->mobile_number = $row['mobno'];
                        $resp->address = $row['address'];
                        array_push($response->customers,$resp);
                   }
                }
            }else{
                $response->message = "mobile number not provided";
            }
        }else{
            $response->message = "missing sessionKey";
        }

        return $response;
    }

    public function getCustomerById($id = null){
        $response = new StdClass();
        $response->status = false;
        $response->message = "missing sessionKey";

        if((isset($_POST['key']) && $_POST['key'] == KEY) || !empty($id)){
            if((isset($_POST['mobile']) && !empty($_POST['mobile'])) || !empty($id)){
                //handling of select call
                $custId = (isset($_POST['mobile']) && $_POST['mobile'])?$_POST['mobile']:(!empty($id)?$id:0); 
                $query = "SELECT * FROM $this->table WHERE cust_id='".$custId."';";
                $result = $this->executeSelect($query);
                $resp = new StdClass();
                $response->status = true;
                unset($response->message);
                $response->customers = array();
                if (mysqli_num_rows($result) > 0){
                    $resp->status = true;
        
                   while($row = mysqli_fetch_assoc($result)){
                        $resp =new StdClass();
                        $resp->id = $row['cust_id'];
                        $resp->user_name = $row['username'];
                        $resp->email = $row['email'];
                        $resp->password = $row['pass'];
                        $resp->name = $row['_name'];
                        $resp->mobile_number = $row['mobno'];
                        $resp->address = $row['address'];
                        array_push($response->customers,$resp);
                   }
                }
            }else{
                $response->message = "mobile number not provided";
            }
        }else{
            $response->message = "missing sessionKey";
        }

        return $response;
    }

    private function updateFields($key,$value,$id){
        $sql = "UPDATE $this->table SET $key='".$value."' WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        }else{
            return false;
        }
    }

    private function createCustomer(){
        $response = new StdClass();
        $response->status = false;
        $response->message = '';
        if(isset($_POST['user_name'],$_POST['email'],$_POST['password'],$_POST['name'],$_POST['mobile_number'],$_POST['address'])){
            //all elements found, create Customer
            $sql = "INSERT INTO $this->table (username, email, pass, _name, mobno, address)VALUES ('".$_POST['user_name']."', '".$_POST['email']."', '".$_POST['password']."','".$_POST['name']."','".$_POST['mobile_number']."','".$_POST['address']."')";
            if ($this->conn->query($sql) === TRUE) {
                $_POST['mobile'] = $_POST['mobile_number'];
                $_POST['key']=KEY;
                $response = $this->getCustomerByMobNo();
            } else {
                $response->message = "unable to create customer";
            }
        }else{
            $response->message = "one more required parameters missing";
        }
        return $response;
    }

    private function updateCustomer(){
        adasdasdsad;
        $id = $_POST['id'];
        $customer = new StdClass();
        $valueUpdated = false;
        
        if(isset($_POST['email'])){
            $this->updateFields('email',$_POST['email'],$id);
        }
        if(isset($_POST['password'])){
            $this->updateFields('pass',$_POST['password'],$id);
        }
        if(isset($_POST['name'])){
            $this->updateFields('_name',$_POST['name'],$id);
        }
        if(isset($_POST['user_name'])){
            $this->updateFields('username',$_POST['user_name'],$id);
        }
        if(isset($_POST['mobile_number'])){
            $this->updateFields('mobno',$_POST['mobile_number'],$id);
        }
        if(isset($_POST['address'])){
            $this->updateFields('address',$_POST['address'],$id);
        }

        return $this->getCustomerById($id);        
    }

    private function searchCustomer($key,$value){
        $search = new StdClass();
        $search->found = false;
        $search->id = -1;
        $query = "SELECT * FROM $this->table WHERE $key='".$value."';";
        $result = $this->executeSelect($query);
        if (mysqli_num_rows($result) > 0){
            $search->found = true;
            $row = mysqli_fetch_assoc($result);
            $search->id = $row['cust_id'];
        }
        return $search;
    }

    private function isPropOwn($sqlId,$postId){
        $resp = false;
        if($sqlId == $postId || $sqlId == -1){
            $resp = true;
        }else{
            $resp = false;
        }
        return $resp;
    }

    public function upsertCustomer(){

        $response = new StdClass();
        $response->status = false;
        $response->message = "";

        $customerByIdExists = new StdClass();
        $customerByEmailExists = new StdClass();
        $customerByUserNameExists = new StdClass();

        if(!isset($_POST['key']) || (!empty($_POST['key']) && $_POST['key'] !=KEY)){
            $response->message = "invalid or missing key";
            return $response;
        }

        if(isset($_POST['id']) && !empty($_POST['id'])){
            //check if the id exists
            $customerByIdExists = $this->searchCustomer('cust_id',$_POST['id']);
            //if exists then check the mail and username and then update the customer
        }
        if(isset($_POST['email']) && !empty($_POST['email'])){
            //check if the id exists
            $customerByEmailExists = $this->searchCustomer('email',$_POST['email']);
        }
        if(isset($_POST['user_name']) && !empty($_POST['user_name'])){
            //check if the email exists
            $customerByUserNameExists = $this->searchCustomer('username',$_POST['user_name']);
        }

        //check krlia k exists or not 
        if(!isset($_POST['id']) && !$customerByEmailExists->found && !$customerByUserNameExists->found){
            //createCustomer
            $response = $this->createCustomer();
        }
        else if(isset($_POST['id']) && !empty($_POST['id'])){
            $updateCustomer = true;
            //update customer logic hre
            $id = $_POST['id'];
            if(isset($_POST['email']) && !($this->isPropOwn($customerByEmailExists->id,$id))) 
            {
                $updateCustomer = false;
                $response->message += "email for another customer already exists";
            }
            if(isset($_POST['user_name']) && !$this->isPropOwn($customerByUserNameExists->id,$id)) 
            {
                $updateCustomer = false;
                $response->message += "username already exists for another customer";
            }        
                //update the customer for given id
            if($updateCustomer){
                $response = $this->updateCustomer();
            }    
        }else{
            $response->status = false;
            $response->message = "id not found and email or username matches";
        } 

        return $response;
    }
}
