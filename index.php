<?php

include_once 'header.php';

function nukeAlphaNum($value) {
    return preg_replace('/[^a-zA-Z]/', '', trim($value));
}

$inc_dir = './includes/';
$s = isset($_GET['s']) ? nukeAlphaNum($_GET['s']) : "home";
$inclusion = $inc_dir . $s . '.php';
if (file_exists($inclusion)) {
    include_once($inclusion);
} else {
    include_once("$inc_dir/error.php");
}

include_once 'footer.php';

