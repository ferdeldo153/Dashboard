<?php 
include("../../../resources/php/lib/sqli_conectv1.php");
include("../../../resources/php/lib/Cifrado.php");
include("../../../resources/php/lib/Util.php");
session_start();
session_set_cookie_params(518400);
if(isset($_GET['msg'])){
	$id=$_SESSION[getUser()];
	$id_msg=$_GET['msg'];
	$con=new sqli();
	$e=$con->getCount("`marcadormsg` WHERE id_user=$id and id_msg=".$r_res['id_msg']."");
	if($e==0)
	$con->execute("INSERT INTO `marcadormsg` VALUES (null,$id,$id_msg)");
	redirect("../inputmsg.php",0);
}
else {
	redirect("../inputmsg.php",0);
}
?>