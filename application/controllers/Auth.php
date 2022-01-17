<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->config->load('api_setting', TRUE);
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('authenticated'))
			$this->load->view('admin/dashboard');
			
		$this->load->view('admin/login');
	}


	public function login(){
		$email = $this->input->post('email'); // Ambil isi dari inputan username pada form login
		$password = ($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
		
		$url_api 		    = $this->config->item('url_api', 'api_setting');
        $url          		= $url_api.'login';
		
		$user_auth          = $this->config->item('user_api', 'api_setting');
        $pass_auth          = $this->config->item('password_api', 'api_setting');
		$response_json_code = 0;

		$ch 		= curl_init($url); // create a new cURL resource
		$result 	= json_decode(file_get_contents('php://input'), true); // setup request to send json via POST
		//$data	 	= json_encode(array("token" => "0adbfc029162963a272b0c28f6425345")); // define get data berdasarkan norek

		$data	 	= json_encode(array("email" => $email,"pass"=>$password)); // define get data berdasarkan norek

		curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch); // execute the POST request
		curl_close($ch); // close cURL resource
		$json = json_decode($result,true);
		$response_json_code = $json['response_code'];
		
		if($response_json_code == "01"){ // Jika respon kode = 1 (benar)
				$response_json_token = $json['response_data'][0]['token'];
				
				$url_nasabah_id = $url_api.'nasabah_id';
				$ch_nasabah 	= curl_init($url_nasabah_id); // create a new cURL resource
				$result 		= json_decode(file_get_contents('php://input'), true); 
				$token_api	 	= json_encode(array("token" => $response_json_token)); // define get data berdasarkan norek

				curl_setopt($ch_nasabah, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

				curl_setopt($ch_nasabah, CURLOPT_POSTFIELDS, $token_api); // attach encoded JSON string to the POST fields
				curl_setopt($ch_nasabah, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
				$result = curl_exec($ch_nasabah); // execute the POST request
				curl_close($ch_nasabah); // close cURL resource
				$json = json_decode($result,true);
				$response_json_code 		= $json['response_code'];
				
				if ($response_json_code == "01") {
					$response_json_nasabah_id 	= $json['response_data'][0]['nasabah_id'];
					if ($response_json_nasabah_id <> "") {
						$data = array(
							'nasabah_id' 	=> $response_json_nasabah_id
						);
						
						// lookup tabel user
						$level_user_db 	= "";
						$status_user_db = "";
						$run_1 = $this->User_model->Load_tabel_user($response_json_nasabah_id);
						foreach($run_1->result_array() as $db_data1) {
							$level_user_db 	= $db_data1['level'];
							$status_user_db = $db_data1['status'];
						}
						
						// validate empty data
						if ($run_1->num_rows() <> 0) {
							if ($status_user_db == 1) {							
								$session = array (
									'authenticated'=>true, // Buat session authenticated dengan value true
									'email'=>$email,  // Buat session email
									'password'=>$password, // Buat session password
									'token_nasabah' => $response_json_nasabah_id,
									'level' => $level_user_db
								);
								$this->session->set_userdata($session); // Buat session sesuai $session
								redirect('Dashboard_controller', $session);
							}
							else {
								$this->session->set_flashdata('message', 'Akun admin anda sedang di nonaktifkan'); // Buat session flashdata
								redirect('Auth'); // Redirect ke halaman login
							}
						}
						else {
							$this->session->set_flashdata('message', 'Anda tidak terdaftar sebagai admin mykopkarbsm'); // Buat session flashdata
							redirect('Auth'); // Redirect ke halaman login
						}
					}
					else {
						$this->session->set_flashdata('message', 'Anda tidak terdaftar sebagai admin mykopkarbsm'); // Buat session flashdata
						redirect('Auth'); // Redirect ke halaman login
					}
				}
				else {
					$this->session->set_flashdata('message', 'Anda tidak terdaftar sebagai admin mykopkarbsm'); // Buat session flashdata
					redirect('Auth'); // Redirect ke halaman login
				}
		}
		else {
			$this->session->set_flashdata('message', 'Email / Password salah'); // Buat session flashdata
			redirect('Auth'); // Redirect ke halaman login
		}
	
	}

	public  function  logout(){
		$this->session->sess_destroy();
		redirect('Auth');
	}

}

/* End of file Controllername.php */
