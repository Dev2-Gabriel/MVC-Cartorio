<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require './vendor/autoload.php';
        $home = new Core\ConfigController();
        $home->loadPage();
    ?>

    <script src="<?php echo URLADM ?>app/adms/assets/js/custom_adms.js"></script>
</body>
</html>