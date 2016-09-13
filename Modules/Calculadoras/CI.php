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
	echo headopen1("Calculadora de interes ");
	if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
?>
			<script>
            function converter (Mtotal,Interes,Plazo,TipoPlazo ){
                PlazoA=Plazo;
                if(TipoPlazo=="ME"){
                    PlazoA=(Plazo*30)/(360);
                }
                if(TipoPlazo=="AN"){
                    Plazo=(Plazo*12);
                }
                pt=Interes/100;
                resultado=Mtotal*pt*PlazoA;
                resultado2=Mtotal*(Math.pow((1+pt),Plazo));
                document.getElementById("total").innerHTML ="<center>El Resultado del  interes simple es :</center><h3>$"+resultado.toFixed(4)+"</h3>" + "<center>El Resultado del  interes Compuesto es :</center><h3>$"+resultado2.toFixed(4)+"</h3>";    
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
                <div class="col-lg-15">
                 			  <div class="row" style="background-color:<?php echo $configuser['bg0']?>;">
                <div class="col-lg-15" >
                   <p class="navbar-text pull-left">
				    <a href="index.php" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-home fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Home ></a>
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Interes ></a>
					</p>	   
                </div>
                </div>
            </div>
         <br><br>
            <div class="row">
                <div class="col-lg-15" style="background: #fff;">
                   <div style="background:<?php echo $configuser['bg1']?>;">                     
							<center>
                            <div id="total"> 
                                El Resultado del interes simple es :
                                <h3>$0.0000</h3>
								El Resultado del interes Compuesto es :
                                 <h3>$0.0000</h3>
                             </div>
							<hr>
							</center>
                        <center>  <label for="usr">Inserte monto Capital inicial:</label> </center>
                        <input type="text"  style="text-align:center" class="form-control" placeholder="Monto Capital en pesos - MXN" id="Mtotal">
                        <br>
                        <center>  <label for="usr">Inserte la tasa de interes % :</label> </center>
                        <input type="text" style="text-align:center"  class="form-control" placeholder="Tasa de interes Anual - solo numero" id="Interes">
                        <br>
                        <center>  <label for="usr">Plazo para pagar  en Años o Meses :</label> </center>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" style="text-align:center" class="form-control" placeholder="Plazo para Pagar" id="Plazo">
                            </div>
                            <div class="col-md-4">
                                <div class=" selectContainer"> 
                                    <select class="form-control" name="size" id="TipoPlazo">
                                        <option value="AN">Años</option>
                                        <option value="ME">Meses</option>

                                    </select>
                                </div>
                            </div>
                        </div>
						<br>
                        <center>
                            <button type="button" 
                                    class="btn btn-primary btn-lg btn-lg btn-block " 
                                    onclick="converter(
                                             document.getElementById('Mtotal').value,
                                             document.getElementById('Interes').value, 
                                             document.getElementById('Plazo').value,
                                             document.getElementById('TipoPlazo').value

                                             )" >Calcular</button>

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
