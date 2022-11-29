<?php
session_start();
//if there's no user record in session
if (!isset($_SESSION['user'])) {
    header("Location: http://localhost/webdev/onlineshop/login.php?action=denied");
}
