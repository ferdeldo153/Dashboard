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
$limmsg=$con->getlastsql("SELECT * FROM `mensajes` WHERE id_recibio='$id' ORDER by id_msg DESC","id_msg");
if(isset($_GET['msgn']))
	$limmsg=$_GET['msgn'];
$limmsg++;
$configsys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracioncuenta WHERE id_tipo_cuenta='".$datosuser['id_tipo_cuenta']."'"));
?>
<?php
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Bandeja de entrada");
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
                    <h1 class="page-header">Bandeja de entrada</h1>
                </div>
            </div>

			<div class="row">
                <div class="col-lg-15">
                    
					<table class="table table-bordered table-hover">
						<tr>
							<th><i class="fa fa-calendar fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Fecha</th>
							<th><i class="fa fa-group fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Usuario</th>
							<th><i class="fa fa-star fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Marcar</th>
							<th><i class="fa fa-check-circle fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Estado</th>
							<th><i class="fa fa-envelope fa-lg" style="color:<?php echo $configuser['icon']?>;"></i>Ver</th>
						</tr>	
						<?php
							 $id=$_SESSION[getUser()];
                              $RES=mysqli_query($con->get(),"SELECT * FROM mensajes WHERE id_recibio='$id' and id_msg<=$limmsg order by id_msg desc limit 10");
							$next=0;
                            while($r_res= mysqli_fetch_assoc($RES)){
								$next=$r_res['id_msg'];
								$ban="<a class='fa fa-circle fa-lg' style='color:".$configuser['icon']."'></a>";
								if($r_res['visto']==1)
									$ban="<a class='fa fa-check-circle fa-lg' style='color:".$configuser['icon']."'></a>";
									
								echo "<tr>
									  <td>".$r_res['fecha']."</td>
									  <td>".utf8_encode(($con->getCat('user'," id_user='".$r_res['id_envio']."' ",'email')))."</td>";
										$e=$con->getCount("`marcadormsg` WHERE id_user=$id and id_msg=".$r_res['id_msg']."");
									  if($e==0){
										  ?>
										  <td><a target='_blank' href="javascript:VALID('Quiere agregar a marcadores?','php/marcarmsg.php?msg=<?php echo $r_res['id_msg'];?>')"  class='fa fa-star-o fa-lg' style='color:<?php echo $configuser['icon'];?>'></a></td>
										  <?php
									}
									else
										echo "<td><a  href='#'  class='fa fa-star fa-lg' style='color:".$configuser['icon']."'></a></td>";
									echo " <td>$ban</td>
									  <td><a href='viewmsg.php?msg=".$r_res['id_msg']."' target='_blank' class='fa fa-envelope fa-lg' style='color:".$configuser['icon']."'></a></td>
									  </tr>
								";
							
							}
							$next--;
							$back=0+$con->getlastsql("SELECT * FROM mensajes WHERE id_recibio='$id' and id_msg>$limmsg order by id_msg DESC","id_msg");
							if($back==0)
								$back=$con->getlastsql("SELECT * FROM `mensajes` WHERE id_recibio='$id' ORDER by id_msg DESC","id_msg");
								
					    ?>
						
						<tr>
							<td><a  href="inputmsg.php?msgn=<?php echo $back?>" class="fa fa-caret-square-o-left fa-lg" style="color:<?php echo $configuser['icon']?>;"></a></td>
							<td  colspan="3"></td>
							<td><a  href="inputmsg.php?msgn=<?php echo $next?>" class="fa fa-caret-square-o-right fa-lg" style="color:<?php echo $configuser['icon']?>;"></a></td>
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