<?php
namespace Model;

class Display {
    
    
    
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
    
    
    
    function imageCount() {
        $stmt = $this->pdo()->prepare('SELECT COUNT(`id`) as counter FROM `image`');
        $stmt->execute();
        $result = $stmt->fetch($this->pdo()::FETCH_ASSOC);
        $stmt = null;
        if(!empty($result)) {
            
            return $result;
        }
        array_push($this->errors, "no");
        return $this->errors;
        
    }
    
    function display_user() {

     
            $stmt = $this->pdo()->prepare("SELECT a.`id`, a.`user_name`, a.`email`, b.`folder_name`, c.`id` as image_id, c.`image_name` FROM `user` a INNER JOIN
                                           `folder` b ON a.`id` = b.`user_id` INNER JOIN `image` c ON b.`id` = c.`folder_id` ORDER BY a.`id`, c.`id` ASC");
            $stmt->execute();
            
            
            $data = array();
            while ($result = $stmt->fetch()) {
                $data[] = new \userData($result);
            }
            $stmt = null;
            
            if(!empty($data)){
                return $data;
            }
            return null;
  
    }
    
}