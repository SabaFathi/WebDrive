<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <style>
        body{direction: ltr; padding: 20px;}
    </style>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <?php
        $username = $_POST["username"];
        $password = $_POST["password"];
        $db = "web_drive_project";

        if($username == "default"){
            $result = "defaul cannot use as an username.";
        }else{
            $connection = mysqli_connect("localhost", "root", "");
            if(! $connection){
                $result = "Could not connect to database!";
                echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
                die($result);
            }
            mysqli_select_db($connection, $db);

            $query_insert_user = "INSERT INTO users (username, password) VALUES ('$username', '$password');";
            if(mysqli_query($connection, $query_insert_user)){
                $result = "account created.";
            }else{
                $result = "can not insert user. error: ";
                die($result . mysqli_error($connection));
            }

            mysqli_close($connection);
        }

        $href = $server . $PATH_SEPARATOR. "index.html";
    ?>

    <script type="text/javascript">
        const result = "<?php echo $result; ?>";
        alert(result);
        window.location.href = "<?php echo $href; ?>";
    </script>
</body>
</html>
