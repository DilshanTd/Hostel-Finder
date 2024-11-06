<?php
include ("modals/user.php");
include_once ("db_service.php");

session_start();

$uid = $_SESSION["user"]->id;
$pid = $_GET["id"];

$conn = OpenConn();

$cmd = $conn->prepare("SELECT * FROM reservations WHERE user_id=? AND property_id=?");
$cmd->bind_param("ii", $uid, $pid);
$cmd->execute();
$result = $cmd->get_result();

if (!($result->num_rows > 0)) {
    $cmd = $conn->prepare("INSERT into reservations(user_id, property_id, date, isApproved) values(?,?,NOW(),0);");
    $cmd->bind_param("ii", $uid, $pid);
    $cmd->execute();

    header("Location: student_Listing_Details.php?id=" . $pid);
}

?>