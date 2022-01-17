<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->model("Divisi_model");
        $this->load->model("Perusahaan_model");
        $this->load->model("Vendor_model");
        $this->load->model("Maskapai_model");
        $this->load->model("Tiket_model");
        $this->load->model("Route_model");
        $this->load->library('form_validation');
        $this->load->helper('form');    
        $this->config->load('upload_setting', TRUE);    
        $this->config->load('api_setting', TRUE);
        $this->load->library('upload');
    }

    public function index()
    {
        $data["perusahaan"] = $this->Perusahaan_model->getAll();
        $data["dataCustomer"] = $this->Customer_model->getAll();
        $data["tiket"] = $this->Tiket_model->getAll();
        $data["dataVendor"] = $this->Vendor_model->getAll();
        $data["dataDivisi"] = $this->Divisi_model->getAll();
        $data["dataAkomodasi"] = $this->Maskapai_model->getAll();
        $data["dataMaskapai"] = $this->Maskapai_model->getDetailMaskapai();
        $data['jml_close_tiket'] = $this->Tiket_model->count_jml_close_tiket();
        $data["dataRoute"] = $this->Route_model->getAll();
        $this->load->view("tiket/lihat_tiket", $data);
    }

    public function list_tiket_closed()
    {
       
        $data['list_tiket_closed'] = $this->Tiket_model->list_tiket_closed();
        $this->load->view("tiket/lihat_tiket_closed", $data);
    }

    // get sub maskapai by akomodasi_id
    function get_akomodasi(){
        $akomodasi_id = $this->input->post('id',TRUE);
        $data = $this->Tiket_model->get_akomodasi($akomodasi_id)->result();
        echo json_encode($data);
    }

    function get_vendor(){
        $vendor_id = $this->input->post('id',TRUE);
        $data = $this->Tiket_model->get_vendor($vendor_id)->result();
        echo json_encode($data);
    }

    public function add()
    {
        // echo 'masuk';die();    
        $dataTiket      = $this->input->post();
        $tgl_issued     = $dataTiket['tgl_issued'];
        $tgl_berangkat  = $dataTiket['tgl_berangkat'];
        $kode_booking   = $dataTiket['kode_booking'];
        $no_memo        = $dataTiket['no_memo'];
        $customer       = $dataTiket['customer'];
        $divisi         = $dataTiket['divisi'];
        $vendor         = $dataTiket['vendor'];
        $akomodasi      = $dataTiket['akomodasi'];
        $maskapai       = $dataTiket['maskapai'];
        $hotel          = $dataTiket['hotel'];
        $alamat_hotel   = $dataTiket['alamat_hotel'];
        $route          = $dataTiket['route'];
        $vendor         = $dataTiket['vendor'];
        $hpp            = $dataTiket['hpp'];
        $service_fee    = $dataTiket['service_fee'];
        $biaya_lain     = $dataTiket['biaya_lain'];
        $harga_jual     = $dataTiket['harga_jual'];
        $bookers        = $dataTiket['bookers'];
        $curent_date = date('Y-m-d');
        $Tiket_model = $this->Tiket_model;
        // print_r($Tiket_model);die();
        $validation = $this->form_validation;

        $validation->set_rules($Tiket_model->rules());
        // echo '<pre>'; var_dump($this->input->post()); echo '</pre>'; 
        // die();
        $test = $validation->set_rules($Tiket_model->rules());
        // print_r($test);die();
        if ($validation->run()) {
            $this->config->load('upload_setting', TRUE);
        
            $config = $this->config->item('upload_setting');
            date_default_timezone_set("Asia/Jakarta");
            $tanggal = date('dmyhi');
            // $config['file_name'] = $info_tb.$a;
            // $config['allowed_types']  = 'jpg|jpeg|pdf|doc';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $session_nasabah = $this->session->userdata('token_nasabah');  
            $upload_tiket = $_FILES['tiket_file']['name'];
            $upload_spj   = $_FILES['spj_file']['name'];
            // echo 'ett';die();
            if (!empty($upload_tiket) && empty($upload_spj)) 
            {
                // echo 'sama upload tiket';die();
                if ($this->upload->do_upload('tiket_file')) {
                    // echo "tahannn";die();
                    // return $this->upload->data("file_name");
                    
                    $tiket_file = $this->upload->data();
                    // echo '<pre>'; var_dump($tiket_file); echo '</pre>'; 
                    // die();
                    $data_add=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'tiket_file'=> $tiket_file['file_name'],
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'created_by' => $session_nasabah
                    ];
                    // echo'tahandulu';die();
                    $Tiket_model->save($data_add);
                    $this->session->set_flashdata('success', 'Tambah Tiket Berhasil Disimpan');
                    redirect('Tiket_controller');
                }else{
                    $this->session->set_flashdata('message',$this->upload->display_errors());
                    redirect('Tiket_controller');
                }
            }
            else if (!empty($upload_spj) && !empty($upload_tiket)) 
            {
                // echo "masook";die();
                if ($this->upload->do_upload('spj_file') && $this->upload->do_upload('tiket_file')) {
                   // echo "masook";die();
                    // return $this->upload->data("file_name");
                    // $this->upload->do_upload('spj_file');
                    $this->upload->do_upload('spj_file');
                    $spj_file = $this->upload->data();
                    // $spj_file = $this->upload->data();

                    $this->upload->do_upload('tiket_file');
                    $tiket_file = $this->upload->data();
                    $data_add=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'spj_file'=> $spj_file['file_name'],
                        'tiket_file'=> $tiket_file['file_name'],
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'created_by' => $session_nasabah
                    ];
                    $Tiket_model->save($data_add);
                    $this->session->set_flashdata('success', 'Tambah Tiket Berhasil Disimpan');
                    redirect('Tiket_controller');
                }
                else{
                    $this->session->set_flashdata('message',$this->upload->display_errors());
                    redirect('Tiket_controller');
                    // echo 'salahcuy!!!!!';die();
                }
            }
            else{
                $data_add=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'created_by' => $session_nasabah
                    ];
                    $Tiket_model->save($data_add);
                    $this->session->set_flashdata('success', 'Tambah Tiket Berhasil Disimpan');
                    redirect('Tiket_controller');
                }
        }
        // else{
        //     echo 'ga masuk validasi';die();
        // }
        $this->load->view("tiket/lihat_tiket");
    }

    public function update()
    {
        // echo 'masuk';die();    
        $dataTiket      = $this->input->post();
        $id             = $dataTiket['tiket_id'];
        $tgl_issued     = $dataTiket['tgl_issued'];
        $tgl_berangkat  = $dataTiket['tgl_berangkat'];
        $kode_booking   = $dataTiket['kode_booking'];
        $no_memo        = $dataTiket['no_memo'];
        $customer       = $dataTiket['customer'];
        $divisi         = $dataTiket['divisi'];
        $vendor         = $dataTiket['vendor'];
        $akomodasi      = $dataTiket['akomodasi'];
        $maskapai       = $dataTiket['maskapai'];
        $hotel          = $dataTiket['hotel'];
        $alamat_hotel   = $dataTiket['alamat_hotel'];
        $route          = $dataTiket['route'];
        $vendor         = $dataTiket['vendor'];
        $hpp            = $dataTiket['hpp'];
        $service_fee    = $dataTiket['service_fee'];
        $biaya_lain     = $dataTiket['biaya_lain'];
        $harga_jual     = $dataTiket['harga_jual'];
        $bookers        = $dataTiket['bookers'];
        $curent_date = date('Y-m-d');
        $Tiket_model = $this->Tiket_model;
        // print_r($Tiket_model);die();
        $validation = $this->form_validation;

        $validation->set_rules($Tiket_model->rules());
        // echo '<pre>'; var_dump($this->input->post()); echo '</pre>'; 
        // die();
        $test = $validation->set_rules($Tiket_model->rules());
        // print_r($test);die();
        if ($validation->run()) {
            $this->config->load('upload_setting', TRUE);
        
            $config = $this->config->item('upload_setting');
            date_default_timezone_set("Asia/Jakarta");
            $tanggal = date('dmyhi');
            // $config['file_name'] = $info_tb.$a;
            // $config['allowed_types']  = 'jpg|jpeg|pdf|doc';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $session_nasabah = $this->session->userdata('token_nasabah');  
            $upload_tiket = $_FILES['tiket_file']['name'];
            $upload_spj   = $_FILES['spj_file']['name'];
            // echo 'ett';die();
            if (!empty($upload_tiket) && empty($upload_spj)) 
            {
                // echo 'sama upload tiket';die();
                if ($this->upload->do_upload('tiket_file')) {
                    // echo "tahannn";die();
                    // return $this->upload->data("file_name");
                    
                    $tiket_file = $this->upload->data();
                    // echo '<pre>'; var_dump($tiket_file); echo '</pre>'; 
                    // die();
                    $data_edit=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'tiket_file' => $Tiket_model->_deleteFileTiket($id),
                        'tiket_file'=> $tiket_file['file_name'],
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'updated_by' => $session_nasabah
                    ];
                    // echo'tahandulu';die();
                    $Tiket_model->update($id,$data_edit);
                    $this->session->set_flashdata('success', 'Tambah Tiket Berhasil Diupdate');
                    redirect('Tiket_controller');
                }else{
                    $this->session->set_flashdata('message',$this->upload->display_errors());
                    redirect('Tiket_controller');
                }
            }
            else if (empty($upload_tiket) && !empty($upload_spj)) 
            {
                // echo 'sama upload tiket';die();
                if ($this->upload->do_upload('tiket_file')) {
                    // echo "tahannn";die();
                    // return $this->upload->data("file_name");
                    
                    $tiket_file = $this->upload->data();
                    // echo '<pre>'; var_dump($tiket_file); echo '</pre>'; 
                    // die();
                    $data_edit=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'spj_file' => $Tiket_model->_deleteFileSPJ($id),
                        'spj_file'=> $spj_file['file_name'],
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'updated_by' => $session_nasabah
                    ];
                    // echo'tahandulu';die();
                    $Tiket_model->update($id,$data_edit);
                    $this->session->set_flashdata('success', 'Tambah Tiket Berhasil Diupdate');
                    redirect('Tiket_controller');
                }else{
                    $this->session->set_flashdata('message',$this->upload->display_errors());
                    redirect('Tiket_controller');
                }
            }
            else if (!empty($upload_spj) && !empty($upload_tiket)) 
            {
                // echo "masook";die();
                if ($this->upload->do_upload('spj_file') && $this->upload->do_upload('tiket_file')) {
                   // echo "masook";die();
                    // return $this->upload->data("file_name");
                    // $this->upload->do_upload('spj_file');
                    $this->upload->do_upload('spj_file');
                    $spj_file = $this->upload->data();
                    // $spj_file = $this->upload->data();

                    $this->upload->do_upload('tiket_file');
                    $tiket_file = $this->upload->data();
                    $data_edit=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'spj_file' => $Tiket_model->_deleteFileSPJ($id),
                        'spj_file'=> $spj_file['file_name'],
                        'tiket_file' => $Tiket_model->_deleteFileTiket($id),
                        'tiket_file'=> $tiket_file['file_name'],
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'updated_by' => $session_nasabah
                    ];
                    $Tiket_model->update($id,$data_edit);
                    $this->session->set_flashdata('success', 'Tiket Berhasil Diupdate');
                    redirect('Tiket_controller');
                }
                else{
                    $this->session->set_flashdata('message',$this->upload->display_errors());
                    redirect('Tiket_controller');
                    // echo 'salahcuy!!!!!';die();
                }
            }
            else{
                $data_edit=[
                        'tgl_issued' => $tgl_issued,
                        'tgl_berangkat' => $tgl_berangkat,
                        'kode_booking' => $kode_booking,
                        'no_memo' => $no_memo,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'divisi' => $divisi,
                        'akomodasi' => $akomodasi,
                        'maskapai' => $maskapai,
                        'hotel' => $hotel,
                        'alamat_hotel' => $alamat_hotel,
                        'route' => $route,
                        'hpp' => $hpp,
                        'service_fee' => $service_fee,
                        'biaya_lain' => $biaya_lain,
                        'harga_jual' => $harga_jual,
                        'bookers' => $bookers,
                        'is_close' => 0,
                        'updated_by' => $session_nasabah
                    ];
                    $Tiket_model->update($id,$data_edit);
                    $this->session->set_flashdata('success', 'Tiket Berhasil Diupdate');
                    redirect('Tiket_controller');
                }
        }
        // else{
        //     echo 'ga masuk validasi';die();
        // }
        $this->load->view("tiket/lihat_tiket");
    }


    public function edit(){
        echo "Under Construction";die();
    	// $dataPerusahaan = $this->input->post();
    	// $id 	= $dataPerusahaan['perusahaan_id'];
    	// $perusahaan = $this->Perusahaan_model; //object model
     //    $validation = $this->form_validation; //object validasi
     //    $validation->set_rules($perusahaan->rules()); //terapkan rules di Customer_model.php

     //    if ($validation->run()) { //lakukan validasi form
     //        $perusahaan->update($id); // update data
     //        $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Diubah');
     //        redirect('Tiket_controller');
     //    }
    }

	public function approve($id){

    	$faq = $this->Customer_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($faq->rules()); //terapkan rules di Customer_model.php

        if ($validation->run()) { //lakukan validasi form
            $faq->approve($id); // approve data
            // $this->session->set_flashdata('success', 'Itu akan jadi proses Approve');
            redirect('Tiket_controller');
        }

        // $faq= $this->Customer_model->getById($id);
		$data['faq'] = $this->Customer_model->getById($id);
        $this->load->view('customer/approve_faq', $data);
    }

    public function delete($id){
        $this->Tiket_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Perusahaan Berhasil Dihapus');
        redirect('Tiket_controller');
    }

    public function close_tiket($id){
	    $this->Tiket_model->close_tiket($id); 
	    $this->session->set_flashdata('success', 'Tiket berhasil di close');
	    redirect('Tiket_controller');
	}

    public function close_tiket_all()
    {

        $ids = $this->input->post('ids');
        $this->db->where_in('tiket_id', explode(",", $ids));
        $this->db->update('tiket', ['is_close'=>1]);

        echo json_encode(['success'=>"Tiket berhasil di Close."]);

    }

    public function detailTiketInvoice(){
        $divisi_id = $this->input->post('divisiid');
        $no_invoice = $this->input->post('noinvoicedetail');
        $tiket = $this->Tiket_model;

        $data['tiket'] = $tiket->invoiceListTiket($no_invoice, $divisi_id);
        $this->load->view('invoice/data_detail', $data);
    }

    public function genereate_list_tiket(){
        $divisi_id = $this->input->post('divisi_id');
        $from_periode = $this->input->post('from');
        $to_periode = $this->input->post('to');

        $tiket = $this->Tiket_model->generateListTiket($divisi_id, $from_periode, $to_periode);

        echo json_encode($tiket);
    }

    public function removeTiketFromInvoice(){
        $tiket = $this->Tiket_model;
        $tiket_id = $this->input->post('tiket_id');
        $tiket->removeTiketFromInvoice($tiket_id);

        echo json_encode('SUCCESS, tiket ID : '.$tiket_id);
    }

}
