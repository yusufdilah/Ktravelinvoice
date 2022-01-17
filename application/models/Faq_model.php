<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Faq_model extends CI_Model
{
	
	private $_table= "faq";

	// public $id;	
	public $judul;
	public $isi;
	public $status;
	public $seq;

	public function rules()
	{
		return [
			['field' => 'judul',
			'label' => 'judul',
			'rules' => 'required'],

			['field' => 'isi',
			'label' => 'isi',
			'rules' => 'required'],

			['field' => 'status',
			'label' => 'status',
			'rules' => 'required'],

			['field' => 'seq',
			'label' => 'seq',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('created_date',DESC);
		$data = $this->db->get();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["faq_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->faq_id = uniqid();
		$this->judul = $post["judul"];
		$this->isi = $post["isi"];
		$this->status = $post["status"];
		$this->seq = $post["seq"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"judul" => $this->input->post('judul'),
			"isi" => $this->input->post('isi'),
            "status" => $this->input->post('status'),
            "seq" => $this->input->post('seq'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('faq_id', $id);
	    $this->db->update('faq', $data); // Untuk mengeksekusi perintah update data
	}

	

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('faq_id', $id);
    $this->db->delete('faq'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}
}
?>
