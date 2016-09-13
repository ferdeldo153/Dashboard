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
	$con->execute("DELETE FROM `marcadormsg` WHERE id_m_msg=$id_msg and id_user=$id");
	redirect("../marmsg.php",0);
}
else {
	redirect("../marmsg.php",0);
}
?>
