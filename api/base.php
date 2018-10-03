<?php
class ApiBase{

    private $user = 'root';//"topchef_dbadmin";

    private $servername = "localhost";

    private $pass = 'click123';//"administr@tor";

    private $db = "topchef";//topchef_master

    protected $conn = null;



    function __construct() {

        $this->conn = new mysqli($this->servername, $this->user, $this->pass,$this->db);

        if ($this->conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);

        }

    }



    function executeSelect($query){

        $result = mysqli_query($this->conn,$query);

        return $result;

    }

    function executeGenericSelect($colsArray=NULL,$table,$condition=NULL){
        $query = "SELECT ";

        if($colsArray == NULL || $colsArray == null){
            $query = $query."* ";
        }else{
            $cols = implode(',',$colsArray);
            $query = $query.$cols.' ';
        }

        $query = $query.'FROM '.$table;

        if($condition == NULL || $condition == null){
            $query = $query.';';
        }else{
            $query = $query." WHERE ".$condition.' ;';
        }

        $result = $this->conn->query($query);

        $queryResult = [];

        if ($result) {
            $finfo = $result->fetch_fields();

            if (mysqli_num_rows($result) > 0) 
                {
                    while($row = mysqli_fetch_assoc($result)){
                        $resultSet = [];
                        foreach ($finfo as $val) {
                            $resultSet[$val->name] = $row[$val->name];
                        }
                        array_push($queryResult,$resultSet);  
                    }
                }
        }

        return $queryResult;

    }

    protected function genericDelete($table,$col,$values){
        if(count($values)<=0)
        {
            return true;
        }
        $sql="DELETE FROM ".$table;
        $sql=$sql." WHERE ".$col;
        $sql=$sql." IN (";
        $sql=$sql.implode(',',$values);
        $sql=$sql.');';

        if ($this->conn->query($sql) === TRUE) {
            //echo "deletion done in ".$table;
            return true;
        } else {
            return false;
        }
    }

    protected function executeGenericUpdate($updateObj,$table,$criteria,$debug=false){
        $columns = array_keys($updateObj);
        $setCriteria=[];
        for($i=0;$i<count($columns);$i++){
            array_push($setCriteria,$columns[$i]."='".$updateObj[$columns[$i]]."'");
        }

        $query = "UPDATE ".$table." SET ".implode(',',$setCriteria)." WHERE ".$criteria;
            if($debug) echo $query;
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    protected function genericInsert($insertObj,$table){
        $columns = array_keys($insertObj);
        $values = [];
        for($i=0;$i<count($columns);$i++){
            array_push($values,"'".$insertObj[$columns[$i]]."'");
        }
        $sql = "INSERT INTO $table (".implode(',',$columns).") VALUES (".implode(",",$values).");";
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function uploadFile($additionalPath='',$fileControlBrowser,$filenameNew){
        $response = new StdClass();
        $response->status = false;
        $response->path='/uploads/noimage.jpeg';
        $target_dir = '../../uploads/'.$additionalPath.'/';
        if($_FILES[$fileControlBrowser]['size'] <= 10){
            return $response;
        }
        $target_file = $target_dir . $filenameNew.'.'.strtolower(pathinfo($_FILES[$fileControlBrowser]['name'],PATHINFO_EXTENSION));
        $targetPath = './uploads/'.$additionalPath.'/' . $filenameNew.'.'.strtolower(pathinfo($_FILES[$fileControlBrowser]['name'],PATHINFO_EXTENSION));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES[$fileControlBrowser]["tmp_name"]);
        
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $response->status=false;
            $response->message = "File is not an image.";
            $uploadOk = 0;
            return $response;
        }
    
        if (file_exists($target_file)) {
            if (!unlink($target_file))
            {
                $response->status = false;
                $response->message = "Error deleting $file";
                $uploadOk = 0;
                return $response;
            }
        }
    
        if ($_FILES[$fileControlBrowser]["size"] > 5000000) {
            $response->message = "Sorry, your file is larger than 5MB.";
            $response->status = false;
            $uploadOk = 0;
            return $response;
        }
    
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $response->message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $response->status = false;
            $uploadOk = 0;
            return $response;
        }
    
        if($uploadOk == 1){
            if (move_uploaded_file($_FILES[$fileControlBrowser]["tmp_name"], $target_file)) {
                $response->message = "The file ". basename( $_FILES[$fileControlBrowser]["name"]). " has been uploaded.";
                $response->status = true;
                $response->path = $targetPath;
            } else {
                $response->message =  "Sorry, there was an error uploading your file.";
                $response->status = false;
                $uploadOk = 0;
            }  
        }
        return $response;
    }

}
