<html>

<body>


    <?php

    include_once ("db_service.php");
    session_start();

    $email = $_GET['email'];
    $pass = $_GET['password'];
    $uname = $_GET['username'];
    $type = $_GET['type'];

    $isUnameTaken = false;

    $conn = OpenConn();

    $cmd = $conn->prepare("SELECT * from users where username=?");
    $cmd->bind_param("s", $uname);
    $cmd->execute();
    $result = $cmd->get_result();

    if ($result->num_rows > 0) {
        $isUnameTaken = true;
    } else {
        $isUnameTaken = false;
    }
    $cmd->close();
    $conn->close();



    if (strlen($uname) < 4) {
        $_SESSION["msg"] = "Username is too short";
        $_SESSION["color"] = "red";
        header("Location:register.php");
    } elseif (strlen($pass) < 4) {
        $_SESSION["msg"] = "Password is too short";
        $_SESSION["color"] = "red";
        header("Location:register.php");
    } elseif ($isUnameTaken) {
        $_SESSION["msg"] = "Username is already taken";
        $_SESSION["color"] = "red";
        header("Location:register.php");
    } else {

        $conn = OpenConn();

        $cmd1 = $conn->prepare("INSERT into users(email,username,password,type) values(?, ?, ?,?);");
        $cmd1->bind_param("ssss", $email, $uname, $pass, $type);
        $cmd1->execute();
        $cmd1->close();
        $conn->close();

        $_SESSION["msg"] = "Account created successfully";
        $_SESSION["color"] = "green";
        header("Location:login.php");





    }



    ?>
</body>

</html>