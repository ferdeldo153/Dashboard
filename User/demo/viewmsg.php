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
if(!isset($_GET['msg'])){
 redirect("index.php",0); 
}
$e=$con->getCount("`mensajes` WHERE (id_envio=$id or id_recibio=$id) and id_msg=".$_GET['msg']."");
if($e==0)
	 redirect("index.php",0); 
$configsys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracioncuenta WHERE id_tipo_cuenta='".$datosuser['id_tipo_cuenta']."'"));
?>
<?php
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Mensaje");
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
        <div id="page-wrapper" style="background-color:<?php echo $configuser['bg1']?>;">
            <div class="row">
                <div class="col-lg-15">
                    <h1 class="page-header">Mensaje</h1>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-8 col-md-offset-2">
                   <?php 
					$id=$_SESSION[getUser()];
					 $RES=mysqli_fetch_assoc(mysqli_query($con->get(),"SELECT * FROM `mensajes` WHERE (id_envio=$id or id_recibio=$id) and id_msg=".$_GET['msg'].""));
					$pho=$con->getCat("configuracion","id_user=".$RES['id_envio'],"photo");
					?>
					<table class="table table-hover">
					<tr>
						<td rowspan="4" width="150px"><?php echo "<img src='../../resources/images/photo/$pho' alt='user' class='img-circle' width='150px'>"?></td>
						 <td><strong>De:</strong><?php echo utf8_encode(($con->getCat("user","id_user=".$RES['id_envio'],"email")));?></td>
					</tr>
					<tr>
						 <td><strong>Para:</strong><?php echo utf8_encode(($con->getCat("user","id_user=".$id,"email")));?></td>
					</tr>
					<tr>
						  <td><strong>Fecha:</strong><?php echo $RES['fecha']; ?> </td>
					</tr>
					<tr>
						 <td><strong>Hora:</strong><?php echo $RES['hora']; ?></td>
					</tr>
					</table>
					<table class="table table-hover">
					<tr>
						 <td><strong>Mensaje:</strong></td>
					</tr>
					 <tr>
						 <td><strong><?php echo utf8_encode($RES['txt']); ?></strong></td>
					</tr>
					<?php
						$e=$con->getCount("`mensajes` WHERE  id_recibio=$id and id_msg=".$_GET['msg']."");
						if($e!=0){
						$con->execute("UPDATE `mensajes` SET `visto`=1 WHERE id_msg=".$_GET['msg']);
						echo "<tr><td>
							<form class='form-horizontal' role='form'  method='post' action='php/responder.php?msg=".$_GET['msg']."&us=".$RES['id_envio']."'>
							<div class='form-group'>
  						<label for='comment'>Responder:</label>
 					    <textarea class='form-control' rows='5' id='comment' name='txt' required></textarea>
						 </div>
						 <div class='form-group'>
    					<div class='col-lg-8'>
      					<button type='submit' class='btn btn-default'>Responder</button>
    					</div>
  						</div>
						    </form>
							</td></tr>";
						
						}
					
					?>
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
