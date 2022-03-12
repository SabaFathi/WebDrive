<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload To Your Drive</title>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <form action="uploadFileHandler.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="path" value="<?php echo $requestedPath; ?>">
        <label for="uploadedfile">file</label>
        <input type="file" name="uploadedfile">
        <input type="submit" value="upload">
    </form>
</body>
</html>
