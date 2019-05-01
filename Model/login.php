<?php
namespace Model;

class Login {
    
    
    
    private $errors = array();
    private $trueFalse = null;
    protected  function pdo() {
        $instance = \ConnectDB\ConnectDb::getInstance();
        $conn = $instance->getConnection();
        return $conn;
        
    }
    
    protected function session() {
        $session = \Session::getInstance();
        return $session;
        
    }
    function checkInput($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripcslashes($input);
        return $input;
    }
    
    function login_user ($email, $password, $remember){
        $email = $this->checkInput($email);
        $password = $this->checkInput($password);
        $stmt = $this->pdo()->prepare('SELECT `id`, `user_name`, `email`, `password` FROM `user` WHERE `email` = ?');
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        $stmt = null;
        if($result && password_verify($password, $result['password']))
        {
           
            $this->session()->login($result['id'], $email, $result['user_name'], $password, $remember);

           return true;
           
        }

            array_push($this->errors, "Invalid username or password.");
            
            return $this->errors;
    }
    

    
}