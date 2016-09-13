<?php 
include("../../../resources/php/lib/sqli_conectv1.php");
include("../../../resources/php/lib/Cifrado.php");
include("../../../resources/php/lib/Util.php");
session_start();
session_set_cookie_params(518400);
if(isset($_GET['user'])){
	$id=$_SESSION[getUser()];
	$id_msg=$_GET['user'];
	$con=new sqli();
	$e=$con->getCount(" `marcadoruser` WHERE id_dueno=$id and id_marcado=".$id_msg."");
	if($e==0)
	$con->execute("INSERT INTO `marcadoruser` VALUES (null,$id,$id_msg)");
	redirect("../finderuser.php",0);
}
else {
	redirect("../finderuser.php",0);
}
?>
