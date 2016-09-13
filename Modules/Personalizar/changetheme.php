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
	echo headopen1("Colores");
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
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Colores ></a>
					</p>	   
                </div>
                </div>
            </div>
			 <div class="row">
                <div class="col-lg-15">
				<h2><center>Colores</center></h2><br>
				<div class="col-lg-8 col-md-offset-2">
                 <div class="row">
					<form class='form-horizontal' role='form'  method='post' action='php/changet.php'>
					<table class="table table-hover table-responsive">
					<tr class="active">
					<td><strong>Elegir</strong></td>
					<td><strong>Nombre</strong></td>
					<td><strong>Icono</strong></td>
					<td><strong>Texto</strong></td>
					<td><strong>Barra</strong></td>
					<td><strong>Fondo</strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="1"> </td>
					<td><strong>Default</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#287EFF"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#00B6CE"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#F5F5F5"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#FEFEFE"></span></strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="2"> </td>
					<td><strong>Red</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#b6072b"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#6d0a1e"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#F5F5F5"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="6"> </td>
					<td><strong>Green</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#06B500"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#06B500"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#F5F5F5"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="5"> </td>
					<td><strong>DarkGreen</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#06B500"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#06B500"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#353333"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="3"> </td>
					<td><strong>DarkRed</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#FF0000"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#FF0000"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#353333"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="4"> </td>
					<td><strong>DarkBlue</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#008DFF"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#008DFF"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#353333"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					
					<tr class="active">
					<td><input type="checkbox" name="tema" value="7"> </td>
					<td><strong>WhiteBlack</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#000000"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#000000"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#FFFFFF"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="8"> </td>
					<td><strong>BlackWhite</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#FFFFFF"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#FFFFFF"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#353333"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="9"> </td>
					<td><strong>Fire</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#FFFF1A"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#FFFF1A"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#D70000"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					<tr class="active">
					<td><input type="checkbox" name="tema" value="10"> </td>
					<td><strong>Ice</strong></td>
					<td><strong><span class="fa fa-group fa-fw" style="color:#FFFFFF"></span></td>
					<td><strong><span class="fa fa-bold fa-fw" style="color:#FFFFFF"></span></strong></td>
					<td><strong><span class="fa fa-cog fa-fw" style="color:#008DFF"></span></strong></td>
					<td><strong><span class="fa fa-circle fa-fw" style="color:#fefefe"></span></strong></td>
					</tr>
					
					
					
					
					
					
					
					<tr class="active">
					<td colspan="5">
					<center>
					<div class='form-group'>
    					<div class='col-lg-8'>
      					<button type='submit' class='btn btn-default'>Aplicar</button>
    					</div>
  						</div>
						</center>
					<td>
					</tr>
					</table>
				    </form>
				
					
                </div>       
				</div> 
					
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