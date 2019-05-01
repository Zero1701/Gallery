<?php
namespace Controller;

class Upload {
    
    function modelFunction() {
        return new \Model\Upload();
    }
       
    
    function checkForm ($files, $id){        
        $msg = array();
        $msg = $this->modelFunction()->form_errors($files);
        if(empty($msg)) {
            $msg = $this->modelFunction()->uploadImage($files, $id);
            return $msg;
        }
        return $msg;
    }
    
}