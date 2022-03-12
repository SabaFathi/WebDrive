<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bye</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
    </style>
</head>
<body>
    <?php require_once("phpGlobalVariables.php"); ?>

    <?php session_unset(); session_destroy(); ?>

    <script type="text/javascript">
        const root = "<?php echo $server; ?>";
        function go_home(){
            window.location.href = root + "/index.html";
        }
    </script>
    <button onclick="go_home()">Home Page</button>
</body>
</html>
