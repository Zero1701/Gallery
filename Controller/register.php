<?php
namespace Controller;

class Register {
    
    function modelFunction() {
        return new \Model\Register();
    }
    
    function checkForm ($name, $email, $password, $cPassword){
        $msg = array();
        $msg = $this->modelFunction()->form_errors($name, $email, $password, $cPassword);
        if(empty($msg)) {
           $msg = $this->modelFunction()->insert_user($name, $email, $password);
           return $msg;
        }
      return $msg;
    }
    
}