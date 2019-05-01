<?php
$session->isNotLoggedIn();

$form = new Controller\Account();

?>
<div class="row">
<div class="col-6 col-12-medium">
<h3>Change password</h3>
<form action="" method="POST">
<div class="row gtr-uniform">
<div class="col-6 col-12-xsmall">
<input type="text" name="oldpassword" placeholder="Old password" value="<?php if (isset($_POST['oldpassword'])) { echo $_POST['oldpassword'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<input type="password" name="password" placeholder="Password" value="<?php if (isset($_POST['password'])) { echo $_POST['password'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<input type="password" name="cpassword" placeholder="Confirm password" value="<?php if (isset($_POST['cpassword'])) { echo $_POST['cpassword'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<ul class="actions">
		<li><input class="button primary" type="submit" value="Change password"></li>
		<li><a class="confirmation button primary" href="?s=delete&du=1">Delete your account.</a></li>
</ul>
</div>
</div>
</form>
</div>
</div>
<?php 
if(!empty($_POST)){
    foreach ($form->checkForm($_SESSION['userId'],$_POST['oldpassword'], $_POST['password'], $_POST['cpassword']) as $error) {
       
        echo $error;
    }
}