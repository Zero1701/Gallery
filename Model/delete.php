<?php
namespace Model;

class Delete {
    
    protected function session(){
        $session = \Session::getInstance();
        return $session;
    }
    
    function checkInput($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripcslashes($input);
        return $input;
    }
    
    protected  function pdo() {
        $instance = \ConnectDB\ConnectDb::getInstance();
        $conn = $instance->getConnection();
        return $conn;
        
    }
    
    function deleteFolder($id) {
        if(!empty($this->getFolder($id))){
        $path = 'uploads/' . $this->getFolder($id);  
        array_map('unlink', glob("$path/*"));
        if(is_dir($path)){
        rmdir($path);
        }
        }
    }
    
    function deleteUser($id) {
        $id = $this->checkInput($id);
        $this->deleteFolder($id);
        $stmt = $this->pdo()->prepare("DELETE FROM `user` WHERE `id` = ?");
        $stmt->execute([$id]);
        $stmt = null;
        $this->session()->logout();

    }
    
    function getFolder($id) {
        $id = $this->checkInput($id);
        $stmt = $this->pdo()->prepare('SELECT `folder_name` FROM `folder` WHERE `user_id` = ?');
        $stmt->execute([$id]);
        $result = $stmt->fetch($this->pdo()::FETCH_ASSOC);
        $stmt = null;
        if(!empty($result)) {
        return $result['folder_name'];
        }
        return null;
    }
    
    
    function deleteImage($imgId, $userId) {
        $userId = $this->checkInput($userId);
        $imgId = $this->checkInput($imgId);
        
        $stmt = $this->pdo()->prepare('SELECT a.`id` as user_id, b.`folder_name`, c.`id` as image_id, c.`image_name` FROM `user` a INNER JOIN `folder` b ON a.`id` = b.`user_id` INNER JOIN `image` c ON b.`id` = c.`folder_id` 
                                           WHERE a.`id` = ? AND c.`id` = ?');
        $stmt->execute([$userId, $imgId]);
        $result = $stmt->fetch($this->pdo()::FETCH_ASSOC);
        $stmt = null;

        if(!empty($result)) {
            $stmt = $this->pdo()->prepare("DELETE FROM `image` WHERE `id` = ?");
            $stmt->execute([$result['image_id']]);
            $stmt = null;

            unlink('uploads/'. $result['folder_name'] . '/' . $result['image_name']);
        }
        header('Location: ?s=management');
    }
    
}