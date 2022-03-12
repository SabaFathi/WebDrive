<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Drive</title>
    <link rel="stylesheet" type="text/css" href="style/DriveViewStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <?php
        if($username == ""){
            echo "not accessible";
            exit();
        }
    ?>

    <div id="profile">
        <img id="avatar" src="<?php echo $avatarPath."?nocache=".time(); ?>" onclick="changeProfileImage()">
        <label><?php echo $username; ?></label>
        <button onclick="logout()">logout</button>
    </div>
    <script type="text/javascript">
        const server = "<?php echo $server; ?>";
        const pathSeparator = "<?php echo $PATH_SEPARATOR; ?>";
        function changeProfileImage(){
            const pathParameter = "<?php echo $pathParameter; ?>";
            window.location.href = server + pathSeparator + "uploadProfileForm.php" + pathParameter;
        }
        function logout(){
            window.location.href = server + pathSeparator + "userLogout.php";
        }
    </script>

    <div id="path-info">
        <?php
            $currentDirectory = $requestedPath=="" ? "root" : "root".$PATH_SEPARATOR.$requestedPath;
            echo "<label>" . $currentDirectory . "</label>";
        ?>
    </div>

    <?php
        $directoryPath = $requestedPath=="" ? $userDirectory : $userDirectory.$PATH_SEPARATOR.$requestedPath;
        if(!is_dir($directoryPath)){
            mkdir($directoryPath, 0777, true);
        }
        $directoryContent = scandir($directoryPath);
        $folders = array();
        $files = array();

        foreach($directoryContent as $index => $name){
            if(!in_array($name, array(".",".."))){
                if(is_dir($directoryPath . $PATH_SEPARATOR . $name)){
                    array_push($folders, $name);
                }else{
                    array_push($files, $name);
                }
            }
        }
    ?>

    <div id="drive-content">
        <div id="folders">
            <?php
                if($requestedPath == ""){
                    //it is root directory
                }else{
                    $pathSeprated = explode($PATH_SEPARATOR, $requestedPath);
                    array_pop($pathSeprated);
                    $parrentDir = implode($PATH_SEPARATOR, $pathSeprated);
                    $parrentURL = $server . $PATH_SEPARATOR . "DriveView.php";
                    if($parrentDir == ""){
                        //parrent == root
                    }else{
                        $parrentURL = $parrentURL . "?path=" . $parrentDir;
                    }
                    echo "<div class=\"folder\">";
                    echo "<a href=\"$parrentURL\" style=\"color: black;\">";
                    echo     "<i class=\"fa fa-level-up fa-4x\" aria-hidden=\"true\"></i>";
                    echo "</a>";
                    echo "<label>Parrent Directory</label>";
                    echo "</div>";
                }
                foreach($folders as $index => $folderName){
                    $newPathParameter = $pathParameter=="" ? "?path=".$folderName : $pathParameter.$PATH_SEPARATOR.$folderName;
                    echo "<div class=\"folder\">";
                    echo     "<div class=\"complete-ovrlap\">";
                    echo         "<i class=\"fa fa-folder fa-4x complete-ovrlap-item\" aria-hidden=\"true\"></i>";
                    echo         "<a href=\"$newPathParameter\" class=\"complete-ovrlap-item complete-ovrlap-hoveritem\">Open</a>";
                    echo     "</div>";
                    echo     "<label>" . $folderName . "</label>";
                    echo "</div>";
                }
            ?>
        </div>
        <div id="files">
            <?php
                foreach($files as $index => $fileName){
                    echo "<div class=\"file\">";
                    echo     "<div class=\"complete-ovrlap\">";
                    echo         "<i class=\"fa fa-file fa-4x complete-ovrlap-item\" aria-hidden=\"true\"></i>";
                    echo         "<i class=\"fa fa-download fa-2x complete-ovrlap-item complete-ovrlap-hoveritem\" aria-hidden=\"true\" onclick=\"downloadFile('$fileName')\"></i>";
                    echo     "</div>";
                    echo     "<label>". $fileName . "</label>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

    <div id="operations">
        <button onclick="uploadFile()">upload/update file</button>
        <button onclick="createFolder()">create new folder</button>
    </div>

    <script type="text/javascript">
        const serverURL = "<?php echo $server; ?>";
        function uploadFile(){
            const pathParameter = "<?php echo $pathParameter; ?>";
            window.location.href = serverURL + pathSeparator + "uploadFileForm.php" + pathParameter;
        }

        function downloadFile(fileName){
            var pathParameter = "<?php echo $pathParameter; ?>";
            if(pathParameter==""){
                pathParameter = "?path=" + fileName;
            }else{
                pathParameter = pathParameter + pathSeparator + fileName;
            }
            window.location.href = serverURL + pathSeparator + "downloadFile.php" + pathParameter;
        }

        function createFolder(){
            const pathParameter = "<?php echo $pathParameter; ?>";
            window.location.href = serverURL + pathSeparator + "createFolderForm.php" + pathParameter;
        }
    </script>
</body>
</html>
