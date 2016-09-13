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
	echo headopen1("Nuevo mensaje");
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
                    <h1 class="page-header">Mensaje</h1>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-8 col-md-offset-2">
					<form class='form-horizontal' role='form'  method='post' action='php/enviarmsg.php'>
					<table class="table table-hover">
					<tr>
						<td rowspan="4" width="150px"><img src="../../resources/images/photo/<?php echo $configuser['photo']?>" alt='user' class='img-circle' width='150px'></td>
						 <td><strong>De:</strong><?php echo utf8_encode(($con->getCat("user","id_user=".$id,"email")));?></td>
					</tr>
					<tr>
						 <td><strong>Para:</strong>
					     <div class="form-group">
							 <?php
							 if(isset($_GET['user'])){
								 $n=utf8_encode(($con->getCat("user","id_user=".$_GET['user'],"email")));
							 echo "<input type='text' class='form-control' id='username' name='username' value='$n' readonly='readonly'>";
							 }
							else
							 	echo "<input type='text' class='form-control' id='username' name='username' required>";
							 ?>
							 <div id="Info"></div>
						</div></td>
					</tr>
					<tr>
						  <td><strong>Fecha:</strong><?php echo datenow(); ?> </td>
					</tr>
					<tr>
						 <td><strong>Hora:</strong><?php echo timenow(); ?></td>
					</tr>
					</table>
					<table class="table table-hover">
						<tr><td>
							<div class='form-group'>
  						<label for='comment'>Mensaje:</label>
 					    <textarea class='form-control' rows='5' id='comment' name='txt' required></textarea>
						 </div>
						 <div class='form-group'>
    					<div class='col-lg-8'>
      					<button type='submit' class='btn btn-default'>Enviar</button>
    					</div>
  						</div>
					</td></tr>
					</table>
						    </form>
				
					
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
	<script type="text/javascript" src="../../resources/js/jquery-1.3.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {	
	$('#username').blur(function(){
		
		$('#Info').html('<img src="../../resources/images/loader.gif" alt="" />').fadeOut(1000);

		var username = $(this).val();		
		var dataString = 'username='+username;
		
		$.ajax({
            type: "POST",
            url: "php/check_usermsg.php",
            data: dataString,
            success: function(data) {
				$('#Info').fadeIn(1000).html(data);
				//alert(data);
            }
        });
    });              
});  
</script>  
<?php
	echo fooder1();
?>
