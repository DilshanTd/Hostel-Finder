<?php
session_start();

unset($_SESSION["user"]);
$_SESSION["msg"] = "Logged Out Successfully";
$_SESSION["color"] = "green";
header("Location:login.php");
?>