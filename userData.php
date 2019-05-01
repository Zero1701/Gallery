<?php
class userData {
    
    private $userid, $userName, $email, $folder, $image, $imageId;
    
    public function __construct($dbRow){
        $this->userid = $dbRow['id'];
        $this->userName = $dbRow['user_name'];
        $this->email = $dbRow['email'];
        $this->folder = $dbRow['folder_name'];
        $this->image = $dbRow['image_name'];
        $this->imageId = $dbRow['image_id'];
        
    }
    public function getUserName() {
        return $this->userName;
    }
    
    public function getUserImageId() {
        return $this->imageId;
    }
    
    public function getUserId() {
        return $this->userid;
    }
    
    public function getUserEmail() {
        return $this->email;
    }
    
    public function getUserFolder() {
        return $this->folder;
    }
    
    public function getUserImage() {
        return $this->image;
    }
}