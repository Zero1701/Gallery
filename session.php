<?php
/**
 * Class Session
 */
class Session
{
    private static $instance;
  
    private function __construct()
    {
        session_start();
    }
    /**
     * Logs user in
     */
    public function login($id, $email, $name, $password, $remember)
    {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['userId'] = $id;
        $_SESSION['auth'] = true;
        if($remember == 1){
            setcookie("emailCookie", $email, time()+3600);
            setcookie("passwordCookie", $password, time()+3600);
            setcookie("rememberCookie", 1, time()+3600);
        }
        else {
            setcookie("emailCookie", '', time()-3600);
            setcookie("passwordCookie", '', time()-3600);
            setcookie("rememberCookie", NULL, time()-3600);
        }
        header('Location: ?s=home');
    }
    /**
     * Logs user out
     */
    public function logout()
    {
        //@todo
        session_destroy();
        header('Location: ?s=home');
    }
    /**
     * Checks if user is logged in or not
     */
    public function isLoggedIn()
    {
        
        if(isset($_SESSION['auth']) && $_SESSION['auth']) return true;
    }
    
    public function isNotLoggedIn()
    {
        if(!isset($_SESSION['auth']) || !$_SESSION['auth']) header('Location: ?s=home');
    }
    
    
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}