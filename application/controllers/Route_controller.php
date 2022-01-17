<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Route_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Route_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        // $data["dataPic"] = $this->Pic_model->getAll();
        $data["route"] = $this->Route_model->getAll();
        $this->load->view("route/lihat_route", $data);
    }

    public function add()
    {
        $route = $this->Route_model;
        $validation = $this->form_validation;
		    $validation->set_rules($route->rules());
        if ($validation->run()) {
            $route->save();
            $this->session->set_flashdata('success', 'Tambah Route Berhasil Disimpan');
            redirect('Route_controller');
        }

        $this->load->view("route/lihat_route");
    }

    public function edit(){
      	$dataRoute = $this->input->post();
      	$id 	= $dataRoute['route_id'];
      	$route = $this->Route_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($route->rules()); //terapkan rules di Divisi_model.php

        if ($validation->run()) { //lakukan validasi form
            $route->update($id); // update data
            $this->session->set_flashdata('success', 'Data Route Berhasil Diubah');
            redirect('Route_controller');
        }
    }


    public function delete($id){
	    $this->Route_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Route Berhasil Dihapus');
	    redirect('Route_controller');
	}
}
