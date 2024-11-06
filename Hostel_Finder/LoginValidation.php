<?php

include_once "modals/user.php";
include_once "db_service.php";

session_start();

if (isset($_GET['uname']) && isset($_GET['pass'])) {

    $uname = $_GET['uname'];
    $pass = $_GET['pass'];

    $conn = OpenConn();

    $cmd = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $cmd->bind_param("ss", $uname, $pass);
    $cmd->execute();
    $result = $cmd->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $user = new User($row['id'], $row['username'], $row['email'], $row['type']);

        $_SESSION["user"] = $user;
        if ($user->type == "student") {
            header("Location: student_home.php");
        } else if ($user->type == "landlord") {
            header("Location: landlord_home.php");
        } else if ($user->type == "warden") {
            header("Location: warden_home.php");
        }
        exit();

    } else {

        $_SESSION["msg"] = "Invalid Credentials";
        $_SESSION["color"] = "red";
        header("Location: login.php");

        exit();
    }
} else {

    $_SESSION["msg"] = "Username or password is missing";
    $_SESSION["color"] = "red";

    header("Location: login.php");

    exit();
}
?>