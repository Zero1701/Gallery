<?php
namespace Model;

class Account {

    
    
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
    
    function form_errors($oldPassword, $password, $cPassword){
       
        if (strlen($oldPassword) > 10 || strlen($oldPassword) < 5) {
            array_push($this->errors, "Old password should be between 5 and 10 characters.");
            return $this->errors;
        }

        if (strlen($password) > 10 || strlen($password) < 5) {
            array_push($this->errors, "Password should be between 5 and 10 characters.");
            return $this->errors;
        }
        
        if ($password !== $cPassword) {
            array_push($this->errors, "Password and confirm password do not match.");
            return $this->errors;
        }
        $this->errors = array();
        return $this->errors;
    }
    
    function chkPassword ($id, $oldPassword){
        $id = $this->checkInput($id);
        $oldPassword = $this->checkInput($oldPassword);
        $stmt = $this->pdo()->prepare('SELECT `password` FROM `user` WHERE `id` = ?');
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $stmt = null;
        if($result && password_verify($oldPassword, $result['password']))
        {
            
            $this->errors = array();
            return $this->errors;
            
        }
        
        array_push($this->errors, "Old password is invalid.");
        
        return $this->errors;
    }

    
    function update_user($id, $password, $oldPassword) {
    $id = $this->checkInput($id);
    $password = $this->checkInput($password);
    $oldPassword = $this->checkInput($oldPassword);
      $msg = $this->chkPassword($id, $oldPassword);
      if(empty($msg)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo()->prepare("UPDATE `user` SET `password`= ? WHERE `id` = ? ");
            $stmt->execute([$hash, $id]);
            $stmt = null;
            $this->errors = array('Password successfully changed.');
            return $this->errors;
      }
       return $msg; 
    }
    
}