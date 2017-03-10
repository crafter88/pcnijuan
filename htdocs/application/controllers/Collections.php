<?php

class Collections extends MY_Controller{
	function __construct(){
		parent::__construct("master_layout");

		if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
	}
	public function get_collections(){
		$this->load->view($this->layout, ['head_css'=>'fragments/head_css/bookofaccounts/collections', 'top_navbar'=>'fragments/top_navbar/global_top_navbar', 'content'=>'fragments/content/bookofaccounts/collections', 'footer_js'=>'fragments/footer_js/bookofaccounts/collections', 'back_button'=>'../home', 'active_nav'=>'home']);
	}

}