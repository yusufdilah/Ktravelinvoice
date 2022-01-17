<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_tiket_divisi_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Tiket_divisi_model");
        $this->load->model("Anggota_model");
        $this->load->library('form_validation');
        $this->config->load('api_setting', TRUE);
    }

    public function index()
    {
        $data["tiket_divisi"] = $this->Tiket_divisi_model->getAll();
        $data["tiket_divisi_join"] = $this->Tiket_divisi_model->getAlljoin();
        $data["dataAnggota"] = $this->Anggota_model->getAll();
        $this->load->view("tiket_divisi/lihat_tiket_divisi", $data);
    }

    public function add()
    {
  		
		$data["dataDivisi"] = $this->Tiket_divisi_model->getDivisi();
		$data["dataKategori"] = $this->Tiket_divisi_model->getKategori();
		$data["dataAnggota"] = $this->Anggota_model->getAll();

		$divisi = $this->Tiket_divisi_model;
        $validation = $this->form_validation;
		$validation->set_rules($divisi->rules());
		
        if ($validation->run()) {
        	$post = $this->input->post();
			$divisi_id = $post['divisi_id'];
			$kategori_id = $post['tiket_kategori_id'];
			$level_user_db 	= "";
			$status_user_db = "";
			$run_1 = $this->Tiket_divisi_model->Load_divisi_terdaftar($divisi_id,$kategori_id);
			foreach($run_1->result_array() as $db_data1) {
							$level_db 	= $db_data1['level'];
							$nasabah_id_db = $db_data1['nasabah_id'];
			}
			if ($run_1->num_rows() <> 0) {
				$this->session->set_flashdata('success', 'Divisi dan kategori sudah dipilih (Pilih Divisi / Kategori lain)');
	            redirect('Setting_tiket_divisi_controller/add');
			}else{
				$divisi->save();
	            $this->session->set_flashdata('success', 'Tambah tiket divisi  Berhasil Disimpan');
	            redirect('Setting_tiket_divisi_controller');
			}
            
        }
        $this->load->view("tiket_divisi/tambah_tiket_divisi",$data);
    }

    

    public function edit($id){
    	
		$divisi = $this->Tiket_divisi_model;
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($divisi->rules()); //terapkan rules di Tiket_divisi_model.php

        if ($validation->run()) { //lakukan validasi form
        	$post = $this->input->post();
			$divisi_id = $post['divisi_id'];
			$kategori_id = $post['tiket_kategori_id'];

			$run_1 = $this->Tiket_divisi_model->Load_divisi_terdaftar($divisi_id,$kategori_id);
			foreach($run_1->result_array() as $db_data1) {
							$level_db 	= $db_data1['level'];
							$nasabah_id_db = $db_data1['nasabah_id'];
			}
			if ($run_1->num_rows() <> 0) {
				$this->session->set_flashdata('success', 'Divisi dan kategori sudah dipilih (Pilih Divisi / Kategori lain)');
	            redirect('Setting_tiket_divisi_controller/edit/'.$id);
			}else{
				$divisi->update($id); // update data
	            $this->session->set_flashdata('success', 'Data Divisi Berhasil Diubah');
	            redirect('Setting_tiket_divisi_controller');
			}
        }

        // $divisi= $this->Tiket_divisi_model->getById($id);
        $data["dataDivisi"] = $this->Tiket_divisi_model->getDivisi();
    	// $data["tiket_divisi_join"] = $this->Tiket_divisi_model->getAlljoin();
		$data["dataSettingDivisi"] = $this->Tiket_divisi_model->getById($id);
		$data["dataKategori"] = $this->Tiket_divisi_model->getKategori();
        $this->load->view('tiket_divisi/edit_tiket_divisi', $data);
    }

	

    public function delete($id){
	    $this->Tiket_divisi_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Level Berhasil Dihapus');
	    redirect('Setting_tiket_divisi_controller');
	}

	
}
