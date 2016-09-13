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
$con->execute("UPDATE `user_modulo` SET visita=visita+1 WHERE id_user=$id and id_modul=".getModulo());
$datosmudulo= mysqli_fetch_array(mysqli_query($con->get(),"SELECT * FROM modules WHERE id_modul=".getModulo()));
//datos del modulo
?>
<?php
include("../../resources/theme/Module/".$configuser['theme']);
	echo headopen1("Generador de contraseñas");
	if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
?>
 <script>
 function password(length, special) {
  var iteration = 0;
  var password = "";
  var randomNumber;
  if(special == undefined){
      var special = false;
  }
  while(iteration < length){
    randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
    if(!special){
      if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
      if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
      if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
      if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
    }
    iteration++;
    password += String.fromCharCode(randomNumber);
  }
   document.getElementById("total").innerHTML ="<center><h2>Contraseña Generada :</h2><br><h3>"+password+"</h3> <br></center>";   
}
 </script>
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
         <br><br>
            <div class="row">
                <div class="col-lg-15" style="background: #fff;">
                   <div style="background:<?php echo $configuser['bg1']?>;">                     
							<center>
                            <div id="total"> 
                                <center>
                                    <h2>Contraseña Generada :</h2>
                                </center><br>
                                <h3>  </h3>
                                <br>
                            </div>
							<hr>
							</center>
                         <center>  <label for="usr">Tamaño:</label> </center>
                        <input style="text-align:center" class="form-control"  type="number" id="tam"  name="tam" value=5 required >
                        <br>
						  <center>  <label for="usr">Caracteres especiales:</label> </center>
						 <select style="text-align:center" class="form-control"   id="espe" name="espe" required>
						<option value=true>SI</option>
						<option value=false>NO</option>
						</select>
                        <br>


                        <center>
                            <br>
                            <br>

                            <button type="button" 
                                    class="btn btn-primary btn-lg btn-lg btn-block "  
                                    onclick="password(document.getElementById('tam').value,document.getElementById('espe').value)" >Generar</button>

                        </center>
                        <br>
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
