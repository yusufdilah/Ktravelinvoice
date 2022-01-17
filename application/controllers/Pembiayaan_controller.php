<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembiayaan_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kategori_model");
        $this->load->library('form_validation');
    }

    public function index()
    {

        // $data["kategori"] = $this->Kategori_model->getAll();
        $kd_pembayaran     = "";
        $url        = 'https://new-my.kopkarbsm.co.id/Rest_api/Api_global?action=dokumen_awal_pembiayaan';

        $user_auth  = "k0pk4r85m-324-#$@87$#@x";
        $pass_auth  = "923#@&%$-hows32&^3221";
        $response_json_code = 0;

        $ch         = curl_init($url); // create a new cURL resource
        $result     = json_decode(file_get_contents('php://input'), true); // setup request to send json via POST
        //$data     = json_encode(array("token" => "0adbfc029162963a272b0c28f6425345")); // define get data berdasarkan norek

        $data       = json_encode(array("no_pembiayaan" => $kd_pembayaran)); // define get data berdasarkan norek

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
        $result = curl_exec($ch); // execute the POST request
        curl_close($ch); // close cURL resource
        $json = json_decode($result,true);
        $data = array();    
        $data['json']        = json_decode($result,true);
       
        $this->load->view('pembiayaan/lihat_pembiayaan',$data);
    }

    public function search()
    {

 // echo "ini search curl";die();
        $kd_pembayaran     = $_POST["kd_pembayaran"];
        $url        = 'https://new-my.kopkarbsm.co.id/Rest_api/Api_global?action=dokumen_awal_pembiayaan';

        $user_auth  = "k0pk4r85m-324-#$@87$#@x";
        $pass_auth  = "923#@&%$-hows32&^3221";
        $response_json_code = 0;

        $ch         = curl_init($url); // create a new cURL resource
        $result     = json_decode(file_get_contents('php://input'), true); // setup request to send json via POST
        //$data     = json_encode(array("token" => "0adbfc029162963a272b0c28f6425345")); // define get data berdasarkan norek

        $data       = json_encode(array("no_pembiayaan" => $kd_pembayaran)); // define get data berdasarkan norek

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
        $result = curl_exec($ch); // execute the POST request
        curl_close($ch); // close cURL resource
        $json = json_decode($result,true);
        $data = array();    
        $data['json']        = json_decode($result,true);
        // echo '<pre>';
        //         var_dump($json);
        //         echo '</pre>';
        //         die();
	    // $data["kategori"] = $this->Kategori_model->getAll();
        $this->load->view('pembiayaan/lihat_pembiayaan',$data);
    }


    public function add()
    {
        $setting_menu = $this->Kategori_model;
        $validation = $this->form_validation;
		$validation->set_rules($setting_menu->rules());
        if ($validation->run()) {
            $setting_menu->save();
            $this->session->set_flashdata('success', 'Tambah Home Slider dengan judul '.$setting_menu->judul.' Berhasil Disimpan');
            redirect('Pembiayaan_controller');
        }

        $this->load->view("setting_menu/tambah_setting_menu");
    }

    public function edit($id){

    	$setting_menu = $this->Kategori_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($setting_menu->rules()); //terapkan rules di Kategori_model.php

        if ($validation->run()) { //lakukan validasi form
            $setting_menu->update($id); // update data
            $this->session->set_flashdata('success', 'Data Home Slider Berhasil Diubah');
            redirect('Pembiayaan_controller');
        }

        // $setting_menu= $this->Kategori_model->getById($id);
		$data['setting_menu'] = $this->Kategori_model->getById($id);
        $this->load->view('setting_menu/edit_setting_menu', $data);
    }

    public function delete($id){
	    $this->Kategori_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Home Slider Berhasil Dihapus');
	    redirect('Pembiayaan_controller');
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


	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();

		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'id_setting_menu'=> uniqid(),
					'nik'=>$row['A'], // Insert data nis dari kolom A di excel
					'nama'=>$row['B'], // Insert data nama dari kolom B di excel
					'alamat'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
					'nohp'=>$row['D'], // Insert data alamat dari kolom D di excel
				));
			}

			$numrow++; // Tambah 1 setiap kali looping
		}
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Kategori_model->insert_multiple($data);

		redirect("Pembiayaan_controller"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	

}
