
<?php
session_start();
unset($_SESSION['user']);
header("http://localhost/webdev/onlineshop/login.php");
?>