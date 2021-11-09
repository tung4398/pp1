<?php
session_start();
include("projectcnw_db.php");
include("checklogin.php");
clearLoggedUser();
// session_unset();
unset($_SESSION['cart']);
// $_SESSION['user'] = "";
header("Location:index.php");
?>