<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_level_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->model("Anggota_model");
        $this->load->library('form_validation');
        $this->config->load('api_setting', TRUE);
    }

    public function index()
    {
        $data["level"] = $this->User_model->getAlljoin();
        $data["dataAnggota"] = $this->Anggota_model->getAll();
        $this->load->view("level/lihat_level", $data);
    }

    public function add()
    {
		$data["nasabah_id"] = $this->User_model->get_nasabah_id();
		$data["dataAnggota"] = $this->Anggota_model->getAll();
        $this->load->view("level/tambah_level",$data);
    }

    public function save(){
    	$datalevel = $this->input->post();
  
    	$nasabah_id 	= $this->input->post('nasabah_id'); 
    	$level 			= $this->input->post('level'); 
    	$nasabah_id 	= $this->input->post('nasabah_id'); 
    	$divisi 		= $this->input->post('level'); 

		$url_api 			= $this->config->item('url_api', 'api_setting');
		$url 				= $url_api.'nasabah_id_kopkar';
		$user_auth 			= $this->config->item('user_api', 'api_setting');
		$pass_auth 			= $this->config->item('password_api', 'api_setting');
		$response_json_code = 0;
		$ch 				= curl_init($url); // create a new cURL resource
		$result 			= $this->config->item('result','api_setting');

		$data	 			= json_encode(array("nasabah_id" => $nasabah_id)); // define get data 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch); // execute the POST request
		curl_close($ch); // close cURL resource
		$json = json_decode($result,true);
        
		$response_json_code = $json['response_code'];
		if($response_json_code == "01"){ // Jika respon kode = 1 (benar)
			$level_user_db 	= "";
			$status_user_db = "";
			$run_1 = $this->User_model->Load_tabel_user($nasabah_id);
			foreach($run_1->result_array() as $db_data1) {
							$level_user_db 	= $db_data1['level'];
							$status_user_db = $db_data1['status'];
							$nasabah_id_db = $db_data1['nasabah_id'];
			}
			if ($run_1->num_rows() <> 0) {
				$this->session->set_flashdata('success', 'Pilih Nasabah ID lain (Nasabah ID '.$nasabah_id.' levelnya sudah ada gan)');
	            redirect('Setting_level_controller/add');
			}else{
				$level = $this->User_model;
		        $validation = $this->form_validation;		
				$validation->set_rules($level->rules());
		        if ($validation->run()) {
		            $level->save();
		            $this->session->set_flashdata('success', 'Tambah Level berhasil disimpan');
		            redirect('Setting_level_controller');
		        }
			}
			
		}else {
				$this->session->set_flashdata('message', 'Tambah Level gagal disimpan (Nasabah ID Kopkar tidak terdaftar)');
	            redirect('Setting_level_controller/add');
		}
    }

    public function edit($id){
    	$level = $this->User_model; //object model
    	$data["dataAnggota"] = $this->Anggota_model->getAll();

        $validation = $this->form_validation; //object validasi
        $validation->set_rules($level->rules()); //terapkan rules di User_model.php

        if ($validation->run()) { //lakukan validasi form
            $level->update($id); // update data
            $this->session->set_flashdata('success', 'Data Level Berhasil Diubah');
            redirect('Setting_level_controller');
        }

		$data['dataLevel'] = $this->User_model->getById($id);
        $this->load->view('level/edit_level', $data);
    }

    public function delete($id){
	    $this->User_model->delete($id); 
	    $this->session->set_flashdata('success', 'Data Level Berhasil Dihapus');
	    redirect('Setting_level_controller');
	}

	
}
