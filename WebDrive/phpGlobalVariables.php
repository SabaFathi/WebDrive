<?php
    $PATH_SEPARATOR = "/";
    $server = "http://localhost/WebDrive";
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    $userDirectory = "upload" . $PATH_SEPARATOR . $username;
    $userProfileDirectory = "profile";
    $requestedPath = array_key_exists("path", $_REQUEST) ? $_REQUEST["path"] : "";
    $pathParameter = $requestedPath=="" ? "" : "?path=".$requestedPath;
    $avatarPath = file_exists("profile".$PATH_SEPARATOR.$username.".png") ? "profile".$PATH_SEPARATOR.$username.".png" : "profile".$PATH_SEPARATOR."default.png";
    $MAX_FILE_SIZE_LIMIT = 20000000; //~20MB
?>
