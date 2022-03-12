<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Profile Image</title>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <form action="uploadProfileHandler.php" method="POST" enctype="multipart/form-data" onsubmit="isValidFile()">
        <input type="hidden" name="path" value="<?php echo $requestedPath; ?>">
        <label for="uploadedfile">file</label>
        <input type="file" name="uploadedfile" id="uploadedfile" onchange="return checkExtension()">
        <label id="fileState"></label>
        <input type="submit" value="upload">
    </form>

    <script type="text/javascript">
        const fileStateLabel = document.getElementById("fileState");
        var isValidExtension = false;

        function isPNG(){
            const fileName = document.getElementById("uploadedfile").value;
            const fileNameParts = fileName.split(".");
            const extension = fileNameParts[fileNameParts.length - 1];
            const isPNG = extension.toLowerCase()=="png";
            return isPNG;
        }

        function checkExtension(){
            if(isPNG()){
                fileStateLabel.innerHTML = "valid file.";
                fileStateLabel.style.color = "green";
                isValidExtension = true;
            }else{
                fileStateLabel.innerHTML = "invalid file(only png is accepted).";
                fileStateLabel.style.color = "red";
                isValidExtension = false;
            }
        }

        function isValidFile(){
            return isValidExtension;
        }
    </script>
</body>
</html>
