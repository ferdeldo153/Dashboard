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
	echo headopen1("Convertidor de Divisas");
		if($configuser['asistente']==1){
	echo asistente($con,$id,$cuentasys);
	}
?>
<script type="text/javascript" src="JS/money.js"></script>
<script>
            altiempo="Indicadores Actualizados al 27/04/2016";
            fx.base = "USD";
            fx.rates = {

                "AED": 3.672881,
                "AFN": 68.39,
                "ALL": 121.992501,
                "AMD": 479.459998,
                "ANG": 1.78875,
                "AOA": 165.780834,
                "ARS": 14.2492,
                "AUD": 1.316406,
                "AWG": 1.793333,
                "AZN": 1.50765,
                "BAM": 1.728971,
                "BBD": 2,
                "BDT": 78.39997,
                "BGN": 1.728344,
                "BHD": 0.376998,
                "BIF": 1552.5575,
                "BMD": 1,
                "BND": 1.349585,
                "BOB": 6.913446,
                "BRL": 3.530214,
                "BSD": 1,
                "BTC": 0.002220406423,
                "BTN": 66.497567,
                "BWP": 10.727688,
                "BYR": 19617.2,
                "BZD": 1.994441,
                "CAD": 1.260548,
                "CDF": 928.2065,
                "CHF": 0.971718,
                "CLF": 0.024602,
                "CLP": 667.482301,
                "CNY": 6.49533,
                "COP": 2938.094967,
                "CRC": 535.357402,
                "CUC": 1,
                "CUP": 0.999888,
                "CVE": 97.49675,
                "CZK": 23.89252,
                "DJF": 177.752376,
                "DKK": 6.577236,
                "DOP": 45.82719,
                "DZD": 109.164,
                "EEK": 13.841825,
                "EGP": 8.878317,
                "ERN": 14.9985,
                "ETB": 21.59212,
                "EUR": 0.88302,
                "FJD": 2.07745,
                "FKP": 0.68768,
                "GBP": 0.68768,
                "GEL": 2.229238,
                "GGP": 0.68768,
                "GHS": 3.819948,
                "GIP": 0.68768,
                "GMD": 42.5971,
                "GNF": 7527.340098,
                "GTQ": 7.739833,
                "GYD": 206.180336,
                "HKD": 7.756292,
                "HNL": 22.56274,
                "HRK": 6.608681,
                "HTG": 62.120862,
                "HUF": 275.3385,
                "IDR": 13202.35,
                "ILS": 3.755707,
                "IMP": 0.68768,
                "INR": 66.43598,
                "IQD": 1107.210686,
                "IRR": 30246,
                "ISK": 124.0628,
                "JEP": 0.68768,
                "JMD": 122.3073,
                "JOD": 0.708358,
                "JPY": 111.395299,
                "KES": 101.182741,
                "KGS": 68.54615,
                "KHR": 4012.952476,
                "KMF": 434.399581,
                "KPW": 900.09,
                "KRW": 1148.893324,
                "KWD": 0.301752,
                "KYD": 0.824275,
                "KZT": 331.683487,
                "LAK": 8115.717598,
                "LBP": 1509.628333,
                "LKR": 146.2806,
                "LRD": 90.50905,
                "LSL": 14.41935,
                "LTL": 3.027804,
                "LVL": 0.621342,
                "LYD": 1.336703,
                "MAD": 9.661792,
                "MDL": 19.71283,
                "MGA": 3180.08165,
                "MKD": 54.45476,
                "MMK": 1164.185025,
                "MNT": 1999.5,
                "MOP": 7.987314,
                "MRO": 347.721667,
                "MTL": 0.683602,
                "MUR": 35.026113,
                "MVR": 15.33,
                "MWK": 682.407623,
                "MXN": 17.35174,
                "MYR": 3.90635,
                "MZN": 53.05,
                "NAD": 14.42035,
                "NGN": 198.985601,
                "NIO": 28.36066,
                "NOK": 8.159341,
                "NPR": 106.351901,
                "NZD": 1.443489,
                "OMR": 0.384961,
                "PAB": 1,
                "PEN": 3.28671,
                "PGK": 3.150425,
                "PHP": 46.86057,
                "PKR": 104.7522,
                "PLN": 3.876701,
                "PYG": 5534.063333,
                "QAR": 3.640989,
                "RON": 3.946922,
                "RSD": 108.30434,
                "RUB": 65.36106,
                "RWF": 766.279876,
                "SAR": 3.750343,
                "SBD": 7.861335,
                "SCR": 13.197225,
                "SDG": 6.101399,
                "SEK": 8.095876,
                "SGD": 1.349904,
                "SHP": 0.68768,
                "SLL": 3942.5,
                "SOS": 603.081003,
                "SRD": 5.71,
                "STD": 21512.725,
                "SVC": 8.74191,
                "SYP": 219.518998,
                "SZL": 14.43535,
                "THB": 35.12924,
                "TJS": 7.8697,
                "TMT": 3.501433,
                "TND": 2.016667,
                "TOP": 2.217936,
                "TRY": 2.823203,
                "TTD": 6.632452,
                "TWD": 32.3392,
                "TZS": 2199.101667,
                "UAH": 25.19315,
                "UGX": 3341.63165,
                "USD": 1,
                "UYU": 31.9036,
                "UZS": 2906.125,
                "VEF": 9.972268,
                "VND": 22284.783333,
                "VUV": 106.901666,
                "WST": 2.533082,
                "XAF": 581.432606,
                "XAG": 0.057935,
                "XAU": 0.000801,
                "XCD": 2.70302,
                "XDR": 0.709663,
                "XOF": 582.537386,
                "XPD": 0.001638,
                "XPF": 105.612901,
                "XPT": 0.000976,
                "YER": 249.890001,
                "ZAR": 14.41721,
                "ZMK": 5252.024745,
                "ZMW": 9.49344,
                "ZWL": 322.322775  
            }

            function converter (dollar,aki ,hastas ){
                fx.settings = { from: aki, to: hastas };
                resultado=fx.convert(dollar);
                document.getElementById("total").innerHTML ="<center>El Resultado es :</center><br><h3>"+resultado.toFixed(4)+"</h3> <br>"+altiempo;    
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
					<a href="#" class="navbar-link" style="color:<?php echo $configuser['hiper'];?>;"><span class="fa fa-group fa-fw" style="color:<?php echo $configuser['icon']?>;"></span>Divisas ></a>
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
                                <center>
                                    El Resultado es :
                                </center><br>
                                <h3> 0.0000 </h3>
                                <br>
                            </div>
          
          </center>


                        <center> Selecciona Moneda Fuente </center>
                        <div class=" selectContainer">
                            <select class="form-control" name="size" id="fuente">
                                <option value="USD">USD - Dólar Estadounidesnse</option>
                                <option value="MXN">MXN - Peso Mexicano</option>
                                <option value="GBP">GBP - Libra Esterlina </option>
                                <option value="ARS">ARS - Peso Argentino</option>
                                <option value="AUD">AUD - Dólar Australiano </option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="BRL">BRL - Real Brasileño</option>
                                <option value="CAD">CAD - Dólar Canadiense </option>
                                <option value="CLP">CLP - Peso Chileno</option>
                                <option value="CNY">CNY - Yuan China</option>
                                <option value="COP">COP - Peso Colombiano</option>
                                <option value="CRC">CRC - Colon costarriqueño</option>
                                <option value="XOF">XOF - Franco</option>
                                <option value="DOP">DOP - Peso Dominicano</option>
                                <option value="GTQ">GTQ - Guatemala Quetzal</option>
                                <option value="HNL">HNL - Lempira Honduras</option>
                                <option value="INR">INR - Rupia india</option>
                                <option value="JPY">JYP - Yen Japon </option>
                                <option value="PAB">PAB - Panamá </option>
                                <option value="RUB">RUB - Rublo  Rusia</option>
                                <option value="TWD">TWD - Taiwan</option>
                                <option value="UAH">UAH - Grivna Ucrania</option>
                                <option value="AED">AED - Dirham Emiratos Arabes </option>
                                <option value="VEF">VEF - Bolivar fuerte Venezuela </option>

                            </select>
                        </div>


                        <center>
                            Selecciona Moneda Destino
                        </center>

                        <div class=" selectContainer"  >
                            <select class="form-control" name="size" id="destino" >
                                <option value="USD">USD - Dólar Estadounidesnse</option>
                                <option value="MXN">MXN - Peso Mexicano</option>
                                <option value="GBP">GBP - Libra Esterlina </option>
                                <option value="ARS">ARS - Peso Argentino</option>
                                <option value="AUD">AUD - Dólar Australiano </option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="BRL">BRL - Real Brasileño</option>
                                <option value="CAD">CAD - Dólar Canadiense </option>
                                <option value="CLP">CLP - Peso Chileno</option>
                                <option value="CNY">CNY - Yuan China</option>
                                <option value="COP">COP - Peso Colombiano</option>
                                <option value="CRC">CRC - Colon costarriqueño</option>
                                <option value="XOF">XOF - Franco</option>
                                <option value="DOP">DOP - Peso Dominicano</option>
                                <option value="GTQ">GTQ - Guatemala Quetzal</option>
                                <option value="HNL">HNL - Lempira Honduras</option>
                                <option value="INR">INR - Rupia india</option>
                                <option value="JPY">JYP - Yen Japon </option>
                                <option value="PAB">PAB - Panamá </option>
                                <option value="RUB">RUB - Rublo  Rusia</option>
                                <option value="TWD">TWD - Taiwan</option>
                                <option value="UAH">UAH - Grivna Ucrania</option>
                                <option value="AED">AED - Dirham Emiratos Arabes </option>
                                <option value="VEF">VEF - Bolivar fuerte Venezuela </option>

                            </select>
                        </div>

                        <center>
                            <br>
                            <br>
                            <input type="text" style="text-align:center" class="form-control" placeholder="Valor a Convertir" id="dollar">
                            <br>
                            <button type="button" class="btn btn-primary btn-lg btn-lg btn-block " onclick="converter(document.getElementById('dollar').value,document.getElementById('fuente').value, document.getElementById('destino').value )" >Convertir</button>

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
