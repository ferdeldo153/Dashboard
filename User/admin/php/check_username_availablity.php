<?php 
sleep(1);
include("../../../resources/php/lib/sqli_conectv1.php");
include("../../../resources/php/lib/Cifrado.php");
include("../../../resources/php/lib/Util.php");
if($_REQUEST)
{
	$username 	= ($_REQUEST['username']);
	$con=new sqli();
	$idus=0+$con->getCat('user',"email='$username '",'id_user');
    if($idus > 0)
	{
		echo '<i class="fa fa-remove fa-fw" style="color:#F20101;">No Disponible</i>';
	}
	else
	{
		echo '<i class="fa fa-check fa-fw" style="color:#35E200;">Disponible</i>';
	}
	
}
?>