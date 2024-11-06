<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord - Requests</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body {
        background-color: #F4F4F4;
        margin: 0;
        padding: 0;
    }

    .container {
        margin: auto;
        width: 40%;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 10px 30px;
        margin-top: 100px;
        border-radius: 10px;
    }

    .request {
        display: flex;
        border-radius: 5px;
        border: 2px solid gray;
        justify-content: space-between;
        align-items: center;
        padding: 5px 20px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .details {
        justify-content: center;
        display: block;
        text-align: center;
    }

    .title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: -10px;
    }

    .price {
        color: red;
        font-weight: 600;
        font-size: 16px;
    }

    .username {
        color: green;
        font-weight: 600;
        font-size: 20px;
        margin-bottom: -10px;
    }

    .time {
        color: green;
        font-weight: 600;
        font-size: 16px;
    }

    .button {
        padding: 5px 15px;
        border-radius: 5px;
        margin: auto 5px;
    }

    .accept {
        background-color: green;

    }

    .reject {
        background-color: red;
    }

    .flex {
        display: flex;
    }

    .btnText {
        color: white;
        font-weight: 700;
        text-decoration: none;
    }

    .arrow {
        font-weight: 700;
        font-size: 28px;
        text-align: center;

    }

    .heading {
        text-align: center;
        margin-top: 60px;
        font-weight: 600;
        margin-bottom: -50px;
        font-size: 40px;

    }

    .warning {
        letter-spacing: 3px;
        font-weight: 600;
        font-size: 25px;

        padding-top: 80px;
        margin-bottom: -30px;
    }
</style>

<body>

    <?php

    include ("modals/user.php");
    include ("navbar.php");
    include ("db_service.php");

    $uid = $_SESSION["user"]->id;



    ?>

    <h1 class="heading">Requests</h1>

    <?php
    if (isset($_SESSION["msg"])) {
        if ($_SESSION["msg"] != "") { ?>

            <h3 class="warning <?= $_SESSION["color"] ?>">
                <?= $_SESSION["msg"] ?>
            </h3>

            <?php
            $_SESSION["msg"] = "";
            $_SESSION["color"] = "";
        }
    } ?>

    <div class="container">
        <?php
        $conn = OpenConn();

        $cmd = $conn->prepare("SELECT r.id,p.name,p.price,u.username,r.date FROM reservations AS r JOIN properties AS p on r.property_id=p.id JOIN users AS u on r.user_id=u.id where p.user_id=? and r.isApproved=0;");
        $cmd->bind_param("i", $uid);
        $cmd->execute();
        $result = $cmd->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>

                <div class="request">
                    <div class="details">
                        <p class="title">
                            <?= $row['name'] ?>
                        </p>
                        <p class="price">Price :
                            <?= $row['price'] ?>
                        </p>
                    </div>
                    <div class="details">
                        <p class="arrow">:</p>
                    </div>
                    <div class="details">
                        <p class="username">
                            <?= $row['username'] ?>
                        </p>
                        <p class="time">
                            <?= $row['date'] ?>
                        </p>
                    </div>

                    <div class="details flex">
                        <div class="button accept">
                            <a href="HandleReservation.php?id=<?= $row["id"] ?>&type=accept" class="btnText">Accept</a>

                        </div>
                        <div class="button reject">
                            <a href="HandleReservation.php?id=<?= $row["id"] ?>&type=reject" class="btnText">Reject</a>

                        </div>
                    </div>
                </div>

            <?php }
        }

        ?>



    </div>

</body>

</html>