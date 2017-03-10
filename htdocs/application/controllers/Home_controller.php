<?php

class Home_controller extends MY_Controller{
	
	function __construct(){
		parent::__construct('fragments_public/master_layout');

		if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
	}
	
	public function index(){
		return $this->load->view($this->layout, ['active_nav' => 'home', 'content' => 'fragments_public/pages/main_page']);
	}
}

?>