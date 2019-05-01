<?php
if ($session->isLoggedIn()) {
    header('Location: ?s=home');
}

$form = new Controller\Login();
?>
<div class="row">
<div class="col-6 col-12-medium">
<h3>Login</h3>
<form action="" method="POST">
<div class="row gtr-uniform">
<div class="col-6 col-12-xsmall">
<input type="text" name="email" placeholder="E-mail" value="<?php if (isset($_POST['email'])) { echo $_POST['email'];} elseif(isset($_COOKIE['emailCookie'])) { echo $_COOKIE['emailCookie'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<input type="password" name="password" placeholder="Password" value="<?php if (isset($_POST['password'])) { $_POST['password'];} elseif (isset($_COOKIE['passwordCookie'])) { echo $_COOKIE['passwordCookie'];}?>">
</div>
<br />
<div class="col-6 col-12-xsmall">
<input type="checkbox" name="remember" id="checkbox-alpha" <?php if(isset($_COOKIE["rememberCookie"]) || !empty($_POST['remember'])) { ?> checked <?php } ?> />
<label for="checkbox-alpha">Remember me</label>
</div>
<br />
<div class="col-6 col-12-xsmall">
<ul class="actions">
		<li><input class="button primary" type="submit" value="Login"></li>
		<li><a class="button primary" href="?s=registration">Register</a></li>
</ul>
</div>
</div>
</form>
</div>
</div>
<?php 
if(empty($_POST['remember'])) { $remember = 0; } else { $remember = 1;}
if(!empty($_POST)){
    foreach ($form->checkForm($_POST['email'], $_POST['password'], $remember) as $error) {
       
        echo $error;
    }
}