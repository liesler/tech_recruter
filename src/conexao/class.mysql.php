<?php
class conecta_mysql {
	var $handle   = "";
	var $database = "";
	
	function conecta_mysql($server="", $username="", $password="", $database=""){
		
		if($server!="" && $username!="" && $password!=""){
			 $this->handle = $this->connect($server, $username, $password);
		}
		
		if($database!=""){
			$this->select_db($database);
		}
	}
	
	function connect($server="", $username="", $password="", $new_link=""){
		$this->handle = mysqli_connect($server, $username, $password, $new_link);
		return $this->handle;
	}
	
	function select_db($database){
		$this->database = $database;
		return mysqli_select_db($this->handle, $database);
	}
}
?>