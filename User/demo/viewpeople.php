<?php
include("../../resources/php/lib/sqli_conectv1.php");
include("../../resources/php/lib/Util.php");
include("../../resources/php/lib/Cifrado.php");
include("php/check.php");
session_start();
session_set_cookie_params(518400);
if(!isset($_SESSION[getActivo()])||!isset($_SESSION[getUser()])||!isset($_SESSION[getTipocuenta()])){
	 redirect("../../login.html",0);
}
$id=$_SESSION[getUser()];
$tc=$_SESSION[getTipocuenta()];
if(Check($id,$tc,$_SESSION[getActivo()])==0){
   redirect("../../login.html",0);  
}
$con=new sqli();
$datosuser= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM cuenta WHERE id_user='$id'"));
$configuser= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracion WHERE id_user='$id'"));
$entrada_msg=  $con->getCount(" mensajes WHERE id_recibio='$id' AND visto=0");
$configsys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracioncuenta WHERE id_tipo_cuenta='".$datosuser['id_tipo_cuenta']."'"));
?>
<?php
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Perfil");
	if($configuser['asistente']==1){
	echo asistente($con,$id);
	}
	echo headclose1();
	echo  body1($configuser);
	echo "  <div id='wrapper'>";
	echo main1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo mensajes1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo navp1($con,$datosuser,$configuser,$entrada_msg,$configsys);
?>
<?php
	$idus=$id;
	if(isset($_GET['user'])){
		$idus=$_GET['user'];
	}
	$datosus= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM cuenta WHERE id_user='$idus'"));
	$configus= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracion WHERE id_user='$idus'"));
?>

        <div id="page-wrapper" style="background-color:<?php echo $configus['bg1']?>;">
            <div class="row">
                <div class="col-lg-15">
                    <h1 class="page-header">Perfil</h1>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-15">
				<table class="table table-striped" >
				<tr>
						<td colspan="2" style="bgcolor:<?php echo $configus['bg0']?>;">
						<center><img src="../../resources/images/photo/<?php echo $configus['photo']?>" alt="user" class="img-circle" width="150px"></center>
						</td>
					</tr>
				<tr>
						<td  colspan="2" style="bgcolor:<?php echo $configus['bg0']?>;">
						<center><h3><?php echo utf8_encode(($con->getCat("user","id_user=".$idus,"email")));?></h3></center>
						</td>
					</tr>
				    <tr>
						<td style="bgcolor:<?php echo $configus['bg1']?>;"><h3 style="color:<?php echo $configus['hiper']?>;">Nombre</h3></td>
						<td style="bgcolor:<?php echo $configus['bg0']?>;"><h3><?php echo utf8_encode(Hmewdecodi($datosus['name']));?></h3></td>
					</tr>
					<tr>
						<td style="bgcolor:<?php echo $configus['bg1']?>;"><h3 style="color:<?php echo $configus['hiper']?>;">Apellido paterno:</h3></td>
						<td style="bgcolor:<?php echo $configus['bg0']?>;"><h3><?php echo utf8_encode(Hmewdecodi($datosus['apaterno']));?></h3></td>
					</tr>
					 <tr>
						<td style="bgcolor:<?php echo $configus['bg1']?>;"><h3 style="color:<?php echo $configus['hiper']?>;">Apellido materno:</h3></td>
						<td style="bgcolor:<?php echo $configus['bg0']?>;"><h3><?php echo utf8_encode(Hmewdecodi($datosus['amaterno']));?></h3></td>
					</tr>
					 <tr>
						<td style="bgcolor:<?php echo $configus['bg1']?>;"><h3 style="color:<?php echo $configus['hiper']?>;">Cuenta:</h3></td>
						<td style="bgcolor:<?php echo $configus['bg0']?>;"><h3><?php echo utf8_encode($con->getCat("tipo_cuenta","id_tipo_cuenta=".$datosus['id_tipo_cuenta'],"name_cuenta"));?></h3></td>
					</tr>
				
					
					</table>	
                </div>
            </div>
        </div>


 <?php
	echo bug();
	echo "</div>";
		if($configuser['scroll']==1){
	echo VA();
	}
	echo fooder1();
?>