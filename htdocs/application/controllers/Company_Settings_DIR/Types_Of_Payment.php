<?php

class Types_Of_Payment extends CI_Controller{

	function __construct(){
		parent::__construct();

		if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
	}

	public function get(){
		echo json_encode(['data' => Types_Of_Payment_Model::get()]);
	}
}