<?php
session_start();
//if there's no user record in session
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=denied");
}
