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
                <div class="col-lg-15">
                  <table class="table">
<tr>
<td  class="active"><video id="v">Video</video></td>
<td  class="active"><canvas id="c">Imagen</canvas></td>
<tr>
<td  class="active" colspan="2"><button id="t" class="btn btn-primary btn-lg btn-lg btn-block ">Tomar foto</button></td>
<table>
                </div>
            </div>
        </div>
<?php
	echo bug();
	echo "</div>";
?>
<script>
	window.addEventListener('load',init());
	function init(){
			var video=document.querySelector('#v'),
			canvas=document.querySelector('#c'),
			btn=document.querySelector('#t'),
			img=document.querySelector('#img');
			navigator.getMedia =(
			navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msgetUserMedia
			);
		if(navigator.getMedia ){
			navigator.getMedia (
			{video:true},
			function(stream){
			video.src=window.URL.createObjectURL(stream);
			video.play();
			},
			function(e){console.log(e);})
		
		}
		else {
		 alert('Navegador no soportado');
		
		}
		video.addEventListener('loadedmetadata',function (){
			canvas.width=video.videoWidth;
			canvas.height=video.videoHeight;
		},false);
		btn.addEventListener('click',function (){
			canvas.getContext('2d').drawImage(video,0,0);
			var imgData=canvas.toDataURL('image/png');
			//img.setAttribute('src',imgData);
		})
		
	
	}
</script>
<?php
if($configuser['scroll']==1){
	echo VA();
	}
	echo fooder1();
?>
