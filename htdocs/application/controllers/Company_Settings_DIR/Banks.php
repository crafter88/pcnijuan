<?php
class Banks extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
    }
    public function get(){
        echo json_encode(['data' => Co_Banks_Model::get($this->session->userdata('user'))]);
    }
    public function add(){
        $bank = [
                    'b_name' => $this->input->post('add-name'),
                    'b_shortname' => $this->input->post('add-shortname'),
                    'b_company' => 'company'
                ];
        $co_bank = [
                    'co_b_no' => $this->input->post('add-acc-no'),
                    'co_b_class' => $this->input->post('add-classification'),
                    'cb_id' => $this->session->userdata('user')->cb_id
                ];
        Co_Banks_Model::add($bank, $co_bank, $this->session->userdata('user'));
        redirect('company_settings/banks', 'refresh');
    }
    public function edit(){
        $bank = [
                    'b_code' => $this->input->post('edit-code'),
                    'b_name' => $this->input->post('edit-name'),
                    'b_shortname' => $this->input->post('edit-shortname')
                ];
        $co_bank = [
                    'co_b_no' => $this->input->post('edit-acc-no'),
                    'co_b_class' => $this->input->post('edit-classification')
                ];
        $b_id = $this->input->post('edit-bank-id');
        $co_b_id = $this->input->post('edit-cobank-id');
        Co_Banks_Model::edit($bank, $co_bank, $b_id, $co_b_id, $this->session->userdata('user'));
        redirect('company_settings/banks', 'refresh');
    }
    public function update(){
         $bank = [
                    'b_code' => $this->input->post('update-code'),
                    'b_name' => $this->input->post('update-name'),
                    'b_shortname' => $this->input->post('update-shortname'),
                    'b_company' => 'company'
                ];
        $co_bank = [
                    'co_b_no' => $this->input->post('update-acc-no'),
                    'co_b_class' => $this->input->post('update-classification'),
                    'cb_id' => $this->session->userdata('user')->cb_id
                ];
        $b_id = $this->input->post('update-bank-id');
        $co_b_id = $this->input->post('update-cobank-id');
        Co_Banks_Model::update($bank, $co_bank, $b_id, $co_b_id, $this->session->userdata('user'));
        redirect('company_settings/banks', 'refresh');
    }
    public function get_filter1(){
        $filter2 = $this->input->get('filter2');
        echo json_encode(Co_Banks_Model::get_filter1($this->session->userdata('user'), $filter2));
    }
    public function get_filter2(){
        $filter1 = $this->input->get('filter1');
        echo json_encode(Co_Banks_Model::get_filter2($this->session->userdata('user'), $filter1));
    }
    public function filter_table(){
        $filter1 = $this->input->get('filter1');
        $filter2 = $this->input->get('filter2');
        echo json_encode(['data' => Co_Banks_Model::filter_table($this->session->userdata('user'), $filter1, $filter2)]);
    }
}