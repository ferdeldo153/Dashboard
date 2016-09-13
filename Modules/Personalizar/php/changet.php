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
include("../../../resources/php/lib/Cifrado.php");
include("../../../resources/php/lib/Util.php");
$con=new sqli();
session_start();
session_set_cookie_params(518400);
$id=$_SESSION[getUser()];

if(isset($_POST['tema'])){
	$tema=0+$_POST['tema'];
	if($tema==1)
		$con->execute("UPDATE `configuracion` SET `icon`='#287EFF',`hiper`='#00B6CE',`bg1`='#FEFEFE',`bg0`='#F5F5F5',`bar`='#F5F5F5' WHERE id_user=$id");
	if($tema==2)
		$con->execute("UPDATE `configuracion` SET `icon`='#b6072b',`hiper`='#6d0a1e',`bg1`='#FEFEFE',`bg0`='#F5F5F5',`bar`='#F5F5F5' WHERE id_user=$id");
    if($tema==3)
		$con->execute("UPDATE `configuracion` SET `icon`='#FF0000',`hiper`='#FF0000',`bg1`='#FEFEFE',`bg0`='#353333',`bar`='#353333' WHERE id_user=$id");
	if($tema==4)
		$con->execute("UPDATE `configuracion` SET `icon`='#008DFF',`hiper`='#008DFF',`bg1`='#FEFEFE',`bg0`='#353333',`bar`='#353333' WHERE id_user=$id");
	if($tema==5)
		$con->execute("UPDATE `configuracion` SET `icon`='#06B500',`hiper`='#06B500',`bg1`='#FEFEFE',`bg0`='#353333',`bar`='#353333' WHERE id_user=$id");
	if($tema==6)
		$con->execute("UPDATE `configuracion` SET `icon`='#06B500',`hiper`='#06B500',`bg1`='#FEFEFE',`bg0`='#F5F5F5',`bar`='#F5F5F5' WHERE id_user=$id");
	if($tema==7)
		$con->execute("UPDATE `configuracion` SET `icon`='#000000',`hiper`='#000000',`bg1`='#FEFEFE',`bg0`='#FFFFFF',`bar`='#FFFFFF' WHERE id_user=$id");
	if($tema==8)
		$con->execute("UPDATE `configuracion` SET `icon`='#FFFFFF',`hiper`='#FFFFFF',`bg1`='#FEFEFE',`bg0`='#353333',`bar`='#353333' WHERE id_user=$id");
	if($tema==9)
		$con->execute("UPDATE `configuracion` SET `icon`='#FFFF1A',`hiper`='#FFFF1A',`bg1`='#FEFEFE',`bg0`='#D70000',`bar`='#D70000' WHERE id_user=$id");
	if($tema==10)
		$con->execute("UPDATE `configuracion` SET `icon`='#FFFFFF',`hiper`='#FFFFFF',`bg1`='#FEFEFE',`bg0`='#008DFF',`bar`='#008DFF' WHERE id_user=$id");
	
}



msgBox("Colores aplicados");
redirect("../changetheme.php",2); 	


?>

</body>
</html>
