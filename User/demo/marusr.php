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
	echo headopen1("Marcador");
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
                    <h1 class="page-header">Marcador de usuarios</h1>
                </div>
            </div>
			 <div class="row">
                <div class="col-lg-15">
                   
			<?php
				echo " <table class='table table-bordered table-hover'>
						    <tr>
							<th><i class='fa fa-cube fa-lg' style='color:".$configuser['icon']."'></i>Foto</th>
							<th><i class='fa fa-group fa-lg' style='color:".$configuser['icon']."'></i>Usuario</th>
							<th><i class='fa fa-star fa-lg' style='color:".$configuser['icon']."'></i>Desmarcar</th>
							<th><i class='fa fa-envelope fa-lg' style='color:".$configuser['icon']."'></i>Enviar</th>
							<th><i class='fa fa-eye fa-lg' style='color:".$configuser['icon']."'></i>Ver</th>
							</tr>";
							$con=new sqli();
						   $R=mysqli_query($con->get(),"SELECT * FROM marcadoruser WHERE id_dueno=$id ORDER by id_m_user DESC");
					while($r_res= mysqli_fetch_assoc($R)){
						$idus=$r_res['id_marcado'];
						$pho=$con->getCat("configuracion","id_user=".$idus,"photo");
							echo "<tr>
							<td><img src='../../resources/images/photo/$pho' alt='user' class='img-circle' width='50px'></td>
							<td>".utf8_encode(($con->getCat("user","id_user=".$idus,"email")))."</td>";
							?>
							<td><a  href="javascript:VALID('Quiere quitar de marcadores?','php/desmarcaruser.php?user=<?php echo$idus;?>')" target='_blank' class='fa fa-star fa-lg' style='color:<?php echo $configuser['icon'];?>'></a></td>
							
							<?php
							echo "<td><a  href='new.php?user=$idus' target='_blank' class='fa fa-envelope fa-lg' style='color:".$configuser['icon']."'></a></td>
							<td><a  href='viewpeople.php?user=$idus' target='_blank' class='fa fa-eye fa-lg' style='color:".$configuser['icon']."'></a></td>
							</tr>
							";	
					}
							echo "</table>";
				
				?>
				
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
