<?php session_start(); ?>

<?php require_once("phpGlobalVariables.php"); ?>

<?php
    $username = $_POST["username"];
    $password = $_POST["password"];
    $db = "web_drive_project";

    $connection = mysqli_connect("localhost", "root", "");
    if(! $connection){
        echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
        die("Could not connect to database!");
    }
    mysqli_select_db($connection, $db);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);
    if(!$result || mysqli_num_rows($result) == 0){
        echo "Invalid username or password. Please return and try again<br/>";
        echo "<a href='$server'>Home Page</a>";
        session_unset();
        session_destroy();
    }else{
        $_SESSION["username"] = $username;

        $href = "DriveView.php";
        header("Location: $href");
    }

    mysqli_close($connection);
?>
