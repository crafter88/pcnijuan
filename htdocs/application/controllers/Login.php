<?php
class Login extends CI_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index()
	{

		if($this->session->userdata('user'))
		{
			if($this->session->userdata('user')->type === "owner"){
			      redirect('products');
			}else{
				  redirect('products');
			}
		}
		$this->load->view('login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->Login_Model->login($username, $password);

		if($user)
		{
			$this->session->set_userdata('user', $user);

			if($user->type === "owner"){
			      redirect('products');
			}else{
				  redirect('products');
			}
		}

		$this->session->set_userdata('invalid_login', true);
		redirect('/');	
	}

	public function logout()
	{
		session_destroy();
		redirect('/');
	}
}