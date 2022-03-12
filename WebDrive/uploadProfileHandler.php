<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Profile Image</title>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <?php
        $userDestinationFile = $userProfileDirectory . $PATH_SEPARATOR . $username . ".png";

        if (!is_dir($userProfileDirectory)) {
            //NOTE to my self: is_dir is a bit faster than file_exists. ref:https://www.delftstack.com/howto/php/how-to-create-a-folder-if-it-does-not-exist-in-php/
            mkdir($userProfileDirectory, 0777, true);
        }

        if($_FILES["uploadedfile"]["error"] > 0){
            $result = "Return Code: " . $_FILES["uploadedfile"]["error"];
        }elseif($_FILES["uploadedfile"]["size"] > $MAX_FILE_SIZE_LIMIT){
            $result = "The file size exceeds the limit allowed and cannot be saved.";
        }else{
            if(file_exists($userDestinationFile)){
                $savingState = " successfully updated.";
            }else{
                $savingState = " successfully saved.";
            }

            $isSuccessfull = move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $userDestinationFile);
            //NOTE to my self: If the destination file already exists, it will be overwritten. ref:https://www.php.net/manual/en/function.move-uploaded-file.php
            
            if($isSuccessfull){
                $result = $_FILES["uploadedfile"]["name"] . $savingState;
            }else{
                $result = "upload faild.";
            }
        }

        $href = $server . $PATH_SEPARATOR. "driveView.php" . $pathParameter;
    ?>

    <script type="text/javascript">
        const result = "<?php echo $result; ?>";
        alert(result);
        window.location.href = "<?php echo $href; ?>";
    </script>
</body>
</html>
