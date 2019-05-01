<?php
namespace Model;

class Upload {
    
    
    
    private $errors = array();
    private $trueFalse = null;
    protected  function pdo() {
        $instance = \ConnectDB\ConnectDb::getInstance();
        $conn = $instance->getConnection();
        return $conn;
        
    }
    function checkInput($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripcslashes($input);
        return $input;
    }
    
    function form_errors($name){
        
        $imgName = $name['name'];
        $imgSize = $name['size'];
        $valid_ext = array("png","jpg");
       
        if (count($imgName) > 3) {
            array_push($this->errors, "Please upload maximum of 3 pictures at once.");
            return $this->errors;
        }
                     for($i = 0; $i < count($imgName); $i++){
                         $tmp = explode('.', $imgName[$i]);
                          
        if (strlen($tmp[0]) > 10 || strlen($tmp[0]) < 5) {
            
            array_push($this->errors, "Image should be between 5 and 10 characters.");
            return $this->errors;
        }
        
        $ext = end($tmp);
        
        if(!in_array($ext, $valid_ext)){
            array_push($this->errors, "Invalid image extension. Only PNG and JPG allowed.");
            return $this->errors;
        }
        //check file size 5MB
        if($imgSize[$i] > 5000000 || $imgSize[$i] == 0) {
            array_push($this->errors, "Image size greater than 5MB.");
            return $this->errors;
        }
                     }
        
        $this->errors = array();
        return $this->errors;
    }
    
    function createDbFolder($id) {
            $id = $this->checkInput($id);
            $stmt = $this->pdo()->prepare("INSERT INTO `folder`(`user_id`, `folder_name`) VALUES (?,?)");
            $stmt->execute([$id, $id]);
            $stmt = null;
            return $this->pdo()->lastInsertId();
        
       
    }
    
    function getFolder($id) {
        $id = $this->checkInput($id);
        $stmt = $this->pdo()->prepare("SELECT `folder_name` FROM `folder` WHERE `user_id` = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        $stmt = null;
        return $result;
        
        
    }
    
    function createFolder($id){
        $folderName = 'uploads/' . $this->checkInput($id);
        
        if(!is_dir($folderName)){
            //Directory does not exist, so lets create it.
            
            mkdir($folderName, 0755);
            
            return $this->createDbFolder($id);
        }
        
        return $this->getFolder($id);
    }
    
    function uploadImage($files, $id) {
          $folder = $this->createFolder($id);
            
            for($i = 0; $i < count($files['name']); $i++){


                    // Upload file
                    move_uploaded_file($files['tmp_name'][$i],'uploads/'. $folder . '/' . $files['name'][$i]);
                        
                    $stmt = $this->pdo()->prepare("INSERT INTO `image`(`folder_id`, `image_name`) VALUES (?,?)");
                    $stmt->execute([$this->checkInput($folder), $this->checkInput($files['name'][$i])]);
                    $stmt = null;

                        
                    }
                    $this->errors = array();
                    return $this->errors;
                
                
            }
    
}