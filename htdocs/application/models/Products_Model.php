<?php

class Products_Model extends CI_Model
{

	function __construct(){
		parent::__construct();
	}

	public function create($data, $user){
		$this->db->insert('products', $data);
		$itemNum = $this->db->insert_id();
		$this->db->insert('ledger', [
										'type' => 'checkin', 
										'date' => $data['date_added'], 
										'user' => $user, 
										'itemNum' => $itemNum, 
										'qty' => $data['prodQty'], 
										'total_remaining' => $data['prodQty'], 
										'remarks' => '', 
										'reason' => 'order', 
										'suppID' => $data['suppID']
						]);
	}

	public function read(){
		return $this->db->from('products p')->join('supplier s', 's.suppID=p.suppID')->where(['p.flag' => '1'])->order_by('p.date_added', 'desc')->get()->result();
	}

	public function get_supplier(){
		return $this->db->get_where('supplier', ['flag' => '1'])->result();
	}

	public function return_product($itemNum, $qty, $suppID, $remaining_qty, $remarks, $return_date, $user){
		$this->db->query("UPDATE products SET prodQty = prodQty + '".$qty."' WHERE itemNum='".$itemNum."'");

		$total_remaining = floatval($qty) + floatval($remaining_qty);
		$this->db->insert('ledger', ['type' => 'checkout', 'or_num' => '', 'date' => $return_date, 'user' => $user, 'itemNum' => $itemNum, 'qty' => $qty, 'total_remaining' => $total_remaining, 'remarks' => $remarks, 'reason' => $remarks, 'suppID' => $suppID]);
	}

	public function checkin(){
		
	}
}