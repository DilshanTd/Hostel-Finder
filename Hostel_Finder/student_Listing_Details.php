<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bording booking web app (map)</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-bI58GZNN6wjI0jWrkBkuQhuvpeTGvDI&callback=initMap"
        async defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

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

        .reseveButton {
            display: block;
            margin-top: 10px;
            background-color: green;
            width: 60px;
            padding: 5px 15px;
            text-align: center;
            border-radius: 20px;
        }

        .reservedButton {
            width: 200px;
            display: block;
            margin-top: 10px;
            background-color: gray;
            opacity: 0.5;
            padding: 5px 15px;

            border-radius: 20px;

        }

        .reserveText {
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

    include ("db_service.php");
    include ("modals/user.php");
    include ("navbar.php");
    $id = $_GET["id"];
    $uid = $_SESSION["user"]->id;
    $alreadyReserved = false;
    $conn = OpenConn();

    $cmd1 = $conn->prepare("SELECT * FROM reservations WHERE user_id=? and property_id=?;");
    $cmd1->bind_param("ii", $uid, $id);
    $cmd1->execute();
    $result1 = $cmd1->get_result();
    if ($result1->num_rows > 0) {
        $alreadyReserved = true;
    } else {
        $alreadyReserved = false;
    }

    $cmd = $conn->prepare("SELECT * FROM properties WHERE id=?");
    $cmd->bind_param("i", $id);
    $cmd->execute();
    $result = $cmd->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageData = $row["image"];

        $array = explode(",", $row['location']);

        $latitude = $array[0];
        $longitude = $array[1];
        ?>

        <div id="map" style="height: 410px; width: 50%; float: left;"></div>
        <div id="bottom">
            <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" alt="Image">
            <div class="details">
                <div class="title">
                    <?= $row['name'] ?>
                </div>
                <div class="price">Price :
                    <?= $row["price"] ?>

                    <?php
                    if ($alreadyReserved == true) {
                        ?>
                        <div class="reservedButton">
                            <a class="reserveText">Go to Reservations Page</a>
                        </div>
                    </div>
                    <?php
                    } else {
                        ?>
                    <div class="reseveButton"><a class="reserveText"
                            href="ReservationValidation.php?id=<?= $row["id"] ?>">Reserve</a></div>
                </div>
                <?php
                    }
                    ?>

            <div class="description">
                <p>
                    <?= $row["description"] ?>
                </p>
            </div>
        </div>
        </div>

        <div id="pano" style="height: 410px; width: 50%; float: left;"></div>

        <script>
            let map;
            let studentMarker;
            let panorama;

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: <?= $latitude ?>, lng: <?= $longitude ?> },
                    zoom: 14,
                });


                studentMarker = new google.maps.Marker({
                    position: { lat: <?= $latitude ?>, lng: <?= $longitude ?> },
                    map: map,
                    title: "Student Location",
                });


                panorama = new google.maps.StreetViewPanorama(
                    document.getElementById("pano"), {
                    position: { lat: <?= $latitude ?>, lng: <?= $longitude ?> },
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                });
                map.setStreetView(panorama);


                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(updateStudentLocation);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
                panorama.setPosition(studentLocation);
            }


        </script>

    <?php }

    ?>



</body>

</html>