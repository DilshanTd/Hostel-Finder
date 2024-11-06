<html>

<body>



    <?php
    include ("modals/user.php");
    include ("db_service.php");
    include ("modals/property.php");
    session_start();






    $name = $_POST["name"];
    $description = $_POST["description"];
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $price = $_POST["price"];
    $location = $_POST["location"];

    $uid = $_SESSION["user"]->id;
    $isApproved = false;


    $conn = OpenConn();

    $cmd = $conn->prepare("INSERT into properties(name, price, description, image, location, isApproved, user_id) VALUES(?,?,?,?,?,?,?);");
    $cmd->bind_param("sdsbsii", $name, $price, $description, $imageData, $location, $isApproved, $uid);
    $cmd->execute();


    $cmd->close();
    $conn->close();
    $_SESSION["msg"] = "Listing Added Successfully";
    $_SESSION["color"] = "green";
    header("Location: add_listing.php");
    ?>
</body>

</html>