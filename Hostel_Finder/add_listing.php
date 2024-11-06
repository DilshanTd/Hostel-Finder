<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord - Add Listing</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        background-color: #F4F4F4;
    }

    .formContainer {
        background-color: white;
        width: 40%;
        margin: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px 20px;
        border-radius: 10px;
        margin-bottom: 100px;
    }

    .container {

        background-color: #fff;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 350px;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;

    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin: 15px 0;
    }

    .form-group input {
        width: 90%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin: auto;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        width: 30%;
        font-size: 16px;
        font-size: 20px;
        display: block;
        margin: auto;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .inp {
        width: 10px;
        height: 15px;
    }

    #txtarea {
        resize: none;
        width: 90%;
    }

    .title {
        text-align: center;
        margin-bottom: 70px;
        font-weight: 600;
        margin-top: -20px;
        font-size: 40px;

    }

    body {
        margin: 0;
        padding: 0;
    }
</style>

<body>
    <?php
    include "modals/user.php";
    include "navbar.php";
    ?>


    <br><br><br><br>
    <h1 class="title">Add Listing</h1>
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
    }

    ?>
    <div class="formContainer">
        <form action="ListingValidation.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Property Name :</label>
                <input class="inp" type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price :</label>
                <input type="number" id="price" name="price" step="any" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="txtarea" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="location">Google Map Coordinates :</label>
                <input class="inp" type="text" id="location" name="location" required>
                <br><br>
                <div id="map" style="height: 300px;"></div>
            </div>



            <br>
            <button type="submit" class="btn">Add Listing</button>
        </form>
    </div>


</body>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 6.825079, lng: 80.027289 },
            zoom: 14
        });
        var marker = new google.maps.Marker({
            map: map,
            position: { lat: 6.825079, lng: 80.027289 }, // Center the marker on Colombo
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById('location').value = event.latLng.lat().toFixed(6) + ', ' + event.latLng.lng().toFixed(6);
        });
    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-bI58GZNN6wjI0jWrkBkuQhuvpeTGvDI&callback=initMap"></script>

</html>