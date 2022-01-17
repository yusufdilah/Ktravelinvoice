<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Registrasi_model");
        $this->load->library('form_validation');
        $this->config->load('api_setting', TRUE);
        $this->load->library('Email');
        $this->load->helper('my');
    }

    
    public function index()
    {
        $table = "registrasi";
		$data['registrasi'] = $this->Registrasi_model->getByUnapprove($table);
        $data['count_reject'] = $this->Registrasi_model->countReject($table);
		$this->load->view("registrasi/lihat_registrasi", $data);
    }

    public function list_reject()
    {
        $table = "registrasi";
        $data['registrasi_tolak'] = $this->Registrasi_model->getByReject($table);


        $this->load->view("registrasi/lihat_registrasi_ditolak", $data);
    }


    public function add()
    {
        $registrasi = $this->Registrasi_model;
        $validation = $this->form_validation;
		$validation->set_rules($registrasi->rules());
        if ($validation->run()) {
            $registrasi->save();
            $this->session->set_flashdata('success', 'Tambah Registrasi Anda Berhasil Disimpan');
            redirect('Registrasi_controller');
        }

        $this->load->view("registrasi/tambah_registrasi");
    }

    public function edit($id){

    	$registrasi = $this->Registrasi_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($registrasi->rules()); //terapkan rules di Registrasi_model.php

        if ($validation->run()) { //lakukan validasi form
            $registrasi->update($id); // update data
            $this->session->set_flashdata('success', 'Data Registrasi Berhasil Diubah');
            redirect('Registrasi_controller');
        }

        // $registrasi= $this->Registrasi_model->getById($id);
		$data['registrasi'] = $this->Registrasi_model->getById($id);
        $this->load->view('registrasi/edit_registrasi', $data);
    }

    public function lihat_approval($id){

    	$registrasi = $this->Registrasi_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($registrasi->rules()); //terapkan rules di Registrasi_model.php

        if ($validation->run()) { //lakukan validasi form
            $registrasi->approve($id); // approve data
            redirect('Registrasi_controller');
        }

		$data['registrasi'] = $this->Registrasi_model->getById($id);
        $this->load->view('registrasi/lihat_approval', $data);
    }    

    public function form_approval($id){

    	$registrasi = $this->Registrasi_model; //object model
        
    	$data['registrasi'] = $this->Registrasi_model->getById($id);
        $this->load->view('registrasi/approve_registrasi', $data);
    }

	public function approve()
    {   
        $dataApprove = $this->input->post();
        $query = $this->Registrasi_model->cek_anggota($dataApprove);
        $registrasi_id = $dataApprove['registrasi_id'];
        $nama = $dataApprove['nama'];
        $email = $dataApprove['email'];
        $nip = $dataApprove['nip'];
        $nasabah_id = $dataApprove['nasabah_id'];
        $nasabah_id_creator = $this->session->userdata('token_nasabah');
        $is_karyawan_kopkar = $dataApprove['is_karyawan_kopkar'];
        $password = $dataApprove['password'];
        
        $foto               = $dataApprove['foto'];
        $perusahaan_sebelum = $dataApprove['perusahaan_sebelum'];
        $password           = $dataApprove['password'];
        $url_api            = $this->config->item('url_api', 'api_setting');
        $url_save_anggota   = $url_api.'registrasi_save';
        $user_auth          = $this->config->item('user_api', 'api_setting');
        $pass_auth          = $this->config->item('password_api', 'api_setting');
        $response_json_code = 0;
        $ch_anggota     = curl_init($url_save_anggota); // create a new cURL resource
        $result         = $this->config->item('result','api_setting');// setup request to send  
        $save_anggota   = json_encode(
                                            array("nasabah_id" => $nasabah_id,
                                                    "email" => $email,
                                                    "password"=>$password,
                                                    "nip" => $nip,
                                                    "kopkar"=>$is_karyawan_kopkar,
                                                    "user_sent"=>$nasabah_id_creator
                                                )
                                        ); 
        curl_setopt($ch_anggota, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
        curl_setopt($ch_anggota, CURLOPT_POSTFIELDS, $save_anggota); // attach encoded JSON string to the POST fields
        curl_setopt($ch_anggota, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
        $result = curl_exec($ch_anggota); // execute the POST request
        curl_close($ch_anggota); // close cURL resource
        $json = json_decode($result,true);
        $response_json_code = $json['response_code'];
        $response_json_save_anggota = $json['response_data'];
                
                if ($response_json_code != 105 || (!empty($query))) {
                        
                    $this->session->set_flashdata('message', 'Gagal di Approve (Nasabah sudah terdaftar / error)'); // Buat session flashdata
                    redirect('Registrasi_controller/form_approval/'.$registrasi_id); 

                } else{
                        
                        $query = $this->Registrasi_model->approve($dataApprove);    
                        $this->session->set_flashdata('success', 'Berhasil di Approve'); // Buat session flashdata
                        redirect('Registrasi_controller');  
                }
    }

    public function rejectNasabah()
	{	
		$query = $this->Registrasi_model->cek_anggota($dataApprove);
		$dataReject = $this->input->post();
        $registrasi_id = $dataReject['registrasi_id'];
        $alasan_ditolak = $dataReject['alasan_ditolak'];
        $email = $dataReject['email'];
        $nama  = $dataReject['nama'];
        $judul = 'Assalamualaikum Warahmatullahi Wabarakatuh, '.$nama.'';
        $subject = 'Info Akun - Registrasi Ditolak';
        $kategori = 'registrasi_reject';
        $message = '    <tr>
                            <td width="70%">Di informasikan kepada Bapak / Ibu dengan data dibawah ini :</td>
                        </tr><br>
                        <tr>
                            <td width="70%">Nama    : '.$nama.'</td>
                            
                        </tr><br>
                        <tr>
                            <td width="70%">Email   : '.$email.'</td>
                            
                        </tr><br>
                        <tr>
                            
                            <td width="70%">Data pengajuan anda di reject karena "'.$alasan_ditolak.'"</td>
                            
                        </tr><br>
                        
                        <tr>
                            <td width="10%">Untuk detail lebih lanjut bisa hubungi Admin </td>
                        </tr><br>
                        <tr>
                            <td width="70%">Terima Kasih</td>
                        </tr>
                    ';
        
        $pengirim_nama      = 'robot';
		$url_api_prod 		= $this->config->item('url_api', 'api_setting');
		$url_send_email 	= $url_api_prod.'sent_email_scheduler_ver_2';
		$user_auth 			= $this->config->item('user_api', 'api_setting');
		$pass_auth 			= $this->config->item('password_api', 'api_setting');
		$response_json_code = 0;
		$ch_reject 	= curl_init($url_send_email); // create a new cURL resource
		$result 		= $this->config->item('result','api_setting');// setup request to send  
		$reject_nasabah	= json_encode(
									   array("target_email" =>$email,
                                              "target_nama"  =>$nama,
                                              "pengirim_nama"=>$pengirim_nama,
                                              "subject"      =>$subject,
                                              "kategori"     =>$kategori,
                                              "judul_1"      =>$judul,
                                              "isi_1"        => base64_encode($message)
									   )
									); 
		curl_setopt($ch_reject, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
		curl_setopt($ch_reject, CURLOPT_POSTFIELDS, $reject_nasabah); // attach encoded JSON string to the POST fields
		curl_setopt($ch_reject, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch_reject); // execute the POST request
		curl_close($ch_reject); // close cURL resource
		$json = json_decode($result,true);
          // echo '<pre>';
          //       var_dump($result);
          //       echo '</pre>';
          //       die();
		$response_json_code = $json['response_code'];
		$response_json_save_reject = $json['response_data'];
				
				if ($response_json_code != 105) {
						
					$this->session->set_flashdata('message', 'Gagal di Reject / error'); // Buat session flashdata
					redirect('Registrasi_controller'); 

				} else{	
                        $this->Registrasi_model->reject($dataReject); 
                        $this->session->set_flashdata('success', 'Data Registrasi Anda Berhasil di Reject');
                        redirect('Registrasi_controller');
				}
	}


	public function reject(){
    	$dataReject = $this->input->post();
 

  		$registrasi_id = $dataReject['registrasi_id'];
		$alasan_ditolak = $dataReject['alasan_ditolak'];
		$email = $dataReject['email'];
		$nama  = $dataReject['nama'];
		$subject = 'Pemberitahuan Reject';
        $message = '
                    <h3 align="center">Detail</h3>
                        <tr>
                            <td width="30%">Pemberitahuan </td> 
                        </tr><br><br>
                        <tr>
                            <td width="70%">Di informasikan kepada Bapak / Ibu dengan data dibawah ini :</td>
                        </tr><br>
                        <tr>
                            <td width="70%">Nama	: '.$nama.'</td>
                            
                        </tr><br>
                        <tr>
                            <td width="70%">Email	: '.$email.'</td>
                            
                        </tr><br>
                        <tr>
                            
                            <td width="70%">Data pengajuan anda di reject karena "'.$alasan_ditolak.'"</td>
                            
                        </tr><br>
                        
                        <tr>
                            <td width="10%">Untuk detail lebih lanjut bisa hubungi Admin </td>
                        </tr><br>
                        <tr>
                            <td width="70%">Terima Kasih</td>
                        </tr>
                    ';
        
        $config = get_smtp_config();
                    // var_dump($config);die();
                    $this->email->initialize($config);
                    $this->email->from($config['smtp_user'], 'IT Kopkar');
                    $this->email->to($email);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    // $this->email->set_crlf("\r\n");
        $suc=$this->email->send();
    	
    	$this->Registrasi_model->reject($dataReject); 
	    $this->session->set_flashdata('success', 'Data Rregistrasi Anda Berhasil diReject');
	    redirect('Registrasi_controller');
    }

	
    public function delete($id){
	    $this->Registrasi_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Registrasi Berhasil Dihapus');
	    redirect('Registrasi_controller');
	}
}
