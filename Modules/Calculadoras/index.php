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
// aumenta las visitas por usuario
$con->execute("UPDATE `user_modulo` SET visita=visita+1 WHERE id_user=$id and id_modul=".getModulo());
$datosmudulo= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM modules WHERE id_modul=".getModulo()));
//datos del modulo
?>
<?php
include("../../resources/theme/Module/".$configuser['theme']);
	echo headopen1($datosmudulo['name']);
	if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
?>
		<link rel="stylesheet" type="text/css" href="../../resources/bower_components/metro/css/style.css" />
		<style type="text/css">
			.free-wall {
				margin: 40px;
			}
		</style>
<?php
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
                    <h1 class="page-header">Aplicación: <?php echo $datosmudulo['name'];?></h1>
                </div>
            </div>

			 
			 <div class="row">
                <div class="col-lg-15">
				<?php
					$dashconfig= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM dashboardconfig WHERE id_user='$id'"));
					$color=RandColor();
					if($dashconfig['op_color']==1) // color definido
						   $color=$dashconfig['color'];
				?>
                 <div id="freewall" class="free-wall">
				  <div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='CI.php' title='Calcule el interes'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Interes</h2><br> </center>
						</a>
						</div>
						</div>				
				<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='Iva.php' title='Calcule el Iva'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Iva</h2><br> </center>
						</a>
						</div>
						</div>	
				<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='Hipo.php' title='Calculadora de Cuotas Mensuales Hipotecas'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Hipoteca</h2><br> </center>
						</a>
						</div>
						</div>	
			
			<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='Divi.php' title='Convertidor de Divisas'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Divisas</h2><br> </center>
						</a>
						</div>
						</div>	
						
			<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='long.php' title='Convertidor de Longitudes'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Longitudes</h2><br> </center>
						</a>
						</div>
						</div>	
						<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='super.php' title='Convertidor de Superficies'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Superficies</h2><br> </center>
						</a>
						</div>
						</div>	
						
						<div class='brick size21' style='background:<?php echo $color;?>'>
						<div class='cover'>
						<a href='vol.php' title='Convertidor de Volumenes'>
						<center><IMG SRC='icon.png' class='img-responsive' width='80px'>
						<h2>Volumenes</h2><br> </center>
						</a>
						</div>
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
?>
	<!--
		Dash metro
		-->
		<script type="text/javascript" src="../../resources/bower_components/metro/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="../../resources/bower_components/metro/js/freewall.js"></script>
		<script type="text/javascript" src="../../resources/bower_components/metro/js/centering.js"></script>
		<script type="text/javascript">
			$(function() {
				var wall = new Freewall("#freewall");
				wall.reset({
					selector: '.brick',
					animate: true,
					cellW: 160,
					cellH: 160,
					delay: 50,
					onResize: function() {
						wall.fitWidth();
					}
				});
				wall.fitWidth();

				var temp = '<div class="brick {size}"><div class="cover"></div></div>';
				var size = "size23 size22 size21 size13 size12 size11".split(" ");
				$(".add-more").click(function() {
					var	html = temp.replace('{size}', size[size.length * Math.random() << 0]);
					wall.prepend(html);
				});
			});
		</script>
<?php
	echo fooder1();
?>