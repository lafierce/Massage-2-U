<?php
class db {

	var $db_host = "massage2u.db.5700694.hostedresource.com";
	var $db_name = "massage2u";
	var $db_user = "massage2u";
	var $db_pass = "ADr9pj7ByIeZUM";
	var $sep = "|||";
	
	function set($varname,$value) {
		$this->$varname = $value;
	}
	
	function connect() {
		$db_link = mysql_connect($this->db_host,$this->db_user,$this->db_pass) or die ("unable to connect<br />\n" . mysql_error());
		$db_use = mysql_select_db($this->db_name,$db_link) or die ("unable to select db<br />\n" . mysql_error());
		return $db_link;
	}
	
	function genQuery($table,$cols,$qry) {
		$db_link = $this->connect();
		$query = "SELECT ".$option." ". $this->parseVals($cols,"cols") ." FROM " . $table . " WHERE " . $qry;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}

	function generic($qry) {
		$db_link = $this->connect();
		$query = $qry;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}
	
	function booleanQry($table,$cols,$qry) {
		$db_link = $this->connect();
		$query = "SELECT ". $this->parseVals($cols,"cols") ." FROM " . $table . " WHERE " . $qry;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		} else {
			$result = True;
		}
		return $result;
	}
	
	function readOne($table,$cols,$key,$keyval) {
		$db_link = $this->connect();
		$query = "SELECT ". $this->parseVals($cols,"cols") ." FROM ". $table ." WHERE ". $key ."=\"" . $keyval ."\"";
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 1) {
			$one_record = mysql_fetch_object($result);
		} else {
			$one_record = False;
		}
		return $one_record;
	}
	
	function readAll($table,$cols,$sort) {
		if (!$sort == "") {
			$sort = " ORDER BY " . $sort;
		} else {
			$sort = "";
		}
		$db_link = $this->connect();
		$query = "SELECT ". $this->parseVals($cols,"cols") ." FROM ". $table.$sort;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}
	
	function readManyLike($table,$cols,$key,$keyval,$sort) {
		if (!$sort == "") {
			$sort = " ORDER BY " . $sort;
		} else {
			$sort = "";
		}
		if ($key == "") {
			$key = "";
		} else {
			$key = " WHERE ". $key . " LIKE \"".$keyval."%\"";
		}
		$db_link = $this->connect();
		$query = "SELECT " . $this->parseVals($cols,"cols") . " FROM " . $table . $key . $sort;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}
	
	function readMany($table,$cols,$key,$keyval,$sort) {
		if (!$sort == "") {
			$sort = " ORDER BY " . $sort;
		} else {
			$sort = "";
		}
		if ($key == "") {
			$key = "";
		} else {
			$key = " WHERE ". $key . "=\"".$keyval."\"";
		}
		$db_link = $this->connect();
		$query = "SELECT " . $this->parseVals($cols,"cols") . " FROM " . $table . $key . $sort;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}
	
		function readManyMulti($table,$cols,$where,$sort) {
		if (!$sort == "") {
			$sort = " ORDER BY " . $sort;
		} else {
			$sort = "";
		}
		$db_link = $this->connect();
		$query = "SELECT " . $this->parseVals($cols,"cols") . " FROM " . $table . $where . $sort;
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		}
		return $result;
	}
	
	function readLast($table,$cols) {
		$db_link = $this->connect();
		$query = "SELECT " . $this->parseVals($cols,"cols") . " FROM " . $table . " ORDER BY id DESC";
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_num_rows($result) == 0) {
			$result = False;
		} else {
			$result = mysql_fetch_object($result);
		}
		return $result;
	}
	
	function insert($table,$cols,$vals) {
		$db_link = $this->connect();
		$query = "INSERT INTO ".$table." (" . $this->parseVals($cols,"cols") . ") VALUES (" . $this->parseVals($vals,"vals") .")";
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_errno($db_link) > 0) {
			$result = mysql_error($db_link);
		} else {
			$result = True;
		}
		return $result;
	}
	
	function update($table,$cols,$vals,$key,$keyval) {
		$db_link = $this->connect();
		// $columns = "date='$date',time='$time',event='$event',role='$role',company='$company',location='$location',description='$desc',url='$url',venue='$venue'";
		$query = "UPDATE ". $table ." SET " . $this->parseUpdateVals($cols,$vals) . " WHERE ". $key ."=\"" . $keyval."\"";
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_errno($db_link) > 0) {
			$result = False;
		} else {
			$result = True;
		}
		return $result;
	}
	
	function delete($table,$key,$keyval) {
		$db_link = $this->connect();
		// $columns = "date='$date',time='$time',event='$event',role='$role',company='$company',location='$location',description='$desc',url='$url',venue='$venue'";
		$query = "DELETE FROM ". $table ." WHERE ". $key ."=\"" . $keyval."\"";
		$result = mysql_query($query,$db_link) or die ("invalid query: [  $query  ]<br />\n" . mysql_error());
		if (mysql_errno($db_link) > 0) {
			$result = False;
		} else {
			$result = True;
		}
		return $result;
	}
	
	function parseUpdateVals($cols,$vals) {
		$cols = explode($this->sep,$cols);
		$vals = explode($this->sep,$vals);
		for ($i=0;$i<count($cols);$i++) {
			$col_vals .= $cols[$i] . "=\"" . $vals[$i] . "\",";
		}
		return substr($col_vals,0,strlen($col_vals)-1);
	}
	
	function parseVals($vals,$type) {
		$vals = explode($this->sep,$vals);
		if ($type == "cols") {
			for($i=0;$i<count($vals);$i++) {
				$values .= $vals[$i];
				if ($i < count($vals)-1) {
					$values .= ",";
				}
			}
		} else {
			for($i=0;$i<count($vals);$i++) {
				$values .= "\"".$vals[$i]."\"";
				if ($i < count($vals)-1) {
					$values .= ",";
				}
			}
		}
		return $values;
	}
	
	function setSelect($var,$val,$type) {
		if ($var == $val) {
			$select = " ".$type."=\"".$type."\"";
		} else {
			$select = "";
		}
		return $select;
	}
}

?>