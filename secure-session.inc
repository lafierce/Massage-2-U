<?php
// secure-session.inc

require("gen_db.inc");

class secure_session extends db {

	var $db="massage2u";
	var $table="user";
	var $auth_level=0;
	var $display_name;
	var $username;
	var $user_id;
	var $email;
	var $auth=False;
	var $sess_name="sess";
	var $sess_id;
	
	function set($varname,$value) {
		$this->$varname = $value;
	}
	
	function setVars($user_info) {
		$this->set('auth_level',$user_info->admin);
		$this->set('display_name',$user_info->disp_name);
		$this->set('username',$user_info->user_id);
		$this->set('user_id',$user_info->id);
		$this->set('email',$user_info->email);
		$this->set('auth',True);
		$this->set('sess_id',session_id());
	}
	
	function logout() {
		unset($user,$pass);
		session_unset();
		session_destroy();
	}
	
	function check() {
		if ($this->auth) {
			return True;
		} else {
			return False;
		}
	}
	
	function login($user,$pass) {
		$table=$this->db.".".$this->table;
		$qry="SELECT id,firstname,lastname,pass,email,sec_level,logged_on,last_logon FROM ".$table." WHERE email=\"".$user."\" AND pass=PASSWORD(\"".$pass."\")";
		if($user_info=mysql_fetch_object($this->generic($qry))) {
			$this->setVars($user_info);
			return true;
		} else {
			return false;
		}
	}


} // end class session
?>