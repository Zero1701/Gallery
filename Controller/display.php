<?php
namespace Controller;

class Display {
    
    function modelFunction() {
        return new \Model\Display();
    }
    
    function tableData() {

        return $this->modelFunction()->display_user();
    }
    
    function displayImageCount() {
       $msg = $this->modelFunction()->imageCount();
       return $msg;
    }
    
}