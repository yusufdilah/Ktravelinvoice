<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Pic_model extends CI_Model
{
	
	private $_table= "pic";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	// public $seq;

	public function rules()
	{
		return [
			['field' => 'nip_pic',
			'label' => 'nip_customer',
			'rules' => 'required'],

			['field' => 'pic',
			'label' => 'pic',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('divisi d','d.divisi_id = '.$this->_table.'.divisi','left');
		$this->db->join('customer c','c.customer_id = '.$this->_table.'.customer','left');
		$this->db->order_by($this->_table.'.created_date',SORT_DESC);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getdivisi($searchTerm = "")
    {        
        $this->db->select('divisi_id, nama_divisi');
        $this->db->where("nama_divisi like '%" . $searchTerm . "%' ");
        $this->db->order_by('divisi_id', 'asc');
        $fetched_records = $this->db->get('divisi');
        print_r($this->db->last_query());die();
        $datadivisi = $fetched_records->result_array();
 		// print_r($this->db->last_query());die();
        $data = array();
        foreach ($datadivisi as $divisi) {
            $data[] = array("id" => $divisi['divisi_id'], "text" => $divisi['nama_divisi']);
        }
        return $data;
    }

	public function getById($id){
		return $this->db->get_where($this->_table, ["pic_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		// echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();
		// $this->faq_id = uniqid();
		$this->nip_pic = $post["nip_pic"];
		$this->customer = $post["customer"];
		$this->divisi = $post["divisi"];
		$this->pic = $post["pic"];
		$this->status = $post["status"];
		$this->no_hp = $post["no_hp"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"nip_pic" => $this->input->post('nip_pic'),
			"customer" => $this->input->post('customer'),
            "divisi" => $this->input->post('divisi'),
            "pic" => $this->input->post('pic'),
            "status" => $this->input->post('status'),
            "no_hp" => $this->input->post('no_hp'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('pic_id', $id);
	    $this->db->update('pic', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('pic_id', $id);
    	$this->db->delete('pic'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}

	// chained dropdown
	public function chained_dropdown($divisi_id){
		$this->db->select('pic.*, divisi.perusahaan_id, divisi.nm_group_head, divisi.divisi_id');
		$this->db->from($this->_table);
		$this->db->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi');
		$this->db->where($this->_table.'.divisi='.$divisi_id);
		$data = $this->db->get();
		return $data->result();
	}
}
?>
