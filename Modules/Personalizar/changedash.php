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
	echo headopen1("Dashboard");
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
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Dashboard ></a>
					</p>	   
                </div>
                </div>
            </div>
			 <div class="row">
                <div class="col-lg-15">
				<h2><center>Dashboard</center></h2><br>
				<div class="col-lg-8 col-md-offset-2">
                 <div class="row">
					<form class='form-horizontal' role='form'  method='post' action='php/chandash.php'>
					<table class="table table-hover table-responsive">
					<tr class="active">
					<td>Color de iconos</td>
					<td><select class="form-control" name="op_color">
  <option value=0>Default</option>
  <option value=1>Color</option>
  <option value=2>Aleatorio</option>
</select></td>
<td><input class="form-control" type="color"   name ="color" value="#ff0000" /></td>
					</tr>
			<tr class="active">
					<td>Tamaño de iconos</td>
					<td><select class="form-control" name="op_size">
  <option value=0>Default</option>
  <option value=1>Definir</option>
</select></td>
<td><select class="form-control" name="size">
  <option value="size11">1:1</option>
  <option value="size12">1:2</option>
  <option value="size13">1:3</option>
  <option value="size21">2:1</option>
  <option value="size22">2:2</option>
  <option value="size23">2:3</option>
  <option value="size31">3:1</option>
  <option value="size32">3:2</option>
  <option value="size33">3:3</option>
</select></td>
					</tr>
				<tr class="active">
				<td>Tamaño de iconos</td>
				<td >
<select class="form-control" name="op_sizeicon">
  <option value=0>Default</option>
  <option value=1>Definir</option>

</select></td>		
					<td >
<select class="form-control" name="sizeicon">
  <option value="60px">60px</option>
  <option value="80px" selected>80px</option>
    <option value="100px">100px</option>
	  <option value="150px">150px</option>
	    <option value="200px">200px</option>
</select></td>					
					</tr>
		<tr class="active">
				<td>Orden</td>
				<td>
<select class="form-control" name="orderby">
  <option value=0>Popular</option>
  <option value=1>Ultimos</option>
</select></td>	
<td>
<select class="form-control" name="limite">
<option value=5>5</option>
  <option value=9>9</option>
  <option value=10>10</option>
   <option value=20 selected>20</option>
    <option value=25>25</option>
    <option value=30>30</option>
	 <option value=50>50</option>
	  <option value=100>100</option>
</select></td>					
					</tr>
					
					
					
					
					
					<tr class="active">
					<td colspan="2">
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