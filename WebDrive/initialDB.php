<?php
    $connection = mysqli_connect("localhost", "root", "");
    
    if (! $connection){
        die("Could not connect: Error no: " . mysqli_connect_errno() . " Error: " . mysqli_connect_error());
    }

    // Create database
    if (mysqli_query($connection,"CREATE DATABASE web_drive_project")) {
        echo "Database created";
    }else {
        die("Error creating database: " . mysqli_error($connection));
    }

    // Create tables
    $query_users = "CREATE TABLE web_drive_project.users (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, username varchar(20) NOT NULL, password varchar(32) NOT NULL, CONSTRAINT uniqe_username UNIQUE (username));";
    if(mysqli_query($connection, $query_users)){
        echo "Table users created.";
    }else{
        echo "can not create users table. error: " . mysqli_error($connection);
    }
    echo "<br/>";

    //define user(s)
    $query_usertesti1 = "INSERT INTO web_drive_project.users(username, password) values(\"usertesti1\", \"qwerty1234\")";
    if(mysqli_query($connection, $query_usertesti1)){
        echo "The user added.";
    }else{
        echo "can not insert the user. error: " . mysqli_error($connection);
    }
    echo "<br/>";

    mysqli_close($connection);
?>
