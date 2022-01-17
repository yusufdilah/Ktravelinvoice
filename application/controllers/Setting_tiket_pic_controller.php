<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_tiket_pic_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->model("Tiket_pic_model");
        $this->load->model("Tiket_divisi_model");
        $this->load->model("Anggota_model");
        $this->load->library('form_validation');
        $this->config->load('api_setting', TRUE);
    }

    public function index()
    {
        $data["tiket_pic"] = $this->Tiket_pic_model->getAlljoin();
        $this->load->view("tiket_pic/lihat_tiket_pic", $data);
    }

    public function add()
    {
		
		$data["dataAnggota"] = $this->Anggota_model->getAll();
		$data["dataDivisi"] = $this->Tiket_divisi_model->getDivisi();
        $this->load->view("tiket_pic/tambah_tiket_pic",$data);
    }

    public function save(){
    	$dataPic = $this->input->post();
  
		$nasabah_id = $dataPic['nasabah_id'];
		$divisi_id	= $dataPic['divisi_id'];
		$level 		= $dataPic['level'];
		
		$url_api 			= $this->config->item('url_api', 'api_setting');
		$url 				= $url_api.'nasabah_id_kopkar';
		$user_auth 			= $this->config->item('user_api', 'api_setting');
		$pass_auth 			= $this->config->item('password_api', 'api_setting');
		$response_json_code = 0;
		$ch 				= curl_init($url); // create a new cURL resource
		$result 			= $this->config->item('result','api_setting');// setup request to send json via POST
		$data	 	= json_encode(array("nasabah_id" => $nasabah_id)); // 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch); // execute the POST request
		curl_close($ch); // close cURL resource
		$json = json_decode($result,true);
   //        	echo '<pre>';
			// var_dump($json);
			// echo '</pre>';
			// die();
		$response_json_code = $json['response_code'];
		if($response_json_code == "01"){ // Jika respon kode = 1 (benar)
			$level_user_db 	= "";
			$status_user_db = "";
			$run_1 = $this->Tiket_pic_model->Load_pic_terdaftar($nasabah_id,$divisi_id);
			foreach($run_1->result_array() as $db_data1) {
							$level_db 	= $db_data1['level'];
							$nasabah_id_db = $db_data1['nasabah_id'];
			}
			if ($run_1->num_rows() <> 0) {
				$this->session->set_flashdata('success', 'Pilih Nasabah ID lain (Nasabah ID '.$nasabah_id.' levelnya sudah ada gan)');
	            redirect('Setting_tiket_pic_controller/add');
			}else{
				$tiket_pic = $this->Tiket_pic_model;
		        $validation = $this->form_validation;		
				$validation->set_rules($tiket_pic->rules());
		        if ($validation->run()) {
		            $tiket_pic->save();
		            $this->session->set_flashdata('success', 'Tambah PIC berhasil disimpan');
		            redirect('Setting_tiket_pic_controller');
		        }
			}
			
		}else {
				$this->session->set_flashdata('message', 'Tambah Level gagal disimpan (Nasabah ID '.$nasabah_id.' Kopkar tidak terdaftar)');
	            redirect('Setting_tiket_pic_controller/add');
		}
    }

    public function edit($id){
    	
		$data['dataPic'] = $this->Tiket_pic_model->getById($id);
		$data["dataDivisi"] = $this->Tiket_divisi_model->getDivisi();
		$data["dataAnggota"] = $this->Anggota_model->getAll();
        $this->load->view('tiket_pic/edit_tiket_pic', $data);
    }
    public function prosesEdit($id){
    	$dataPic = $this->input->post(); 
    	$tiket_pic = $this->Tiket_pic_model; //object model
    	$data["dataAnggota"] = $this->Anggota_model->getAll();
    	$nasabah_id = $dataPic['nasabah_id'];
		$divisi_id = $dataPic['divisi_id'];
		$level = $dataPic['level'];

        $validation = $this->form_validation; //object validasi
        $validation->set_rules($tiket_pic->rules()); //terapkan rules 

        if ($validation->run()) { //lakukan validasi form
            $run_1 = $this->Tiket_pic_model->Load_pic_terdaftar($nasabah_id,$divisi_id);
			foreach($run_1->result_array() as $db_data1) {
							$level_db 	= $db_data1['level'];
							$nasabah_id_db = $db_data1['nasabah_id'];
			}				
			// if ($run_1->num_rows() <> 0) {
			// 					# code...
			// 					$this->session->set_flashdata('success', 'Pilih Nasabah ID lain (Nasabah ID '.$nasabah_id.' divisi & levelnya sudah ada gan)');
	  //           				redirect('Setting_tiket_pic_controller/edit/'.$id);
			// 				}			
			// else{
				$tiket_pic->update($id); // update data
	            $this->session->set_flashdata('success', 'Data PIC Berhasil Diubah');
	            redirect('Setting_tiket_pic_controller');

			// }	

        }

		$data['dataPic'] = $this->Tiket_pic_model->getById($id);
		$data["dataDivisi"] = $this->Tiket_divisi_model->getDivisi();
		$data["dataAnggota"] = $this->Anggota_model->getAll();
        $this->load->view('tiket_pic/edit_tiket_pic', $data);
    }


    public function delete($id){
	    $this->Tiket_pic_model->delete($id); 
	    $this->session->set_flashdata('success', 'Data PIC Berhasil Dihapus');
	    redirect('Setting_tiket_pic_controller');
	}

	
}
