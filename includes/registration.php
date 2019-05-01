<?php
if ($session->isLoggedIn()) {
    header('Location: ?s=home');
}
$form = new Controller\Register();
?>
<div class="row">
<div class="col-6 col-12-medium">
<h3>Registration form</h3>
<form action="" method="POST">
<div class="row gtr-uniform">
<div class="col-6 col-12-xsmall">
<input type="text" name="name" placeholder="Username" value="<?php if (isset($_POST['name'])) { echo $_POST['name'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<input type="text" name="email" placeholder="E-mail" value="<?php if (isset($_POST['email'])) { echo $_POST['email'];}?>">
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
		<li><input class="button primary" type="submit" value="Create account"></li>
</ul>
</div>
</div>
</form>
</div>
</div>
<?php 

if(!empty($_POST)){
foreach ($form->checkForm($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpassword']) as $error) {

    echo $error;
}
}