<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->model("Divisi_model");
        $this->load->model("Perusahaan_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["perusahaan"] = $this->Perusahaan_model->getAll();
        $data["customer"] = $this->Customer_model->getAll();
        $data["dataDivisi"] = $this->Divisi_model->getAll();
        $this->load->view("perusahaan/lihat_perusahaan", $data);
    }

    public function add()
    {
        // echo 'hello';die();
        $perusahaan = $this->Perusahaan_model;
        $validation = $this->form_validation;
		    $validation->set_rules($perusahaan->rules());
        if ($validation->run()) {
            $perusahaan->save();
            $this->session->set_flashdata('success', 'Tambah Perusahaan Berhasil Disimpan');
            redirect('Perusahaan_controller');
        }

        $this->load->view("perusahaan/lihat_perusahaan");
    }

  //   public function edit($id){

  //   	$faq = $this->Customer_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Perusahaan_controller');
  //       }

  //       // $faq= $this->Customer_model->getById($id);
		// $data['list_divisi'] = $this->Customer_model->getById($id);
  //       $this->load->view('customer/lihat_customer', $data);
  //   }

    public function edit(){
    	$dataPerusahaan = $this->input->post();
    	$id 	= $dataPerusahaan['perusahaan_id'];
    	$perusahaan = $this->Perusahaan_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($perusahaan->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $perusahaan->update($id); // update data
            $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Diubah');
            redirect('Perusahaan_controller');
        }
    }

	public function approve($id){

    	$faq = $this->Customer_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $faq->approve($id); // approve data
            // $this->session->set_flashdata('success', 'Itu akan jadi proses Approve');
            redirect('Perusahaan_controller');
        }

        // $faq= $this->Customer_model->getById($id);
		$data['faq'] = $this->Customer_model->getById($id);
        $this->load->view('customer/approve_faq', $data);
    }

    public function delete($id){
	    $this->Perusahaan_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Dihapus');
	    redirect('Perusahaan_controller');
	}

    // chained dropdown
    public function chained_dropdown_perusahaan(){
        $perusahaan_id = $this->input->post('perusahaan_id');
        $divisi_id = $this->input->post('divisi_id');
        $perusahaan = $this->Perusahaan_model->chained_dropdown($perusahaan_id, $divisi_id);

        $callback = array('list_perusahaan'=>$perusahaan);
        echo json_encode($callback);
    }

}
