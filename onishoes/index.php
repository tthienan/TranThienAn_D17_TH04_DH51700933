<?php 
  ob_start();
  session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>SHOP GIÀY NARUTO CHÀO MỪNG CÁC BẠN</title>
    <link href="webroot/font/Font Awesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="webroot/bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="webroot/web.css">
    <script src="webroot/jquery/jquery.js"></script>
    <script src="webroot/bootstrap4/js/bootstrap.js"></script>

</head>
<body >

   
    <?php
          include_once('config/database.php');
          include_once('view/element/header.php');
          include_once('controller/view-controller.php');
          include_once('view/element/footer.php');

	?>

</body>
</html>