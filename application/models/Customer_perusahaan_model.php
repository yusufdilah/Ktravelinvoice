<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Customer_perusahaan_model extends CI_Model
{
	
	private $_table= "cust_perusahaan";

	// public $id;	

	public function rules()
	{
		return [
			['field' => 'nm_cust_perusahaan',
			'label' => 'nm_cust_perusahaan',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('created_date','DESC');
		$data = $this->db->get();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["cust_perusahaan_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->cust_perusahaan_id = uniqid();
		$this->nm_cust_perusahaan = $post["nm_cust_perusahaan"];
		$this->alamat_perusahaan = $post["alamat_perusahaan"];
		$this->no_telepon = $post["no_telepon"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"nm_cust_perusahaan" => $this->input->post('nm_cust_perusahaan'),
			"alamat_perusahaan" => $this->input->post('alamat_perusahaan'),
            "no_telepon" => $this->input->post('no_telepon'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('cust_perusahaan_id', $id);
	    $this->db->update('cust_perusahaan', $data); // Untuk mengeksekusi perintah update data
	}

	

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('cust_perusahaan_id', $id);
    	$this->db->delete('cust_perusahaan'); // Untuk mengeksekusi perintah delete data
	}

	public function chained_dropdown($perusahaan_id, $divisi_id){
		$this->db->select('cust_perusahaan.*, divisi.perusahaan_id, divisi.nm_group_head, divisi.divisi_id');
		$this->db->from($this->_table);
		$this->db->join('divisi', 'divisi.perusahaan_id='.$this->_table.'.cust_perusahaan_id','LEFT');
		$this->db->where('cust_perusahaan.cust_perusahaan_id='.$perusahaan_id);
		$this->db->where('divisi.divisi_id='.$divisi_id);
		$data = $this->db->get();
		return $data->result();
	}
	
}
?>
