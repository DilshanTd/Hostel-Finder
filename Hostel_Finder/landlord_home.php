<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Landlord - Home</title>
</head>
<style>
    .listingContainer {
        margin: auto;
        width: 95%;
        padding: 30px;

        margin-top: 50px;
        margin-bottom: 50px;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .listing {
        margin-right: 60px;
        width: 250px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.35);
        padding: 20px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 70px;
    }

    .l_title {

        font-size: 20px;
        font-weight: 600;
    }

    .l_price {
        margin-top: -10px;
        margin-bottom: 0;
        font-size: 17px;
        color: red;
        font-weight: 600;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .image {
        object-fit: contain;
        width: 250px;
        max-height: 300px;
        border-radius: 10px;
    }

    .image_container {
        height: 200px;

        padding: 0px;
        margin: 0px;
    }

    .approval {
        margin-top: 10px;

        margin: auto;
        border-radius: 20px;

    }

    .a_red {
        background-color: red;
        width: 60%;
    }

    .a_green {
        background-color: green;
        width: 50%;
    }

    .approvalText {
        margin-bottom: 5px;
        padding: 5px 0;
        font-weight: 600;
        color: white;
    }

    .deleteButton {

        margin: auto;
        margin-top: 20px;
        margin-bottom: 10px;
        background-color: red;
        color: grey;
        border-radius: 100px;
        width: 10%;
        padding: 5px 7px;


    }

    .deleteImage {
        width: 20px;
        color: white;
        margin-top: 3px;

    }

    body {
        margin: 0;
        padding: 0;
    }
</style>

<body>
    <?php
    include_once "modals/user.php";
    include_once "db_service.php";
    include ("navbar.php");
    ?>
    <div class="listingContainer">
        <?php





        if (!isset($_SESSION["user"])) {

            header("Location: login.php");
        }

        $uid = $_SESSION["user"]->id;
        $conn = OpenConn();

        $cmd = $conn->prepare("SELECT * from properties where user_id=?");
        $cmd->bind_param("i", $uid);
        $cmd->execute();
        $result = $cmd->get_result();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $imageData = $row['image']; ?>



                <div class="listing">
                    <div class="image_container">
                        <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" alt="image" class="image">
                    </div>
                    <p class="l_title">
                        <?= $row['name'] ?>
                    </p>
                    <p class="l_price">Price : Rs.
                        <?= $row['price'] ?>
                    </p>
                    <?php

                    if ($row['isApproved']) { ?>
                        <div class="approval a_green">
                            <p class="approvalText">Approved</p>
                        </div>
                    <?php } else { ?>
                        <div class="approval a_red">
                            <p class="approvalText">Not Approved</p>
                        </div>
                    <?php }

                    ?>

                    <div class="deleteButton">
                        <a href="DeleteListing.php?id=<?= $row['id'] ?>">
                            <img class="deleteImage" src="images/delete.png" alt="delete">
                        </a>
                    </div>




                </div>




            <?php }


        }
        $cmd->close();
        $conn->close();
        ?>

    </div>

</body>

</html>