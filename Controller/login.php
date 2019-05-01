<?php
namespace Controller;

class Login {
    
    function modelFunction() {
        return new \Model\Login();
    }
    

    
    function checkForm ($email, $password, $remember){
            $msg = $this->modelFunction()->login_user($email, $password, $remember);
            return $msg;
    }
    
}