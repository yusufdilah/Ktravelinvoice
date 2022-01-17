<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Divisi_model");
        $this->load->model("Maskapai_model");
        $this->load->model("Tiket_model");
        $this->load->model("Reminder_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["tiket"] = $this->Tiket_model->getAll();
        $data["reminder"] = $this->Reminder_model->getAll();
        $data["dataAkomodasi"] = $this->Maskapai_model->getAll();
        $data['jml_foll_up'] = $this->Reminder_model->count_jml_foll_up();
        $this->load->view("reminder/lihat_reminder", $data);
    }

    public function list_foll_up()
    {
       
        $data['list_foll_up'] = $this->Reminder_model->list_foll_up();
        $this->load->view("reminder/lihat_list_foll_up", $data);
    }

    // get sub maskapai by akomodasi_id
    function get_akomodasi(){
        $akomodasi_id = $this->input->post('id',TRUE);
        $data = $this->Tiket_model->get_akomodasi($akomodasi_id)->result();
        echo json_encode($data);
    }

    public function add()
    {
        // echo 'hello';die();
        $perusahaan = $this->Reminder_model;
        $validation = $this->form_validation;
		    $validation->set_rules($perusahaan->rules());
        if ($validation->run()) {
            $perusahaan->save();
            $this->session->set_flashdata('success', 'Tambah Reminder Berhasil Disimpan');
            redirect('Reminder_controller');
        }

        $this->load->view("reminder/lihat_reminder");
    }

  //   public function edit($id){

  //   	$faq = $this->Customer_model; //object model
  //       $validation = $this->form_validation; //object validasi
  //       $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

  //       if ($validation->run()) { //lakukan validasi form
  //           $faq->update($id); // update data
  //           $this->session->set_flashdata('success', 'Data FAQ Berhasil Diubah');
  //           redirect('Reminder_controller');
  //       }

  //       // $faq= $this->Customer_model->getById($id);
		// $data['list_divisi'] = $this->Customer_model->getById($id);
  //       $this->load->view('customer/lihat_customer', $data);
  //   }

    public function edit(){
    	$dataPerusahaan = $this->input->post();
    	$id 	= $dataPerusahaan['perusahaan_id'];
    	$perusahaan = $this->Perusahaan_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($perusahaan->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $perusahaan->update($id); // update data
            $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Diubah');
            redirect('Reminder_controller');
        }
    }

	public function approve($id){

    	$faq = $this->Customer_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $faq->approve($id); // approve data
            // $this->session->set_flashdata('success', 'Itu akan jadi proses Approve');
            redirect('Reminder_controller');
        }

        // $faq= $this->Customer_model->getById($id);
		$data['faq'] = $this->Customer_model->getById($id);
        $this->load->view('customer/approve_faq', $data);
    }

    public function delete($id){
	    $this->Perusahaan_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Dihapus');
	    redirect('Reminder_controller');
	}

}
