<?php
include_once 'autoload.php';
$session = Session::getInstance();
?>
<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Industrious by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<nav>
					<a href="#menu">Menu</a>
				</nav>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">					
					<li><a href="?s=home">Home</a></li>
 						<?php if ($session->isLoggedIn()){?>
					<li><a href="?s=management">Management</a></li>
					<li><a href="?s=account">My account</a></li>
					<li><a href="?s=logout">Logout</a></li>
 						<?php } else { ?>
					<li><a href="?s=login">Login</a></li>
						<?php }?>
				</ul>
			</nav>


