<?php
class Login_Model extends CI_Model
{
	function __construct(){
		parent::__construct();
	}

	public function login($username, $password){
		$user = false;
		$result = $this->db->limit(1)->from('accounts a')->join('employee e', 'e.empID = a.empID')->where(['username' => $username])->get()->result();
		if(count($result) > 0){
			$row = $result[0];
			if(password_verify($password, $row->password)){
				$user = $row;
			}
		}	
		return $user;
	}
}