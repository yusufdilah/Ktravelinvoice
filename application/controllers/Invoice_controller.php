<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Divisi_model');
        $this->load->model('Perusahaan_model');
        $this->load->model('Pic_model');
        $this->load->model('Tiket_model');
        $this->load->model('Invoice_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["divisi"] = $this->Divisi_model->getAll();
        $data['invoice'] = $this->Invoice_model->getAll();

        $this->load->view('invoice/list_invoice', $data);
    }

    public function add()
    {
        $invoice = $this->Invoice_model;
        $this->form_validation->set_rules($invoice->rules());
        if($this->form_validation->run()){
            $invoice->save();
            $this->session->set_flashdata('success', 'Tambah Invoice Berhasil Disimpan');
            redirect('Invoice_controller');
        }

        $this->session->set_flashdata('error', validation_errors());
        redirect('Invoice_controller');
    }

    public function update($id){
        $invoice = $this->Invoice_model;
        
        $this->form_validation->set_rules($invoice->rules());
        if($this->form_validation->run()){
            $invoice->update($id);
            $this->session->set_flashdata('success', 'Update Invoice Berhasil Disimpan');
            redirect('Invoice_controller');
        }

        $this->session->set_flashdata('error', validation_errors());
        redirect('Invoice_controller');
    }

    public function edit(){
        $invoice_id = $this->input->post('invoice_id');
        
        $invoice = $this->Invoice_model;
        $divisi = $this->Divisi_model;
        $perusahaan =$this->Perusahaan_model;
        $pic = $this->Pic_model;
        $tiket = $this->Tiket_model;
        
        $data['divisi'] = $divisi->getAll();
        $data['invoice'] = $invoice->getById($invoice_id);
        $data['perusahaan'] = $perusahaan->chained_dropdown($data['invoice']->perusahaan_id, $data['invoice']->divisi_id); // chained dropdown untuk perusahaan
        $data['pic'] = $pic->chained_dropdown($data['invoice']->divisi_id); //chained dropdown untuk pic
        $data['tiket'] = $tiket->invoiceListTiket($data['invoice']->no_invoice, $data['invoice']->divisi_id);

        $this->load->view("invoice/data_edit", $data);
    }

    public function Pay(){
        $dataPay = $this->input->post();
        $total_harga_jual = $dataPay['total_harga_jual'];
        $total_service_fee = $dataPay['total_service_fee'];
        echo "Total Harga Jual = ".$total_harga_jual; echo "  ";
        echo "Total Service Fee = ".$total_service_fee;
        die();
        echo "Pay / Pembayaran under construction";
    }


    public function Syn(){
        $dataSyn = $this->input->post();
        $total_harga_jual = $dataSyn['total_harga_jual'];
        $total_service_fee = $dataSyn['total_service_fee'];
        echo "Total Harga Jual = ".$total_harga_jual; echo "  ";
        echo "Total Service Fee = ".$total_service_fee;
        die();
        echo "Syn / Send Cost center under construction";
    }

    public function delete(){
        $invoice = $this->Invoice_model;
        $invoice_id = $this->input->post('invoice_id');
        $invoice->delete($invoice_id);

        $this->session->set_flashdata('success', 'Delete Invoice Berhasil');
        echo json_encode('success'); // kirim hasil data;
    }
}