<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Divisi_model extends CI_Model
{
	
	private $_table= "divisi";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'nama_divisi',
			'label' => 'nama_divisi',
			'rules' => 'required'],

			['field' => 'nm_group_head',
			'label' => 'nm_group_head',
			'rules' => 'required'],

			['field' => 'perusahaan_id',
			'label' => 'perusahaan_id',
			'rules' => 'required']
		];
	}

	// public function getALL(){
	// 	$this->db->select($this->_table.'.*, perusahaan.perusahaan_id, perusahaan.nm_perusahaan');
	// 	$this->db->from($this->_table);
	// 	$this->db->join('perusahaan', 'perusahaan.perusahaan_id='.$this->_table.'.perusahaan_id');
	// 	$this->db->order_by($this->_table.'.created_date', SORT_DESC);
	// 	$data = $this->db->get();
	// 	return $data->result();
	// }

	public function getALL(){
		$this->db->select($this->_table.'.*, cust_perusahaan.cust_perusahaan_id, cust_perusahaan.nm_cust_perusahaan');
		$this->db->from($this->_table);
		$this->db->join('cust_perusahaan', 'cust_perusahaan.cust_perusahaan_id='.$this->_table.'.perusahaan_id','LEFT');
		$this->db->order_by($this->_table.'.created_date', SORT_DESC);
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
		$this->nama_divisi = $post["nama_divisi"];
		$this->alamat_divisi = $post["alamat_divisi"];
		$this->no_telepon = $post["no_telepon"];
		$this->nama_sekretaris = $post["nama_sekretaris"];
		$this->nm_group_head = $post["nm_group_head"];
		$this->perusahaan_id = $post["perusahaan_id"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"nama_divisi" => $this->input->post('nama_divisi'),
			"alamat_divisi" => $this->input->post('alamat_divisi'),
            "no_telepon" => $this->input->post('no_telepon'),
            "nama_sekretaris" => $this->input->post('nama_sekretaris'),
            "nm_group_head" => $this->input->post('nm_group_head'),
			"perusahaan_id" => $this->input->post('perusahaan_id'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('divisi_id', $id);
	    $this->db->update('divisi', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('divisi_id', $id);
    $this->db->delete('divisi'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}
}
?>
