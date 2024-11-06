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
    <title>Registration Form</title>
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
            width: 60%;
            font-size: 16px;

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

        a {
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Register</h2>

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

        <form action="RegisterValidation.php" method="GET">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="inp" type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="inp" type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="inp" type="password" id="password" name="password" required>
            </div>


            <div class="form-group">
                <label for="phone">Type:</label>
                <select name="type" id="type">
                    <option value="student">Student</option>
                    <option value="landlord">Landlord</option>

                </select>
            </div>
            <br>
            <button type="submit" class="btn">Register</button>
        </form>
        <br><br>
        <a href="login.php">Already have an account?</a>
    </div>

    </form>
    </div>
</body>

</html>