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
// datos de usuario interface
$cuentasys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM tipo_cuenta WHERE id_tipo_cuenta='$tc'"));
$datosuser= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM cuenta WHERE id_user='$id'"));
$configuser= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracion WHERE id_user='$id'"));
$entrada_msg=  $con->getCount(" mensajes WHERE id_recibio='$id' AND visto=0");
$configsys= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM configuracioncuenta WHERE id_tipo_cuenta='".$datosuser['id_tipo_cuenta']."'"));
// datos de usuario interface
//datos del modulo
if(Checkapp($id,$con)==0){
	redirect($cuentasys['fallo'],0); 
}
$datosmudulo= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM modules WHERE id_modul=".getModulo()));
//datos del modulo
?>
<?php
include("../../resources/theme/Module/".$configuser['theme']);
	echo headopen1("Buscar actividades");
			if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
	echo headclose1();
	echo  body1($configuser);
	echo "  <div id='wrapper'>";
	echo main1($con,$datosuser,$configuser,$entrada_msg,$configsys,$cuentasys);
	echo mensajes1($con,$datosuser,$configuser,$entrada_msg,$configsys,$cuentasys);
	echo navp1($con,$datosuser,$configuser,$entrada_msg,$configsys,$cuentasys);
?>
        <div id="page-wrapper" style="background-color:<?php echo $configuser['bg1']?>;">
            <div class="row">
                <div class="col-lg-15">
                 			  <div class="row" style="background-color:<?php echo $configuser['bg0']?>;">
                <div class="col-lg-15" >
                   <p class="navbar-text pull-left">
				    <a href="index.php" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-home fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Home ></a>
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Buscar actividades ></a>
					</p>
				   
				   
                </div>
            </div>
                </div>
            </div>


			 <div class="row">
			  <div class="col-lg-15">
			  <br><br><br>
                  <form class='form-horizontal' role='form'method="post" action="find.php">
					  
					<div class="form-group">
					<label>Fecha:</label>
					<?php 
					date_default_timezone_set('america/mexico_city');
					$dia = date("Y-m-d");
					?>
					<input type="text" class="form-control" value="<?php echo $dia;?>" name="fecha">
					</div>
					<div class="form-group">
<strong>Acción:</strong>
 <select class="form-control" name="idact">
 <option value=0 ><p>Todas las acciones</p></option>
<?php
$RES=mysqli_query($con->get(),"SELECT * FROM `acciones`");	
while($r_res= mysqli_fetch_assoc($RES)){
echo "<option value=".$r_res['id_act']." ><p>".utf8_encode($r_res['act'])."</p></option>";
}
?>
 </select>
</div>
 <button class="btn btn-default" type="submit" name="enviar">Buscar</button>		
							
					</form>
					<br><br>
                <?php
					if ( isset($_REQUEST['enviar'])) {
							$date=$_POST['fecha'];
							$act=$_POST['idact'];
						$sql="SELECT fecha,time,email,acciones.act,descrip FROM log,acciones,user WHERE log.id_act=acciones.id_act AND log.id_user=user.id_user";
						if($act!=0)
							$sql.=" and log.id_act= $act ";
						
						$sql.=" and log.fecha='$date' ";
						$RES=mysqli_query($con->get(),$sql);	
							
					
						echo "
						    <table class='table table-bordered table-hover'>
						    <tr>
							<th><i class='fa fa-cube fa-lg' style='color:".$configuser['icon']."'></i>Usuario</th>
							<th><i class='fa fa-bell fa-lg' style='color:".$configuser['icon']."'></i>Acción</th>
							<th><i class='fa fa-exclamation fa-lg' style='color:".$configuser['icon']."'></i>Descripción</th>
							<th><i class='fa fa-calendar fa-lg' style='color:".$configuser['icon']."'></i>Fecha</th>
							<th><i class='fa fa-calendar fa-lg' style='color:".$configuser['icon']."'></i>Hora</th>
							</tr>";
							 while($r_res= mysqli_fetch_assoc($RES)){
								 echo "<tr>
									<td>".utf8_encode($r_res['email'])."</td>
									<td>".utf8_encode($r_res['act'])."</td>
									<td>".utf8_encode($r_res['descrip'])."</td>
									<td>".$r_res['fecha']."</td>
									<td>".$r_res['time']."</td>
									</tr>
									";
								 
								 
							 }
							
							
							echo "</table>";
							
					}
					?>
            </div>
        </div>
<?php
	echo bug();
	echo "</div>";
?>

<?php
if($configuser['scroll']==1){
	echo VA();
	}
	echo fooder1();
?>
