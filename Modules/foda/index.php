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
				<h1>Foda</h1>
				<table class="table">
  <tr>
    <td class="danger"> <h1>Debilidades</h1>
	<table class="table">
	<tr class="danger">
    <td><button name="" type="button" onclick="debili();"class="btn btn-danger" />+</button></td>
     <td><input name="" type="text" id="d"  class="form-control"  placeholder="Escribe algo.." required/></td>
	 </tr>
	 </table>
	 </td>
    <td class="warning">  <h1>Amenazas</h1>
	<table class="table">
	<tr class="warning">
    <td><button name="" type="button" onclick="ame();" class="btn btn-warning" />+</button></td>
    <td> <input name="" type="text" id="a" class="form-control"  placeholder="Escribe algo.." required/></td>
	 </tr>
	 </table>
	 </td>
  </tr>
  <tr>
    <td class="danger"><div id="debe"></div></td>
    <td class="warning"> <div id="amen"></div></td>
  </tr>
  <tr>
    <td class="info"> <h1>Fortalezas</h1>
	<table class="table">
	<tr class="info">
    <td><button name="" type="button" onclick="fotaliza();" class="btn btn-primary"/>+</button></td>
    <td> <input name="" type="text" id="f" class="form-control"  placeholder="Escribe algo.." required/></td>
	 	 </tr>
	 </table>
	 </td>

    <td class="success"><h1>Oportunidades</h1>
		 <table class="table">
	<tr class="success">
    <td><button name="" type="button" onclick="opor();"  class="btn btn-success" />+</button></td>
    <td> <input name="" type="text" id="op" class="form-control" placeholder="Escribe algo.." required/></td>
	 	 </tr>
	 </table>
	 </td>
  </tr>
  <tr>
    <td class="info"><div id="fota"></div></td>
    <td class="success"><div id="opo"></div></td>
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
?>
 <script type="text/javascript">
 function ame() {
			   var str=document.getElementById('a').value;
			   var t=document.getElementById('amen').outerHTML;
     document.getElementById('amen').innerHTML=t+'<p>-'+str+'</p>';
	 document.getElementById('a').value='';  
           }
 function debili() {
			   var str=document.getElementById('d').value;
			   var t=document.getElementById('debe').outerHTML;
     document.getElementById('debe').innerHTML=t+'<p>-'+str+'</p>';
	 document.getElementById('d').value='';   
           }
           function fotaliza() {
			   var str=document.getElementById('f').value;
			   var t=document.getElementById('fota').outerHTML;
     document.getElementById('fota').innerHTML=t+'<p>+'+str+'</p>'; 
	 document.getElementById('f').value='';  
           }
		   function opor() {
			   var str=document.getElementById('op').value;
			   var t=document.getElementById('opo').outerHTML;
     document.getElementById('opo').innerHTML=t+'<p>+'+str+'</p>'; 
	 document.getElementById('op').value='';  
           }
   </script>

<?php
	echo fooder1();
?>
