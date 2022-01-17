<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lupaemail_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Lupaemail_model");
        $this->load->library('form_validation');
        $this->config->load('api_setting', TRUE);
    }

    public function index()
    {
        $table = "lupa_email";
		$data['lupa_email'] = $this->Lupaemail_model->getByUnapprove($table);
		$data['count_reject'] = $this->Lupaemail_model->countReject($table);
		$this->load->view("lupa_email/lihat_lupa_email", $data);
    }

    public function list_reject()
    {
        $table = "lupa_email";
        $data['lupa_email_tolak'] = $this->Lupaemail_model->getByReject($table);
        $this->load->view("lupa_email/lihat_lupa_email_ditolak", $data);
    }

    

    public function lihat_approval_lupaemail($id){

		$data['lupa_email'] = $this->Lupaemail_model->getById($id);
        $this->load->view('lupa_email/lihat_approval_lupaemail', $data);
    }    

    public function form_approval($id){

    	$lupa_email = $this->Lupaemail_model; //object model

    	$data['lupa_email'] = $this->Lupaemail_model->getById($id);
        $this->load->view('lupa_email/approve_lupa_email', $data);
    }
    public function simpan(){
	    	$dataApprove = $this->input->post();
	    	$nasabah_id = $dataApprove['nasabah_id_anggota'];
	    	$email = $dataApprove['email'];
	    	$password = $dataApprove['password'];
	    	$status = 2;
	    	$lupa_email_id = $dataApprove['lupa_email_id'];
	    	
	    	$url_api            = $this->config->item('url_api', 'api_setting');
	    	$url_approve_lupaemail   = $url_api.'lupa_email';
			$user_auth          = $this->config->item('user_api', 'api_setting');
        	$pass_auth          = $this->config->item('password_api', 'api_setting');
        	$response_json_code = 0;
			$ch_anggota 	= curl_init($url_approve_lupaemail); // create a new cURL resource
			$result 		= json_decode(file_get_contents('php://input'), true); 
			$save_approve_password	= json_encode(
											array("nasabah_id" => $nasabah_id,
													  "email" => $email,
													  "password_baru"=>$password,
													  "status" => $status,
												)
										); // 
			// print $save_approve_password;
			// echo'<hr />';die();
			curl_setopt($ch_anggota, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
			curl_setopt($ch_anggota, CURLOPT_POSTFIELDS, $save_approve_password); // attach encoded JSON string to the POST fields
			curl_setopt($ch_anggota, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
			$result = curl_exec($ch_anggota); // execute the POST request
			curl_close($ch_anggota); // close cURL resource
			$json = json_decode($result,true);
			$response_json_code = $json['response_code'];
			$response_json_lupa_email = $json['response_data'];
			$response_json_lupa_email = $json['response_data'];
				
			if ($response_json_code != 108) {
					
					$this->session->set_flashdata('message', 'Gagal di Approve '); // Buat session flashdata
					redirect('Lupaemail_controller/lihat_approval_lupaemail/'.$lupa_email_id); 

			} else{
						
					$query = $this->Lupaemail_model->approve($dataApprove);	
					$this->session->set_flashdata('success', 'Lupa Email '.$email.' Berhasil di Approve'); // Buat session flashdata
			        redirect('Lupaemail_controller');	
				}
    }

    public function reject(){
		$dataApprove = $this->input->post();
		$nasabah_id = $dataApprove['nasabah_id_anggota'];
		$lupa_email_id = $dataApprove['lupa_email_id'];
		$email = $dataApprove['email'];
		$nama = $dataApprove['nama'];
		$password = $dataApprove['password'];
		$status = 3;
		$url_api            = $this->config->item('url_api', 'api_setting');
	    $url_approve_lupaemail   = $url_api.'lupa_email';
		$user_auth          = $this->config->item('user_api', 'api_setting');
        $pass_auth          = $this->config->item('password_api', 'api_setting');
        $response_json_code = 0;
		$ch_anggota 	= curl_init($url_approve_lupaemail); // create a new cURL resource
		$result 		= json_decode(file_get_contents('php://input'), true); 
		$save_approve_password	= json_encode(
												array("nasabah_id" => $nasabah_id,
													  "email" => $email,
													  "password_baru"=>$password,
													  "status" => $status,
													)
											); 
		curl_setopt($ch_anggota, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

		curl_setopt($ch_anggota, CURLOPT_POSTFIELDS, $save_approve_password); // attach encoded JSON string to the POST fields
		curl_setopt($ch_anggota, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch_anggota); // execute the POST request
		curl_close($ch_anggota); // close cURL resource
				// get response
				// print $result;die();
				// echo'<hr />';die();
		// echo '<pre>';
		// var_dump($result);
		// echo '</pre>';
		// die();
		$json = json_decode($result,true);
				// echo '<pre>';
				// var_dump($result);
				// echo '</pre>';
				// die();
		$response_json_code = $json['response_code'];
		$response_json_lupa_email = $json['response_data'];
				// echo '<pre>';
				// var_dump($response_json_code);
				// echo '</pre>';
				// die();
		if ($response_json_code != 108) {
			$this->session->set_flashdata('message', 'Gagal di Reject'); // Buat session flashdata
			redirect('Lupaemail_controller/lihat_approval_lupaemail/'.$lupa_email_id); // 
		} else{

			$query = $this->Lupaemail_model->reject($dataApprove);	
			$this->session->set_flashdata('success', 'Lupa Email '.$email.' Berhasil di Reject'); // Buat session flashdata
			redirect('Lupaemail_controller');	
		}
    }

	

	
    public function delete($id){
	    $this->Lupaemail_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Home Slider Berhasil Dihapus');
	    redirect('Lupaemail_controller');
	}
	
}
