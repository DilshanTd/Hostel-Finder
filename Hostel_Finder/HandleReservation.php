<html>

<body>


    <?php

    session_start();

    include ("db_service.php");

    $id = $_GET["id"];
    $type = $_GET["type"];

    if ($type == "accept") {


        $conn = OpenConn();

        $cmd = $conn->prepare("UPDATE reservations SET isApproved=1 where id=?");
        $cmd->bind_param("i", $id);
        $cmd->execute();

        $_SESSION["msg"] = "Request Accepted";
        $_SESSION["color"] = "green";
        header("Location: landlord_requests.php");

    } elseif ($type == "reject") {
        $conn = OpenConn();

        $cmd = $conn->prepare("DELETE from reservations where id=?");
        $cmd->bind_param("i", $id);
        $cmd->execute();

        $_SESSION["msg"] = "Request Rejected";
        $_SESSION["color"] = "green";
        header("Location: landlord_requests.php");
    } else {
        echo "error";
    }

    ?>
</body>

</html>