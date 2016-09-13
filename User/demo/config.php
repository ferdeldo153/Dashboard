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
include("../../resources/theme/User/".$configuser['theme']);
	echo headopen1("Configuración");
	if($configuser['asistente']==1){
	echo asistente($con,$id);
	}
	echo headclose1();
	echo  body1($configuser);
	echo "  <div id='wrapper'>";
	echo main1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo mensajes1($con,$datosuser,$configuser,$entrada_msg,$configsys);
	echo navp1($con,$datosuser,$configuser,$entrada_msg,$configsys);
?>
		
        <div id="page-wrapper" style="background-color:<?php echo $configuser['bg1']?>;">
            <div class="row">
                <div class="col-lg-15">
                    <h1 class="page-header">Configuración de <?php echo " ".utf8_encode(Hmewdecodi($datosuser['name']))?></h1>
                </div>
			    <div class="row">
                <div class="col-lg-10">
 
					
<form class="form-horizontal" role="form" method="post" action="php/update.php" enctype = "multipart/form-data" >
					   
 <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label" name="passnew">Foto de perfil</label>
    <div class="col-lg-10">
     <table>
  <tr>
	  <center>
	  <img src="../../resources/images/photo/<?php echo $configuser['photo']?>" alt="user" class="img-circle" width="150px">
		  <br>
		  <br>
	  </center>
  </tr>
  <tr>
	  <input type="file" class="form-control" name="photo" >
  </tr>
</table>
    </div>
  </div>					   			   
	<div class="form-group">
		<label for="ejemplo_password_3" class="col-lg-2 control-label">Colores</label>
    <div class="col-lg-10">
		<table>
  <tr>
	<th><label for="ejemplo_password_3" class="col-lg-2 control-label">Iconos</label></th>
    <th><input type="color" name="icon" value="<?php echo $configuser['icon'];?>"></th>
	<th><label for="ejemplo_password_3" class="col-lg-2 control-label">Barra</label></th>
    <th><input type="color" name="bar" value="<?php echo $configuser['bar'];?>"></th>
	  <th><label for="ejemplo_password_3" class="col-lg-2 control-label">Fondo</label></th>
     <th><input type="color" name="bg0" value="<?php echo $configuser['bg0'];?>"></th>
  </tr>
   <tr>
	<th><label for="ejemplo_password_3" class="col-lg-2 control-label">Panel</label></th>
     <th><input type="color" name="bg1" value="<?php echo $configuser['bg1'];?>"></th>
	  <th><label for="ejemplo_password_3" class="col-lg-2 control-label">Texto</label></th>
     <th><input type="color" name="hiper" value="<?php echo $configuser['hiper'];?>"></th>
	 <th></th>
</tr>
</table>
    </div>
  </div>				   
	 <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label" >Contraseña nueva</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="passwordnew"name="passnew" placeholder="Contraseña nueva">
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Contraseña actual</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="passwordnow" placeholder="Contraseña actual" name="passnow" required>
    </div>
  </div>				   
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Guardar</button>
    </div>
  </div>
</form>
					
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
