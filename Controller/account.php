<?php
namespace Controller;

class Account {
    
    function modelFunction() {
        return new \Model\Account();
    }
    
    function checkForm ($id, $oldPassword, $password, $cPassword){
        $msg = array();
        $msg = $this->modelFunction()->form_errors($oldPassword, $password, $cPassword);
        if(empty($msg)) {
            $msg = $this->modelFunction()->update_user($id, $password, $oldPassword);
           return $msg;
        }
      return $msg;
    }
    
}