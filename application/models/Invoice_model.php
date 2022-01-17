<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Invoice_model extends CI_Model
{
    private $_table = 'invoice';

    public function rules()
    {
        return [
            ['field' => 'divisi',
			'label' => 'divisi',
			'rules' => 'required|numeric'],

            ['field' => 'perusahaan',
			'label' => 'perusahaan',
			'rules' => 'required|numeric'],

            ['field' => 'pic',
			'label' => 'pic',
			'rules' => 'required|numeric'],

            ['field' => 'tiket_id[]',
			'label' => 'tiket',
			'rules' => 'required|numeric'],

        ];
    }

    public function getAll(){
        $this->db->select($this->_table.'.*, divisi.nm_group_head, divisi.divisi_id,divisi.nama_divisi, customer.nip_customer, 
        SUM(tiket.hpp) as total_hpp, SUM(tiket.service_fee) as total_service_fee, SUM(tiket.biaya_lain) as total_biaya_lain, 
        SUM(tiket.harga_jual) as total_harga_jual,count(tiket.tiket_id) as jml_tiket')
        ->from($this->_table)
        ->join('divisi', 'divisi.divisi_id=invoice.divisi_id','LEFT')
        ->join('customer', 'customer.divisi=invoice.divisi_id','LEFT')
        ->join('tiket', 'tiket.no_invoice=invoice.no_invoice','LEFT')
        ->group_by($this->_table.'.invoice_id')
        ->order_by($this->_table.'.created_date', SORT_DESC);
        $data = $this->db->get();
        // print_r($this->db->last_query());die();
        return $data->result();
    }

    public function getById($id){
        $this->db->select($this->_table.'.*, divisi.divisi_id, divisi.nm_group_head, perusahaan.alamat_perusahaan,
        perusahaan.perusahaan_id')
        ->from($this->_table)
        ->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi_id','LEFT')
        ->join('perusahaan', 'perusahaan.perusahaan_id='.$this->_table.'.perusahaan_identitas','LEFT')
        ->where($this->_table.'.invoice_id', $id);
        $datas = $this->db->get();

        return $datas->row();
    }

    public function save(){
        // $this->db->query('SELECT * FROM perusahaan where status_perusahaan = 1');
        // $perusahaan_identitas_name =  $this->db->get()->row()->nm_perusahaan;
        // echo $perusahaan_identitas_name.'tester';die();

        $query = $this->db->query("SELECT * FROM perusahaan where status_perusahaan = 1");

        foreach ($query->result_array() as $row)
        {
                $perusahaan_identitas_name = $row['nm_perusahaan'];
                $perusahaan_identitas_id   = $row['perusahaan_id'];
        }
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
        
        $this->no_invoice = $this->invoice_number();
        $this->perusahaan_cust = $post['perusahaan'];
        $this->perusahaan_identitas = $perusahaan_identitas_id;
        $this->pic_id = $post['pic'];
        $this->divisi_id = $post['divisi'];
        $this->created_by = $session_nasabah;
        $tiket_id = $post['tiket_id'];
		
		$this->db->insert($this->_table, $this);

        foreach($tiket_id as $tiket){
            $this->db->where('tiket_id', $tiket);
            $this->db->update('tiket', ['no_invoice'=>$this->no_invoice]);
        }
	}

    public function update($id){
        $session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
        
        $invoice =  $this->db->get_where($this->_table, ['id' => $id])->row();

        $data = [
            'divisi_id' => $this->input->post('divisi'),
            'perusahaan_id' => $this->input->post('perusahaan'),
            'pic_id' => $this->input->post('pic'),
            'updated_date' => $updated_date,
            'updated_by' => $session_nasabah,
        ];
        $tiket_id = $this->input->post('tiket_id');

        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);

        foreach($tiket_id as $tiket){
            $this->db->where('tiket_id', $tiket);
            $this->db->update('tiket', ['no_invoice'=>$invoice->no_invoice]);
        }
    }

    public function delete($id){
        $this->db->select($this->_table.'.no_invoice, tiket.no_invoice, tiket.tiket_id')
        ->from($this->_table)
        ->join('tiket', 'tiket.no_invoice='.$this->_table.'.no_invoice','LEFT')
        ->where($this->_table.'.invoice_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        
        foreach($data as $tiket_id){
            $this->db->where('tiket_id', $tiket_id->tiket_id);
            $this->db->update('tiket', ['no_invoice'=>null]);
        }

        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

    // generate nomor invoice
    public function invoice_number(){
        $this->db->select("no_invoice");
        $this->db->from('invoice');
        $this->db->order_by('no_invoice', SORT_DESC);
        $data = $this->db->get();
        
        if($data->num_rows() > 0){
            $invoice_number = $data->last_row();
            $int = (int) $invoice_number->no_invoice + 1;
            return '000'.(string) $int;
        }else{
            return '0001';
        }
    }

    // ambil data untuk PDF
    public function getPdfData($id){
        $this->db->select($this->_table.'.*, divisi.alamat_divisi,divisi.nama_divisi, divisi.nm_group_head, perusahaan.*, pic.pic, SUM(tiket.hpp) as total_hpp, SUM(tiket.service_fee) as total_service_fee, 
        SUM(tiket.biaya_lain) as total_biaya_lain, SUM(tiket.harga_jual) as total_harga_jual')
        ->from($this->_table)
        ->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi_id','LEFT')
        ->join('cust_perusahaan', 'cust_perusahaan.cust_perusahaan_id='.$this->_table.'.perusahaan_cust','LEFT')
        ->join('perusahaan', 'perusahaan.perusahaan_id='.$this->_table.'.perusahaan_identitas','LEFT')
        ->join('pic', 'pic.pic_id='.$this->_table.'.pic_id','LEFT')
        ->join('tiket', 'tiket.no_invoice=invoice.no_invoice','LEFT')
        ->where($this->_table.'.invoice_id', $id);
        $datas = $this->db->get();

        return $datas->row();
    }
}