<?php

if ($session->isLoggedIn()) {
    $session->logout();
}
