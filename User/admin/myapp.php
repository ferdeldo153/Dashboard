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
$idapp=0;
if(!isset($_GET['app']))
	redirect("index.php",0);
else
	$idapp=0+$_GET['app'];
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Buscar");
	if($configuser['asistente']==1){
	echo asistente($con,$id);
	}
?>

<!--
		Dash metro
		-->
		<link rel="stylesheet" type="text/css" href="../../resources/bower_components/metro/css/style.css" />
		<style type="text/css">
			.free-wall {
				margin: 40px;
			}
		</style>
		<!--
		Dash metro
		-->
<?php
	echo headclose1();
	echo  body1($configuser);
	echo "  <div id='wrapper'>";
	echo main1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo mensajes1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo navp1($con,$datosuser,$configuser,$entrada_msg,$configsys);
?>

        <div id="page-wrapper"  style="background-color:<?php echo $configuser['bg1']?>;">
            <div class="row">
                <div class="col-lg-15">
                    <h1 class="page-header">Aplicaciones en <?php echo utf8_encode($con->getCat('tipo_module',"id_tipo_module='$idapp'",'nombre'));?></h1>
                </div>
            </div>
 <div class="row">
                <div class="col-lg-15">
				<div id="freewall" class="free-wall">
				   <?php
				   $dashconfig= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM dashboardconfig WHERE id_user='$id'"));
		$RES=mysqli_query($con->get(),"SELECT modules.name,modules.icon,modules.color,modules.size,modules.iconsize,modules.descrip,modules.ruta FROM user_modulo,modules WHERE  user_modulo.id_modul=modules.id_modul and modules.id_tipo_module=$idapp and user_modulo.id_user=$id ORDER by user_modulo.visita desc");	
				   while($r_res= mysqli_fetch_assoc($RES)){
					   $color=$r_res['color'];
					    if($dashconfig['op_color']!=0)// color aleatorio
						   $color=RandColor();
					   if($dashconfig['op_color']==1) // color definido
						   $color=$dashconfig['color'];
					   echo "
					   <div class='brick size21' style='background: ".$color.";'>
						<div class='cover'>
						<a href='".$r_res['ruta']."' title='".utf8_encode($r_res['descrip'])."'>
						<center><IMG SRC='".$r_res['icon']."' class='img-responsive' width='80px'>
						<h2>".utf8_encode($r_res['name'])."</h2></center>
						</a>
						</div>
						</div>";
					 	}				   
				   ?>
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
				<!--
		Dash metro
		-->
<?php
	echo fooder1();
?>

