<?php 
function Check($id,$tc,$act){
if($id==null||$act==0){
   return 0;  
}
	return 1;
}
function getModulo(){
	return 5;
}
function Checkapp($id,$con){
$id_modulo=getModulo();
$accesoamodulo=$con->getCount(" user_modulo WHERE id_user='$id' AND id_modul=$id_modulo ");
if($accesoamodulo==0)
	return 0;
	return 1;
}

?>
