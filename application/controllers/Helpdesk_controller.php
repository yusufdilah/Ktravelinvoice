<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk_controller extends CI_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Registrasi_model");
        $this->load->model("User_model");
        $this->load->model("Helpdesk_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
    	$nasabah_id = $this->session->userdata('token_nasabah');
    	$getByUnapprove = 'tiket t';
		$data['user_get'] = $this->User_model->user_get();
		
		$data['spv_tiket']=$this->db->query
			('SELECT tp.level as level,supervisor,staff, tp.* FROM tiket_pic tp LEFT JOIN anggota_data ad ON tp.nasabah_id = ad.nasabah_id 
				WHERE tp.nasabah_id = "'.$nasabah_id.'" ');
		$data['helpdesk'] = $this->Helpdesk_model->getByUnapprove($getByUnapprove);
		$data['helpdesk_spv'] = $this->Helpdesk_model->getByUnapproveSpv();
		$data['tiket_spv'] = $this->Helpdesk_model->jml_tiket_spv();
		$data['tiket_jwb_spv'] = $this->Helpdesk_model->jml_tiket_jwb_spv();
		$data['tiket_open'] = $this->Helpdesk_model->jml_tiket_open($getByUnapprove);
		$data['tiket_answered'] = $this->Helpdesk_model->jml_tiket_answered();
		$data['tiket_closed'] = $this->Helpdesk_model->jml_tiket_closed();
		

		$this->load->view("helpdesk/lihat_helpdesk", $data);
    }

    public function list_spv()
    {
		$data['helpdesk'] = $this->User_model->user_get();
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		
		$data['helpdesk_spv'] = $this->Helpdesk_model->getByUnapproveSpv();
		$data['tiket_spv'] = $this->Helpdesk_model->jml_tiket_spv();


		$this->load->view("helpdesk/lihat_helpdesk_spv", $data);
    }

    public function list_answer()
    {
		$data['helpdesk'] = $this->User_model->user_get();
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['helpdesk_answer'] = $this->Helpdesk_model->getByAnswer();
		$data['tiket_spv'] = $this->Helpdesk_model->jml_tiket_spv();


		$this->load->view("helpdesk/lihat_helpdesk_answer", $data);
    }

    public function list_closed()
    {
		$data['helpdesk'] = $this->User_model->user_get();
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['helpdesk_closed'] = $this->Helpdesk_model->getByClosed();
		$data['tiket_spv'] = $this->Helpdesk_model->jml_tiket_spv();
		$this->load->view("helpdesk/lihat_helpdesk_closed", $data);
    }

    public function list_jwb_spv()
    {
		$data['helpdesk'] = $this->User_model->user_get();
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		
		$data['helpdesk_spv'] = $this->Helpdesk_model->getByUnJwbSpv();
		$data['tiket_spv'] = $this->Helpdesk_model->jml_tiket_spv();


		$this->load->view("helpdesk/lihat_helpdesk_jwb_spv", $data);
    }
    

    public function lihat_tiket($id){
		$data['helpdesk'] = $this->Helpdesk_model->getById($id);
		$data['history'] = $this->Helpdesk_model->getByHistory($id);
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['history_spv'] = $this->Helpdesk_model->getByHistorySpv($id);
		$data['pic_history'] = $this->Helpdesk_model->getPic();
		$data['getPenjawabTiket'] = $this->Helpdesk_model->getPenjawabTiketlevel();
		// var_dump($data['history']);die();
        $this->load->view('helpdesk/lihat_tiket', $data);
    }   

    public function lihat_tiket_spv($id){

        
        $data['helpdesk'] = $this->Helpdesk_model->getById($id);
        $data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
        $data['history'] = $this->Helpdesk_model->getByHistory($id);
        $data['history_spv'] = $this->Helpdesk_model->getByHistorySpv($id);
        $data['pic_history'] = $this->Helpdesk_model->getPic();
        // var_dump($data['history']);die();
        $this->load->view('helpdesk/lihat_tiket_spv', $data);
    }  

    public function lihat_tiket_jwb_spv($id){

    	
		$data['helpdesk'] = $this->Helpdesk_model->getById($id);
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['history'] = $this->Helpdesk_model->getByHistory($id);
		$data['history_spv'] = $this->Helpdesk_model->getByHistorySpv($id);
		$data['pic_history'] = $this->Helpdesk_model->getPic();
		// var_dump($data['history']);die();
        $this->load->view('helpdesk/lihat_tiket_jwb_spv', $data);
    }  

    public function lihat_tiket_answer($id){

    	
		$data['helpdesk'] = $this->Helpdesk_model->getById($id);
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['history'] = $this->Helpdesk_model->getByHistory($id);
		$data['history_spv'] = $this->Helpdesk_model->getByHistorySpv($id);
		$data['pic_history'] = $this->Helpdesk_model->getPic();
		// var_dump($data['history']);die();
        $this->load->view('helpdesk/lihat_tiket_answer', $data);
    } 

    public function lihat_tiket_closed($id){

    	
		$data['helpdesk'] = $this->Helpdesk_model->getById($id);
		$data['spv_tiket'] = $this->Helpdesk_model->spv_tiket_get();
		$data['history'] = $this->Helpdesk_model->getByHistory($id);
		$data['history_spv'] = $this->Helpdesk_model->getByHistorySpv($id);
		$data['pic_history'] = $this->Helpdesk_model->getPic();
		// var_dump($data['history']);die();
        $this->load->view('helpdesk/lihat_tiket_closed', $data);
    }    

    public function tambah_komentar()
    {
        $helpdesk = $this->Helpdesk_model;
        $validation = $this->form_validation;
    
		$validation->set_rules($helpdesk->rules());
        if ($validation->run()) {
            $helpdesk->save();
            $this->session->set_flashdata('success', 'Tambah Komentar Berhasil Disimpan');
            redirect('Helpdesk_controller');
        }
    }

    public function tambah_komentar_anggota()
    {
        $helpdesk = $this->Helpdesk_model;
        $validation = $this->form_validation;
    
		$validation->set_rules($helpdesk->rules());
        if ($validation->run()) {
            $helpdesk->save_anggota();
            $this->session->set_flashdata('success', 'Tambah Komentar Berhasil Disimpan');
            redirect('Helpdesk_controller');
        }
    }

    public function tambah_komentar_spv()
    {
        $helpdesk = $this->Helpdesk_model;
        $validation = $this->form_validation;
    
		$validation->set_rules($helpdesk->rules());
        if ($validation->run()) {
    
            $helpdesk->save_spv();
            $this->session->set_flashdata('success', 'Tambah Komentar Berhasil Disimpan');
            redirect('Helpdesk_controller');
        }
    }


    public function edit($id){

    	$registrasi = $this->Registrasi_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($registrasi->rules()); //terapkan rules di Registrasi_model.php

        if ($validation->run()) { //lakukan validasi form
            $registrasi->update($id); // update data
            $this->session->set_flashdata('success', 'Data Home Slider Berhasil Diubah');
            redirect('Helpdesk_controller');
        }

        // $registrasi= $this->Registrasi_model->getById($id);
		$data['registrasi'] = $this->Registrasi_model->getById($id);
        $this->load->view('registrasi/edit_registrasi', $data);
    }
    
    public function lihat_history_tiket($id){

    	
		$data['helpdesk'] = $this->Helpdesk_model->getByHistory($id);
        $this->load->view('helpdesk/lihat_tiket', $data);
    }    

    public function form_approval($id){

    	$registrasi = $this->Registrasi_model; //object model
        
    	$data['registrasi'] = $this->Registrasi_model->getById($id);
        $this->load->view('registrasi/approve_registrasi', $data);
    }


    public function delete($id){
	    $this->Registrasi_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Home Slider Berhasil Dihapus');
	    redirect('Helpdesk_controller');
	}

	public function close_tiket($id){
	    $this->Helpdesk_model->close_tiket($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Tiker Berhasil Diclose');
	    redirect('Helpdesk_controller');
	}

}
