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
session_start();
session_set_cookie_params(518400);
$id=$_SESSION[getUser()];
$con=new sqli();
$pass=$con->getCat('user',"id_user='$id'",'pass');
if($pass==Hmewcodi($_POST["passnow"])){
	if($_POST["passnew"]!=""){
		$pass=Hmewcodi($_POST["passnew"]);
		$con->execute("UPDATE user SET pass='$pass' WHERE id_user=$id");
	}
$icon=$_POST["icon"];
$bar=$_POST["bar"];
$bg0=$_POST["bg0"];
$bg1=$_POST["bg1"];
$hiper=$_POST["hiper"];
	$con->execute("UPDATE configuracion SET icon='$icon',hiper='$hiper',bg1='$bg1',bg0='$bg0',`bar`='$bar' WHERE id_user=$id");
$pho=$con->getCat("configuracion","id_user=".$id,"photo");
	if($_FILES['photo']['tmp_name']!=""){
		$ruta="../../../resources/images/photo/";// no sube de manera correcta
		opendir($ruta);
		$info = pathinfo($_FILES['photo']['name']);
		$nnombre = md5($con->getCat("user","id_user=".$id,"email")).".".$info['extension'];
		$destino=$ruta.$nnombre;
		if(copy($_FILES['photo']['tmp_name'],$destino)){
			$con->execute("UPDATE configuracion SET `photo`='$nnombre' WHERE id_user=$id");
		}
		else {
			$con->execute("UPDATE configuracion SET `photo`='user.png' WHERE id_user=$id");
		}
		if($pho!="user.png"){
				unlink($ruta.$pho);
			}
		
	}
	
	redirect("../config.php",0); 

}
else{
msgBox('Contraseña invalida');
	 redirect("../config.php",1); 
}

?>
</body>
</html>
