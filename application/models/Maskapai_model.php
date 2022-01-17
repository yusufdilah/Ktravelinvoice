<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Maskapai_model extends CI_Model
{
	
	private $_table= "maskapai";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'akomodasi',
			'label' => 'akomodasi',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		// $this->db->join('detail_maskapai dm','dm.akomodasi_id = '.$this->_table.'.akomodasi_id','left');
		// $this->db->join('customer c','c.customer_id = '.$this->_table.'.customer','left');
		$this->db->order_by($this->_table.'.created_date','DESC');
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getDetailMaskapai(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('detail_maskapai dm','dm.akomodasi_id = '.$this->_table.'.akomodasi_id','left');
		// $this->db->join('customer c','c.customer_id = '.$this->_table.'.customer','left');
		$this->db->order_by($this->_table.'.created_date','DESC');
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["maskapai_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->faq_id = uniqid();
		$this->akomodasi = $post["akomodasi"];
		$this->nama_maskapai = $post["nama_maskapai"];
		
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"akomodasi" => $this->input->post('akomodasi'),
			"nama_maskapai" => $this->input->post('nama_maskapai'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('maskapai_id', $id);
	    $this->db->update('maskapai', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('maskapai_id', $id);
    	$this->db->delete('maskapai'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}
}
?>
