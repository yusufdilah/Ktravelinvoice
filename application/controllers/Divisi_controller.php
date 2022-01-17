<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Divisi_model");
        $this->load->model("Perusahaan_model");
        $this->load->model("Customer_perusahaan_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["divisi"] = $this->Divisi_model->getAll();
        $data["perusahaan"] = $this->Customer_perusahaan_model->getAll();
        $this->load->view("divisi/lihat_divisi", $data);
    }

    public function add()
    {
        $divisi = $this->Divisi_model;
        $validation = $this->form_validation;
		$validation->set_rules($divisi->rules());
        if ($validation->run()) {
            $divisi->save();
            $this->session->set_flashdata('success', 'Tambah Divisi Berhasil Disimpan');
            redirect('Divisi_controller');
        }

        $this->load->view("divisi/lihat_divisi");
    }

  //   public function edit($id){

  //   	$faq = $this->Divisi_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Divisi_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Divisi_controller');
  //       }

  //       // $faq= $this->Divisi_model->getById($id);
		// $data['list_divisi'] = $this->Divisi_model->getById($id);
  //       $this->load->view('divisi/lihat_divisi', $data);
  //   }

    public function edit(){
    	$dataDivisi = $this->input->post();
    	$id 	= $dataDivisi['divisi_id'];
    	$divisi = $this->Divisi_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($divisi->rules()); //terapkan rules di Divisi_model.php

        if ($validation->run()) { //lakukan validasi form
            $divisi->update($id); // update data
            $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
            redirect('Divisi_controller');
        }
    }

	public function approve($id){

    	$faq = $this->Divisi_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($faq->rules()); //terapkan rules di Divisi_model.php

        if ($validation->run()) { //lakukan validasi form
            $faq->approve($id); // approve data
            // $this->session->set_flashdata('success', 'Itu akan jadi proses Approve');
            redirect('Divisi_controller');
        }

        // $faq= $this->Divisi_model->getById($id);
		$data['faq'] = $this->Divisi_model->getById($id);
        $this->load->view('divisi/approve_faq', $data);
    }

    public function delete($id){
	    $this->Divisi_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Divisi Berhasil Dihapus');
	    redirect('Divisi_controller');
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
