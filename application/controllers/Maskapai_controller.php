<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Maskapai_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->model("Divisi_model");
        $this->load->model("Pic_model");
        $this->load->model("Maskapai_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["dataCustomer"] = $this->Customer_model->getAll();
        $data["pic"] = $this->Pic_model->getAll();
        $data["maskapai"] = $this->Maskapai_model->getAll();
        $data["dataDivisi"] = $this->Divisi_model->getAll();
        $this->load->view("maskapai/lihat_maskapai", $data);
    }

    public function add()
    {
        $maskapai = $this->Maskapai_model;
        $validation = $this->form_validation;
		    $validation->set_rules($maskapai->rules());
        if ($validation->run()) {
            $maskapai->save();
            $this->session->set_flashdata('success', 'Tambah Maskapai Berhasil Disimpan');
            redirect('Maskapai_controller');
        }

        $this->load->view("maskapai/lihat_maskapai");
    }

  //   public function edit($id){

  //   	$faq = $this->Customer_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Maskapai_controller');
  //       }

  //       // $faq= $this->Customer_model->getById($id);
		// $data['list_divisi'] = $this->Customer_model->getById($id);
  //       $this->load->view('customer/lihat_customer', $data);
  //   }

    public function edit(){
    	$dataMaskapai    = $this->input->post();
    	$id 	    = $dataMaskapai['maskapai_id'];
    	$maskapai        = $this->Maskapai_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($maskapai->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $maskapai->update($id); // update data
            $this->session->set_flashdata('success', 'Data Maskapai Berhasil Diubah');
            redirect('Maskapai_controller');
        }
    }

	

    public function delete($id){
	    $this->Maskapai_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Maskapai Berhasil Dihapus');
	    redirect('Maskapai_controller');
	}

}
