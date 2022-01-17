<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->model("Divisi_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["customer"] = $this->Customer_model->getAll();
        $data["dataDivisi"] = $this->Divisi_model->getAll();
        $this->load->view("customer/lihat_customer", $data);
    }

    public function add()
    {
        // echo 'hello';die();
        $customer = $this->Customer_model;
        $validation = $this->form_validation;
		    $validation->set_rules($customer->rules());
        if ($validation->run()) {
            $customer->save();
            $this->session->set_flashdata('success', 'Tambah Customer Berhasil Disimpan');
            redirect('Customer_controller');
        }

        $this->load->view("customer/lihat_customer");
    }

  //   public function edit($id){

  //   	$faq = $this->Customer_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Customer_controller');
  //       }

  //       // $faq= $this->Customer_model->getById($id);
		// $data['list_divisi'] = $this->Customer_model->getById($id);
  //       $this->load->view('customer/lihat_customer', $data);
  //   }

    public function edit(){
    	$dataCustomer = $this->input->post();
    	$id 	= $dataCustomer['customer_id'];
    	$customer = $this->Customer_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($customer->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $customer->update($id); // update data
            $this->session->set_flashdata('success', 'Data Customer Berhasil Diubah');
            redirect('Customer_controller');
        }
    }

	public function approve($id){

    	$faq = $this->Customer_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $faq->approve($id); // approve data
            // $this->session->set_flashdata('success', 'Itu akan jadi proses Approve');
            redirect('Customer_controller');
        }

        // $faq= $this->Customer_model->getById($id);
		$data['faq'] = $this->Customer_model->getById($id);
        $this->load->view('customer/approve_faq', $data);
    }

    public function delete($id){
	    $this->Customer_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Customer Berhasil Dihapus');
	    redirect('Customer_controller');
	}

}
