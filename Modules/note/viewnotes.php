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
	echo headopen1("Ver Notas");
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
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Ver Notas ></a>
					</p>
				   
				   
                </div>
            </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-15">
                    <h1 class="page-header">Ver Notas</h1>
                </div>
            </div>

			 
			 <div class="row">
                 <div class="col-lg-15">
					 <table class="table">
					<tr>
						<td><strong>Fecha</strong><td>
						<td><strong>Nota</strong><td>
					</tr>	
<?php
					include("php/conect.php");
					$con2= new moduleDB();
					 $RES=mysqli_query($con2->get(),"SELECT * FROM `note` WHERE id_user=".$_SESSION[getUser()]." ORDER by id_note DESC LIMIT 30");
                            while($r_res= mysqli_fetch_assoc($RES)){	
							echo "<tr>
									<td>".utf8_encode($r_res['date'])."<td/>
									<td>".utf8_encode($r_res['nota'])."<td/>
								</tr>";
							
							}	   
					
?>	   
					 
					 </table>

                </div>
            </div>
			
			<!-- Dejar  -->
			 <div id="morris-bar-chart"></div>
			  <div id="morris-area-chart"></div>
			   <div id="morris-donut-chart"></div>
			<!-- Dejar  -->
        </div>
<?php
	echo bug();
	echo "</div>";
	if($configuser['scroll']==1){
	echo VA();
	}
	echo fooder1();
?>

