<?php
namespace Controller;

class Delete {
    
    function modelFunction() {
       return new \Model\Delete();
    }
    
    function chkId($imageId, $userId) {
        if (isset($_GET['di']) && !empty($_GET['di'])) {
            echo $_GET['di'];
            $this->modelFunction()->deleteImage($_GET['di'], $userId);
        }
        
        if (isset($_GET['du']) && !empty($_GET['du'])) {
            $this->modelFunction()->deleteUser($userId);
            
        }
    }

}