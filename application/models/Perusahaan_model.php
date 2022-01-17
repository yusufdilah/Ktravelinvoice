<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Perusahaan_model extends CI_Model
{
	
	private $_table= "perusahaan";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'nm_perusahaan',
			'label' => 'nm_perusahaan',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('created_date', SORT_DESC);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
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
		$this->nm_perusahaan = $post["nm_perusahaan"];
		$this->alamat_perusahaan = $post["alamat_perusahaan"];
		$this->no_telepon = $post["no_telepon"];
		$this->email = $post["email"];
		$this->bank_cabang = $post["bank_cabang"];
		$this->no_rekening = $post["no_rekening"];
		$this->atas_nama = $post["atas_nama"];
		$this->penanda_tangan = $post["penanda_tangan"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
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

	// chained dropdown
	public function chained_dropdown($perusahaan_id, $divisi_id){
		$this->db->select('perusahaan.*, divisi.perusahaan_id, divisi.nm_group_head, divisi.divisi_id');
		$this->db->from($this->_table);
		$this->db->join('divisi', 'divisi.perusahaan_id='.$this->_table.'.perusahaan_id');
		$this->db->where('perusahaan.perusahaan_id='.$perusahaan_id);
		$this->db->where('divisi.divisi_id='.$divisi_id);
		$data = $this->db->get();
		return $data->result();
	}
}
?>
