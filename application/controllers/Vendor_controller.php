<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Divisi_model");
        $this->load->model("Vendor_model");
        $this->load->model("Pic_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["dataPic"] = $this->Pic_model->getAll();
        $data["vendor"] = $this->Vendor_model->getAll();
        $this->load->view("vendor/lihat_vendor", $data);
    }

    public function add()
    {
        $vendor = $this->Vendor_model;
        $validation = $this->form_validation;
		    $validation->set_rules($vendor->rules());
        if ($validation->run()) {
            $vendor->save();
            $this->session->set_flashdata('success', 'Tambah Vendor Berhasil Disimpan');
            redirect('Vendor_controller');
        }

        $this->load->view("vendor/lihat_vendor");
    }

  //   public function edit($id){

  //   	$faq = $this->Divisi_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Divisi_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Vendor_controller');
  //       }

  //       // $faq= $this->Divisi_model->getById($id);
		// $data['list_divisi'] = $this->Divisi_model->getById($id);
  //       $this->load->view('divisi/lihat_divisi', $data);
  //   }

    public function edit(){
    	$dataVendor = $this->input->post();
    	$id 	= $dataVendor['vendor_id'];
    	$vendor = $this->Vendor_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($vendor->rules()); //terapkan rules di Divisi_model.php

        if ($validation->run()) { //lakukan validasi form
            $vendor->update($id); // update data
            $this->session->set_flashdata('success', 'Data Vendor Berhasil Diubah');
            redirect('Vendor_controller');
        }
    }


    public function delete($id){
	    $this->Vendor_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Vendor Berhasil Dihapus');
	    redirect('Vendor_controller');
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './file.upload.1/';
		$config['allowed_types']        = 'gif|jpg|png';
		// $config['file_name']            = $_FILES['userfile'];
		$config['overwrite']			= true;
		$config['max_size']             = '10000'; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('userfile')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
	}
}
