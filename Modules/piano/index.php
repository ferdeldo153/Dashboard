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
	echo headopen1(utf8_encode($datosmudulo['name']));
			if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
?>
<link rel="stylesheet" type="text/css" href="piano.css" />
        <meta property="og:image" content="http://mrcoles.com/media/img/piano-visual-mode.png">
        <link rel="image_src" href="http://mrcoles.com/media/img/piano-visual-mode.png" />
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
                    <h1 class="page-header"><?php echo utf8_encode($datosmudulo['name']);?></h1>
                </div>
            </div>
			 <div class="row">
			 <br><br><br>
                <div class="col-lg-15">
                     <div id="content">
            <div id="content-inner">
                <div id="piano">
                    <h1>Piano</h1>
                    <div class="help show" tabindex="1">
                        <div class="help-inner">
                            <div id="synth-settings"></div>
                            <div class="opts">
                                <p><strong>Controls:</strong></p>
                                <p>play using home row &amp; above &nbsp; /</p>
                                <p>change playable keys: “,” &amp; “.” &nbsp; /</p>
                                <p>shift keyboard: ← &amp; → <span id="shift"></span></p>
                            </div>
                            <div class="opts">
                                <p><strong>Extras:</strong></p>
                                <p class="toggle-color toggle hold">Color - c &nbsp; /</p>
                                <p class="toggle-demo toggle">Demo - m &nbsp; /</p>
                                <p class="toggle-animate toggle">Visual mode - 8 &nbsp; /</p>
                                <p class="toggle-looper">Looper - 9 &nbsp; /</p>
                                <p>Help - 0</p>
                            </div>
                        </div>
                    </div>
                    <div class="loop" tabindex="2">loop</div>
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
        <script src="jquery-1.7.1.min.js"></script>
        <script src="audio.js"></script>
        <script src="piano.js"></script>
<?php
	echo fooder1();
?>
