<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Folder</title>
</head>
<body>
    <?php
        $requestedPath = array_key_exists("path", $_REQUEST) ? $_REQUEST["path"] : "";
    ?>
    <form action="createFolderHandler.php" method="POST">
        <input type="hidden" name="path" value="<?php echo $requestedPath; ?>">
        <label for="foldername">folder name:</label>
        <input type="text" name="foldername">
        <input type="submit" value="create">
    </form>
</body>
</html>
