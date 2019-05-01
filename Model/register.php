<?php
namespace Model;

class Register {

    
    
    private $errors = array();
 
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
    
    function form_errors($name, $email, $password, $cPassword){
        if (strlen($name) > 10 || strlen($name) < 5) {
            array_push($this->errors, "Name should be between 5 and 10 characters.");
          
            return $this->errors;
        }
        
        if (strlen($email) > 30 || strlen($email) < 10) {
            array_push($this->errors, "E-mail should be between 10 and 30 characters.");
      
            return $this->errors;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "Invalid E-mail format.");
       
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
    
    function chkData ($name, $email){
            $name = $this->checkInput($name);
            $email = $this->checkInput($email);
        
            $stmt = $this->pdo()->prepare('SELECT COUNT(`email`) FROM `user` WHERE `email` = ?');
            $stmt->execute([$email]);
            $result = $stmt->fetchColumn();
            $stmt = null;
            if($result == 1) {
                array_push($this->errors, "This E-mail already exists.");
                return $this->errors;
            }

            $stmt = $this->pdo()->prepare('SELECT COUNT(`user_name`) FROM `user` WHERE `user_name` = ?');
            $stmt->execute([$name]);
            $result = $stmt->fetchColumn();
            $stmt = null;
            if($result == 1) {
                array_push($this->errors, "This username already exists.");
                return $this->errors;
            }
            $this->errors = array();
            return $this->errors;
}
    
    function insert_user($name, $email, $password) {
    $name = $this->checkInput($name);
    $email = $this->checkInput($email);
    $password = $this->checkInput($password);
      $msg = $this->chkData($name, $email);
      if(empty($msg)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo()->prepare("INSERT INTO `user`(`user_name`, `email`, `password`) VALUES (?,?,?)");
            $stmt->execute([$name, $email, $hash]);
            $stmt = null;
            $this->errors = array('Account created, you can login now.');
            return $this->errors;
      }
       return $msg; 
    }
    
}