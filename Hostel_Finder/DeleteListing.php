<html>

<body>
    <?php

    include ("db_service.php");

    $id = $_GET["id"];

    $conn = OpenConn();

    $cmd = $conn->prepare("DELETE from properties where id=?;");
    $cmd->bind_param("i", $id);
    $cmd->execute();

    header("Location: landlord_home.php");

    ?>
</body>

</html>