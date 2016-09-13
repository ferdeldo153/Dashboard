<?php 
	class moduleDB{
	private $conect;
	// inicia la conexion por default
	public function __construct(){
  	$username="u720798810_fer";
	$password="r0p0IpF6Ws";
	$hostname="localhost";
	$database="u720798810_sis";
	$this->conect= new mysqli($hostname, $username,$password, $database);
	if ($this->conect-> connect_errno) {
	die( "Fallo la conexión a MySQL: (".$this->conect-> mysqli_connect_errno().") ".$this->conect-> mysqli_connect_error());
	}
  	}
  	// cierra la conexion
  	public function close(){
  		mysqli_close($this->get()); 
  	}
  	// regresa la conexion
  	public function get(){
  		return $this->conect;
  	}
  	// execute("insert into table (value,value)")
	public function execute($query){
	mysqli_query($this->get(), $query);
	}
	// insert ("user","'name',year")
	public function insert($table,$query){
	mysqli_query($this->get(), "insert into ".$table." (".$query." )");
	}
	public function drop($table,$query){
	mysqli_query($this->get(), "delete ".$table." where ".$query." )");
	}
	public function update($table,$campo,$destino){
	mysqli_query($this->get(), "update ".$table." set ".$query." where ".$destino);
	}
public function getCount($sql){
$dato= mysqli_fetch_array(mysqli_query($this->get(), "SELECT COUNT(*) FROM ".$sql));
$iduser=0+$dato[0];
return $iduser;
}
public function getSUM($camp,$sql){
$dato= mysqli_fetch_array(mysqli_query($this->get(), "SELECT COUNT(".$camp.") FROM ".$sql));
$iduser=0+$dato[0];
return $iduser;
}
public function getlastsql($sql,$CAM){
	$sql=$sql." LIMIT 1";
	$res=mysqli_query($this->get(), $sql);
$d=mysqli_fetch_array($res);
$iduser=$d[$CAM];
return $iduser;
}		
public function getlast($TAB,$CAM){
$dato= mysqli_fetch_array(mysqli_query($this->get(), "SELECT ".$CAM." FROM ".$TAB." ORDER BY ".$CAM." DESC LIMIT 1"));
$iduser=$dato[$CAM];
return $iduser;
}
public function getCat($TAB,$CAM,$re){
//echo $TAB." ".$CAM." ".$re;
$dato= mysqli_fetch_array(mysqli_query($this->get(), "SELECT * FROM ".$TAB." WHERE ".$CAM." "));
//echo "SELECT * FROM ".$TAB." WHERE ".$CAM." ";
$iduser=$dato[$re];
return $iduser;
}
 public function __destruct() {
	mysqli_close($this->get()); 
	}
	}
?>
