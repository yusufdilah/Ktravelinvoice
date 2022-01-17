<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Customer_model extends CI_Model
{
	
	private $_table= "customer";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'nip_customer',
			'label' => 'nip_customer',
			'rules' => 'required'],

			['field' => 'nama_customer',
			'label' => 'nama_customer',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('divisi d','d.divisi_id = '.$this->_table.'.divisi','left');
		$this->db->order_by($this->_table.'.created_date', SORT_DESC);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["customer_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->faq_id = uniqid();
		$this->nip_customer = $post["nip_customer"];
		$this->ktp = $post["ktp"];
		$this->nama_customer = $post["nama_customer"];
		$this->is_anggota_kopkar = $post["is_anggota_kopkar"];
		$this->divisi = $post["divisi"];
		$this->jenis_kelamin = $post["jenis_kelamin"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"nip_customer" => $this->input->post('nip_customer'),
			"ktp" => $this->input->post('ktp'),
            "nama_customer" => $this->input->post('nama_customer'),
            "is_anggota_kopkar" => $this->input->post('is_anggota_kopkar'),
            "divisi" => $this->input->post('divisi'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('customer_id', $id);
	    $this->db->update('customer', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('customer_id', $id);
    	$this->db->delete('customer'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}
}
?>
