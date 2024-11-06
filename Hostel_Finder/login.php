<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: student_home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            justify-content: center;
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
            display: block;
            margin: auto;
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            width: 60%;
            font-size: 16px;

            display: block;
            margin: auto;
        }

        .btn:hover {
            background-color: #0056b3;
        }



        a {
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
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





        <form action="LoginValidation.php" method="GET">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="uname" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="pass" required>
            </div>

            <button type="submit" class="btn">Login</button>

        </form>
        <br><br>
        <a href="register.php">Create an account?</a>

    </div>


</body>

</html>