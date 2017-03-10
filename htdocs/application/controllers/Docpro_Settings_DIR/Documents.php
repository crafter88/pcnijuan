<?php
class Documents extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        if(!($this->session->userdata('user'))){redirect('logout', 'refresh');}
    }
    public function get(){
        echo json_encode(['data' => Documents_Model::get($this->session->userdata('user'))]);
    }
    public function add(){
        $data = [
                    'd_class'=>$this->input->post('add-class'), 
                    'd_name'=>$this->input->post('add-name'), 
                    'd_shortname'=>$this->input->post('add-shortname'),
                    'j_id'=>$this->input->post('add-journal'),
                    'd_company'=>'docpro',
                ];
        $j_code = $this->input->post('add-journal-code');
        Documents_Model::add($data, $j_code, $this->session->userdata('user'));
        redirect('docpro_settings/documents', 'refresh');
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
        Documents_Model::edit($data, $id, $this->session->userdata('user'));
        redirect('docpro_settings/documents', 'refresh');
    }
    public function update(){
        $data = [
                    'd_code'=>$this->input->post('update-code'),
                    'd_class'=>$this->input->post('update-class'), 
                    'd_name'=>$this->input->post('update-name'), 
                    'd_shortname'=>$this->input->post('update-shortname'),
                    'j_id'=>$this->input->post('update-journal'),
                    'd_company'=>'docpro',
                ];
        $id = $this->input->post('update-id');
        Documents_Model::update($data, $id, $this->session->userdata('user'));
        redirect('docpro_settings/documents', 'refresh');
    }
    public function get_journals(){
        echo json_encode(Documents_Model::get_journals());
    }
    public function get_filter1(){
        echo json_encode(Documents_Model::get_filter1());
    }
    public function get_filter2(){
        echo json_encode(Documents_Model::get_filter2());
    }
    public function filter_table(){
        $filter1 = $this->input->get('filter1');
        $filter2 = $this->input->get('filter2');
        echo json_encode(['data'=> Documents_Model::filter_table($filter1, $filter2)]);
    }
}