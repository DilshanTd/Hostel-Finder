<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boarding booking web app (map)</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-bI58GZNN6wjI0jWrkBkuQhuvpeTGvDI&callback=initMap"
        async defer></script>
    <style>
        #bottom {
            display: flex;
            width: 100%;
            font-family: sans-serif;
            position: fixed;
            bottom: 0;
            left: 0;
            height: 220px;
            background-color: #f0f0f0;
            padding: 30px;
            text-align: left;
            margin: auto;
            border-radius: 40;
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.8);
            border-top: 3px solid black;
        }

        #bottom img {

            width: 280px;
            max-height: 250px;
            float: left;
            margin-right: 40px;
            border-radius: 15px;
            border: 2px solid black;
        }

        #bottom .title {
            font-size: 30px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            align-items: center;
        }

        #bottom .price {
            color: red;
            font-weight: 500;
            margin-bottom: 20px;
        }

        #bottom .description {
            color: #666;
        }

        .details {
            display: block;
        }

        .by {
            margin-left: 20px;
            font-size: 20px;

        }

        .button {

            margin-top: 10px;

            padding: 5px 15px;

            border-radius: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .buttons {
            display: flex;
        }

        .approve {
            background-color: green;
            width: 70px;
        }

        .reject {
            background-color: red;
            width: 60px;
        }

        .done {
            background-color: gray;
            width: 80px;
        }

        .btnText {
            text-decoration: none;
            margin-bottom: 5px;
            padding: 5px 0;
            font-weight: 600;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    include ("modals/user.php");
    include ("db_service.php");
    include ("navbar.php");



    $conn = OpenConn();
    $cmd = $conn->prepare("SELECT id, location FROM properties;");
    $cmd->execute();
    $result = $cmd->get_result();
    $markers = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $markers[] = array(
                'id' => $row['id'],
                'location' => $row['location']
            );
        }
    }
    ?>

    <div id="googleMap" style="width:100%;height:410px;"></div>

    <script>
        function initMap() {
            var mapProp = {
                center: { lat: 6.825079, lng: 80.027289 },
                zoom: 14
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            <?php
            foreach ($markers as $marker) {
                $array = explode(",", $marker['location']);
                $latitude = $array[0];
                $longitude = $array[1];
                ?>
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                    map: map,
                    title: '<?php echo $marker['id']; ?>' // Set the title to the id value
                });

                marker.addListener('click', function () {
                    window.location.href = "warden_home.php?id=" + this.getTitle(); // Use this.getTitle() instead of marker.getTitle()
                });
            <?php } ?>
        }
    </script>
    <?php

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $cmd1 = $conn->prepare("SELECT p.*, u.username FROM properties AS p JOIN users AS u on p.user_id=u.id WHERE p.id=?");
        $cmd1->bind_param("i", $id);
        $cmd1->execute();
        $result1 = $cmd1->get_result();
        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc(); ?>

            <div id="bottom">
                <img src="data:image/jpeg;base64,<?= base64_encode($row1["image"]) ?>" alt="Image">
                <div class="details">
                    <div class="title">
                        <?= $row1["name"] ?> <span class="by">By
                            <?= $row1["username"] ?>
                        </span>
                    </div>
                    <div class="price">Price :
                        <?= $row1["price"] ?>
                    </div>

                    <?php
                    if (!($row1["isApproved"])) { ?>

                        <div class="buttons">

                            <div class="button approve"><a class="btnText"
                                    href="ListingApproval.php?type=approve&id=<?= $row1["id"] ?>">Approve</a></div>
                            <div class="button reject"><a class="btnText"
                                    href="ListingApproval.php?type=reject&id=<?= $row1["id"] ?>">Reject</a></div>

                        </div>
                    <?php } else {
                        ?>
                        <div class="buttons">

                            <div class="button done"><a class="btnText">Approved</a></div>

                        </div>

                    <?php } ?>





                    <div class="description">
                        <p>
                            <?= $row1["description"] ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php }
    }

    ?>

</body>

</html>