<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Folder</title>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <?php
        $userDestinationFolder = $requestedPath=="" ? $userDirectory : $userDirectory.$PATH_SEPARATOR.$requestedPath;
        $userDestinationFolder = $userDestinationFolder . $PATH_SEPARATOR . $_POST["foldername"];

        if (is_dir($userDestinationFolder)) {
            //NOTE to my self: is_dir is a bit faster than file_exists. ref:https://www.delftstack.com/howto/php/how-to-create-a-folder-if-it-does-not-exist-in-php/
            $result = "already exists.";
        }else{
            mkdir($userDestinationFolder, 0777, true);
            $result = "folder created.";
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
