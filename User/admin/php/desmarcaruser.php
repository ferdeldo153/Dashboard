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
	$con->execute("DELETE FROM `marcadoruser` WHERE id_marcado=$id_msg and id_dueno=$id");
	redirect("../marusr.php",0);
}
else {
	redirect("../marusr.php",0);
}
?>
