<?php

class Products extends CI_Controller
{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$suppliers = $this->Products_Model->get_supplier();
		$products = $this->Products_Model->read();
		$this->load->view('index', ['content' => 'products', 'js' => 'js/products', 'suppliers' => $suppliers, 'products' => $products]);
	}

	public function create(){
		$name = '';
		if(file_exists($_FILES['image']['tmp_name']) ||  is_uploaded_file($_FILES['image']['tmp_name'])){
			$ext = explode(".", $_FILES["image"]["name"]);
			$name = $_POST['pname'].'.'.end($ext);

			move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $name);
		}
		$data = [
					'image' => $name,
					'prodName' => filter_var($this->input->post('pname'), FILTER_SANITIZE_SPECIAL_CHARS),
					'prodBrand' => filter_var($this->input->post('brand'), FILTER_SANITIZE_SPECIAL_CHARS),
					'prodDesc' => filter_var($this->input->post('desc'), FILTER_SANITIZE_SPECIAL_CHARS),
					'prodPrice' => $this->input->post('price'),
					'prodQty' => $this->input->post('qty'),
					'prodOrderLvl' => $this->input->post('relvl'),
					'suppID' => $this->input->post('supplier'),
					'date_added' => date('Y-m-d H:i:s')
				];
		$user = $this->session->userdata('user')->firstName.' '.$this->session->userdata('user')->lastName;
		$this->Products_Model->create($data, $user);
		redirect('products');
	}

	public function read(){
		echo json_encode(['data' => $this->Products_Model->read()]);
	}

	public function return_product(){
		$itemNum = $this->input->post('itemNum');
		$qty = $this->input->post('qty');
		$suppID = $this->input->post('suppID');
		$remaining_qty = $this->input->post('remaining_qty');
		$remarks = filter_var($this->input->post('remarks'), FILTER_SANITIZE_SPECIAL_CHARS);
		$return_date = $this->input->post('rDate');
		$user = $this->session->userdata('user')->firstName.' '.$this->session->userdata('user')->lastName;

		$this->Products_Model->return_product($itemNum, $qty, $suppID, $remaining_qty, $remarks, $return_date, $user);

		redirect('products');
	}

	public function checkin(){
		$qty_add = $this->input->post('qty_add');
		
	}
}