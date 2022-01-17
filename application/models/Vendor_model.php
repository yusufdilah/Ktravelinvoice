<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Vendor_model extends CI_Model
{
	
	private $_table= "vendor";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'nm_vendor',
			'label' => 'nm_vendor',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('pic p','p.pic_id = '.$this->_table.'.pic','left');
		$this->db->order_by($this->_table.'.created_date','DESC');
		$data = $this->db->get();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["vendor_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->vendor_id = uniqid();
		$this->nm_vendor = $post["nm_vendor"];
		$this->alamat_vendor = $post["alamat_vendor"];
		$this->no_telepon = $post["no_telepon"];
		$mark_up_persen = $post["mark_up"]/100;
		// echo $mark_up_persen;die();
		$this->mark_up = $mark_up_persen;
		$this->pic = $post["pic"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
        $mark_up_persen = $this->input->post('mark_up')/100;
		$data = array(
			"nm_vendor" => $this->input->post('nm_vendor'),
			"alamat_vendor" => $this->input->post('alamat_vendor'),
            "no_telepon" => $this->input->post('no_telepon'),
            "mark_up" => $mark_up_persen,
            "pic" => $this->input->post('pic'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('vendor_id', $id);
	    $this->db->update('vendor', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('vendor_id', $id);
    	$this->db->delete('vendor'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('vendor', $data);
	}
}
?>
