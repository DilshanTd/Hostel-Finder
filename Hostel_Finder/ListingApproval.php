<html>

<body>

    <?php
    include ("db_service.php");

    $type = $_GET["type"];
    $id = $_GET["id"];

    $conn = OpenConn();
    if ($type == "approve") {

        $cmd = $conn->prepare("UPDATE properties SET isApproved=1 WHERE id=?");
        $cmd->bind_param("i", $id);
        $cmd->execute();

        header("Location: warden_home.php?id=" . $id);

    } elseif ($type == "reject") {
        $cmd = $conn->prepare("DELETE FROM properties WHERE id=?");
        $cmd->bind_param("i", $id);
        $cmd->execute();

        header("Location: warden_home.php");
    } else {
        echo "error";
    }





    ?>

</body>

</html>