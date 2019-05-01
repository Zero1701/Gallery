<?php
$session->isNotLoggedIn();

$delete = new Controller\Delete();

if(!empty($_GET)){
    
$delete->chkId($_GET, $_SESSION['userId']);

}
