<?php
class Documents extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
    }
    public function get(){
        echo json_encode(array('data' =>Co_Documents_Model::get($this->session->userdata('user'))));
    }
     public function add(){
        $data = [
                    'd_class'=>$this->input->post('add-class'), 
                    'd_name'=>$this->input->post('add-name'), 
                    'd_shortname'=>$this->input->post('add-shortname'),
                    'j_id'=>$this->input->post('add-journal'),
                    'd_company'=>'company',
                ];
        $j_code = $this->input->post('add-journal-code');
        Co_Documents_Model::add($data, $j_code, $this->session->userdata('user'));
        redirect('company_settings/documents', 'refresh');
    }
    public function edit(){
        $data = [
                    'd_code'=>$this->input->post('edit-code'),
                    'd_class'=>$this->input->post('edit-class'), 
                    'd_name'=>$this->input->post('edit-name'), 
                    'd_shortname'=>$this->input->post('edit-shortname'),
                    'j_id'=>$this->input->post('edit-journal')
                ];
        $id = $this->input->post('edit-id');
        Co_Documents_Model::edit($data, $id, $this->session->userdata('user'));
        redirect('company_settings/documents', 'refresh');
    }
    public function update(){
        $data = [
                    'd_code'=>$this->input->post('update-code'),
                    'd_class'=>$this->input->post('update-class'), 
                    'd_name'=>$this->input->post('update-name'), 
                    'd_shortname'=>$this->input->post('update-shortname'),
                    'j_id'=>$this->input->post('update-journal'),
                    'd_company'=>'company',
                ];
        $id = $this->input->post('update-id');
        Co_Documents_Model::update($data, $id, $this->session->userdata('user'));
        redirect('company_settings/documents', 'refresh');
    }
    public function get_journals(){
        echo json_encode(Co_Documents_Model::get_journals($this->session->userdata('user')));
    }
    public function get_filter1(){
        echo json_encode(Co_Documents_Model::get_filter1($this->session->userdata('user')));
    }
    public function get_filter2(){
        echo json_encode(Co_Documents_Model::get_filter2($this->session->userdata('user')));
    }
    public function filter_table(){
        $filter1 = $this->input->get('filter1');
        $filter2 = $this->input->get('filter2');
        echo json_encode(['data'=> Co_Documents_Model::filter_table($this->session->userdata('user'), $filter1, $filter2)]);
    }
}