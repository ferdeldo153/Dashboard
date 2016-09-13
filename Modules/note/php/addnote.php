<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/png" href="../../../resources/images/icon.png" />
    <link href="../../../resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../../resources/css/timeline.css" rel="stylesheet">
    <link href="../../../resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="../../../resources/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../../resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			<script src="../../../resources/js/sys.js"></script>
	<script src="../../../resources/js/bootbox.min.js"></script>
</head>
<body>

<?php 
include("../../../resources/php/lib/sqli_conectv1.php");
include("conect.php");
include("../../../resources/php/lib/Cifrado.php");
include("../../../resources/php/lib/Util.php");
session_start();
session_set_cookie_params(518400);
$id=$_SESSION[getUser()];
$txt=utf8_decode($_POST["txt"]); 

$con= new moduleDB();
$con->execute("INSERT INTO `note`VALUES (null,$id,'$txt','".datenow()."')");
msgBox("Nota Creada");
	redirect("../index.php",2); 

?>

</body>
</html>
