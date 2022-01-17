<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Reminder_model extends CI_Model
{
	
	private $_table= "history_foll_up";

	public function rules()
	{
		return [
			['field' => 'pic',
			'label' => 'pic',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from('invoice');
		$this->db->order_by('created_date','DESC');
		$this->db->where('status',3);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}
	public function list_foll_up(){

		$this->db->select('history_foll_up.pic as pic_foll_up,
						pic.pic as pic_invoice,
						history_foll_up.*');	
		$this->db->from('history_foll_up');
		$this->db->join('invoice', 'invoice.no_invoice = history_foll_up.invoice_no','LEFT');
		$this->db->join('pic', 'pic.pic_id = invoice.pic','LEFT');
		$this->db->order_by('history_foll_up.created_date','DESC');
		$this->db->where('invoice.status',4);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}
	public function count_jml_foll_up(){
		$this->db->select('*');
		$this->db->from('invoice');
		$this->db->order_by('created_date','DESC');
		$this->db->where('status',4);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->num_rows();
	}


	function get_akomodasi($akomodasi_id){
		$query = $this->db->get_where('maskapai', array('akomodasi_id' => $akomodasi_id));
		return $query;
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["perusahaan_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->faq_id = uniqid();
		$curent_date	   = date('Y-m-d');
		$this->tgl_foll_up = $curent_date;
		$this->invoice_no = $post["invoice_no"];
		$this->pic 		  = $post["pic"];
		$this->keterangan = $post["keterangan"];
		
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);

		$updated_date = date('Y-m-d H:i:s');
		
		$this->db->set('status', 4);
		$this->db->set('updated_date', $curent_date);
		$this->db->set('updated_by', $session_nasabah);
		$this->db->where('no_invoice', $post["invoice_no"]);
		$this->db->update('invoice');

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
	}

	public function jml_tiket_jwb_spv() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
				";

	    $data = $this->db->query($query);
	    // select * from tiket_history th group by tiket_id order by tiket_history_id 'desc'
		//print_r($this->db->last_query());die();
		return $data->num_rows();
	}	
	
	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"nm_perusahaan" => $this->input->post('nm_perusahaan'),
			"alamat_perusahaan" => $this->input->post('alamat_perusahaan'),
            "no_telepon" => $this->input->post('no_telepon'),
            "email" => $this->input->post('email'),
            "bank_cabang" => $this->input->post('bank_cabang'),
            "no_rekening" => $this->input->post('no_rekening'),
            "atas_nama" => $this->input->post('atas_nama'),
            "penanda_tangan" => $this->input->post('penanda_tangan'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('perusahaan_id', $id);
	    $this->db->update('perusahaan', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('perusahaan_id', $id);
    	$this->db->delete('perusahaan'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}
}
?>
