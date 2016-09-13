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
$limmsg=0+$con->getlastsql("SELECT marcadormsg.id_m_msg,marcadormsg.id_msg,mensajes.id_envio,mensajes.id_recibio,mensajes.fecha,mensajes.visto FROM marcadormsg,mensajes WHERE (marcadormsg.id_user=mensajes.id_envio or marcadormsg.id_user=mensajes.id_recibio) and marcadormsg.id_msg=mensajes.id_msg and marcadormsg.id_user=$id ORDER by marcadormsg.id_m_msg DESC","id_m_msg");
if(isset($_GET['msgn']))
	$limmsg=$_GET['msgn'];
$limmsg++;
$configsys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracioncuenta WHERE id_tipo_cuenta='".$datosuser['id_tipo_cuenta']."'"));
?>
<?php
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Marcadores");
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
                    <h1 class="page-header">Marcadores</h1>
                </div>
            </div>

			<div class="row">
                <div class="col-lg-15">
                    
					<table class="table table-bordered table-hover">
						<tr>
							<th><i class="fa fa-calendar fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Fecha</th>
							<th><i class="fa fa-group fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>De</th>
							<th><i class="fa fa-group fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Para</th>
							<th><i class="fa fa-star fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Desmarcar</th>
							<th><i class="fa fa-check-circle fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Estado</th>
							<th><i class="fa fa-envelope fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Ver</th>
						</tr>	
						<?php
							 $id=$_SESSION[getUser()];
 $RES=mysqli_query($con->get(),"SELECT marcadormsg.id_m_msg,marcadormsg.id_msg,mensajes.id_envio,mensajes.id_recibio,mensajes.fecha,mensajes.visto FROM marcadormsg,mensajes WHERE (marcadormsg.id_user=mensajes.id_envio or marcadormsg.id_user=mensajes.id_recibio) and marcadormsg.id_msg=mensajes.id_msg and marcadormsg.id_m_msg<=$limmsg and marcadormsg.id_user=$id ORDER by marcadormsg.id_m_msg DESC LIMIT 10");
							$next=0;
                            while($r_res= mysqli_fetch_assoc($RES)){
								$next=$r_res['id_m_msg'];
								$ban="<a class='fa fa-circle fa-lg' style='color:".$configuser['icon']."'></a>";
								if($r_res['visto']==1)
									$ban="<a class='fa fa-check-circle fa-lg' style='color:".$configuser['icon']."' ></a>";
									
								echo "<tr>
									  <td>".$r_res['fecha']."</td>
									  <td>".utf8_encode(($con->getCat('user'," id_user='".$r_res['id_envio']."' ",'email')))."</td>
									  <td>".utf8_encode(($con->getCat('user'," id_user='".$r_res['id_recibio']."' ",'email')))."</td>";
								?>
						<td><a target='_blank' href="javascript:VALID('Quiere quitar de marcadores?','php/desmarcarmsg.php?msg=<?php echo $r_res['id_m_msg'];?>')"  class='fa fa-star fa-lg' style='color:<?php echo $configuser['icon'];?>'></a></td>		
								<?php
									echo " <td>$ban</td>
									  <td><a href='viewmsg.php?msg=".$r_res['id_msg']."' target='_blank' class='fa fa-envelope fa-lg' style='color:".$configuser['icon']."'></a></td>
									  </tr>
								";
							
							}
							$next--;
							$back=0+$con->getlastsql("SELECT marcadormsg.id_m_msg,marcadormsg.id_msg,mensajes.id_envio,mensajes.id_recibio,mensajes.fecha,mensajes.visto FROM marcadormsg,mensajes WHERE (marcadormsg.id_user=mensajes.id_envio or marcadormsg.id_user=mensajes.id_recibio) and marcadormsg.id_msg=mensajes.id_msg and marcadormsg.id_m_msg>$limmsg and marcadormsg.id_user=$id ORDER by marcadormsg.id_m_msg DESC","id_m_msg");
							if($back==0)
								$back=0+$con->getlastsql("SELECT marcadormsg.id_m_msg,marcadormsg.id_msg,mensajes.id_envio,mensajes.id_recibio,mensajes.fecha,mensajes.visto FROM marcadormsg,mensajes WHERE (marcadormsg.id_user=mensajes.id_envio or marcadormsg.id_user=mensajes.id_recibio) and marcadormsg.id_msg=mensajes.id_msg and marcadormsg.id_user=$id ORDER by marcadormsg.id_m_msg DESC","id_m_msg");
								
					    ?>
						
						<tr>
							<td><a  href="marmsg.php?msgn=<?php echo $back?>" class="fa fa-caret-square-o-left fa-lg" style="color:<?php echo $configuser['icon']?>;"></a></td>
							<td  colspan="4"></td>
							<td><a  href="marmsg.php?msgn=<?php echo $next?>" class="fa fa-caret-square-o-right fa-lg" style="color:<?php echo $configuser['icon']?>;"></a></td>
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

