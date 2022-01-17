<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_perusahaan_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_perusahaan_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["cust_perusahaan"] = $this->Customer_perusahaan_model->getAll();
        // $this->load->view("faq/lihat_faq", $data);
        $this->load->view("cust_perusahaan/lihat_cust_perusahaan", $data);
    }

    public function add()
    {
        $cust_perusahaan = $this->Customer_perusahaan_model;
        $validation = $this->form_validation;
		$validation->set_rules($cust_perusahaan->rules());
        if ($validation->run()) {
            $cust_perusahaan->save();
            $this->session->set_flashdata('success', 'Tambah Customer Perusahaan dengan nama '.$cust_perusahaan->nm_cust_perusahaan.' Berhasil Disimpan');
            redirect('Customer_perusahaan_controller');
        }

        $this->load->view("cust_perusahaan/lihat_cust_perusahaan");
    }

    public function edit(){
    	$dataCustPerusahaan    = $this->input->post();
    	$id 	    = $dataCustPerusahaan['cust_perusahaan_id'];
    	$cust_perusahaan = $this->Customer_perusahaan_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($cust_perusahaan->rules()); //terapkan rules di Customer_perusahaan_model.php

        if ($validation->run()) { //lakukan validasi form
            $cust_perusahaan->update($id); // update data
            $this->session->set_flashdata('success', 'Data Customer Perusahaan Berhasil Diubah');
            redirect('Customer_perusahaan_controller');
        }

    }

	

    public function delete($id){
	    $this->Customer_perusahaan_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Customer Perusahaan Berhasil Dihapus');
	    redirect('Customer_perusahaan_controller');
	}

    public function chained_dropdown_perusahaan(){
        $perusahaan_id = $this->input->post('perusahaan_id');
        $divisi_id = $this->input->post('divisi_id');
        $perusahaan = $this->Customer_perusahaan_model->chained_dropdown($perusahaan_id, $divisi_id);

        $callback = array('list_perusahaan'=>$perusahaan);
        echo json_encode($callback);
    }
}
