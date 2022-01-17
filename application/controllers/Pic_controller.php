<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pic_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->model("Divisi_model");
        $this->load->model("Pic_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["dataCustomer"] = $this->Customer_model->getAll();
        $data["pic"] = $this->Pic_model->getAll();
        $data["dataDivisi"] = $this->Divisi_model->getAll();
        $this->load->view("pic/lihat_pic", $data);
    }

    // Provinsi
    public function getdataDivisi()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->Pic_model->getdivisi($searchTerm);
        echo json_encode($response);
    }

    public function add()
    {
        // echo 'hello';die();
        $pic = $this->Pic_model;
        $validation = $this->form_validation;
		    $validation->set_rules($pic->rules());
        if ($validation->run()) {
            $pic->save();
            $this->session->set_flashdata('success', 'Tambah PIC Berhasil Disimpan');
            redirect('Pic_controller');
        }

        $this->load->view("pic/lihat_pic");
    }

  //   public function edit($id){

  //   	$faq = $this->Customer_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Pic_controller');
  //       }

  //       // $faq= $this->Customer_model->getById($id);
		// $data['list_divisi'] = $this->Customer_model->getById($id);
  //       $this->load->view('customer/lihat_customer', $data);
  //   }

    public function edit(){
      	$dataPic    = $this->input->post();
      	$id 	      = $dataPic['pic_id'];
      	$pic        = $this->Pic_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($pic->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $pic->update($id); // update data
            $this->session->set_flashdata('success', 'Data PIC Berhasil Diubah');
            redirect('Pic_controller');
        }
    }
	

    public function delete($id){
	    $this->Pic_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data PIC Berhasil Dihapus');
	    redirect('Pic_controller');
	}

    // chainde dropdown
    public function chained_dropdown_pic(){
        $divisi_id = $this->input->post('divisi_id');
        $pic = $this->Pic_model->chained_dropdown($divisi_id);

        echo json_encode($pic);
    }

}
