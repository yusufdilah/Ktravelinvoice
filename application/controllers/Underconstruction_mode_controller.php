<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Underconstruction_mode_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Underconstruction_mode_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["underconstruction_mode"] = $this->Underconstruction_mode_model->getAll();
        $this->load->view("underconstruction_mode/lihat_underconstruction_mode", $data);
    }

    public function add()
    {
        $underconstruction_mode = $this->Underconstruction_mode_model;
        $validation = $this->form_validation;
		$validation->set_rules($underconstruction_mode->rules());
        if ($validation->run()) {
            $underconstruction_mode->save();
            $this->session->set_flashdata('success', 'Tambah Underconstroction Mode dengan judul '.$underconstruction_mode->judul.' Berhasil Disimpan');
            redirect('Underconstruction_mode_controller');
        }

        $this->load->view("underconstruction_mode/tambah_underconstruction_mode");
    }

    public function edit($id){
    	$underconstruction_mode = $this->Underconstruction_mode_model; //object model
    	
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($underconstruction_mode->rules()); //terapkan rules di Underconstruction_mode_model.php

        if ($validation->run()) { //lakukan validasi form
            $underconstruction_mode->update($id); // update data
            $this->session->set_flashdata('success', 'Data Underconstroction Mode Berhasil Diubah');
            redirect('Underconstruction_mode_controller');
        }

		$data['underconstruction_mode'] = $this->Underconstruction_mode_model->getById($id);
        $this->load->view('underconstruction_mode/edit_underconstruction_mode', $data);
    }

    public function delete($id){
	    $this->Underconstruction_mode_model->delete($id); 
	    $this->session->set_flashdata('success', 'Data Underconstroction Mode Berhasil Dihapus');
	    redirect('Underconstruction_mode_controller');
	}
}
