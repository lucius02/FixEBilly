<?php
error_reporting(0);
class db{
	var $con;
	function __construct() {
		$this->con = $this->connectDB();
	}
	
	function connectDB() {
		$con = pg_connect("host=localhost dbname=EBilly user=postgres password=WelKom7993");
		return $con;
	}

	//
	public function getRecords(){
		$query="SELECT * from sch_map.kenniskaart";
		$result=pg_query($this->con,$query);
		return $result;
	}

	public function getRecordsWhere($niveau){
		$query="SELECT onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating FROM sch_map.kenniskaart";
		$result=pg_query($this->con,$query);
		return $result;
	}

	public function closeCon(){
		pg_close($this->con);
	}
}
?>