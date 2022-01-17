<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_divisi_model extends CI_Model
{
	private $_table= "tiket_divisi";
	public $divisi_id;
	public $tiket_kategori_id;
	
	

	public function rules()
	{
		return [
			
			['field' => 'divisi_id',
			'label' => 'divisi_id',
			'rules' => 'required']
		];
	}

	public function get($username){
		$this->db->where('username', $username);
		$result = $this->db->get('user')->row();
		return $result;
	}

	// public function insert(key, value, handle){
	// 	$this->db->where('username', $username);
	// 	$result = $this->db->get('user')->row();
	// 	return $result;

	// }

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	function Load_divisi_terdaftar($divisi_id,$kategori_id) {
		$run = $this->db->query("SELECT 
									*
								FROM 
									tiket_divisi
								WHERE
									divisi_id='".$divisi_id."'
									and 
									tiket_kategori_id='".$kategori_id."'
								");
		// print_r($this->db->last_query());die();
		return $run;
	}

	public function getAlljoin() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('p.parameter as divisi,
	p2.parameter as kategori, td.*');
		$this->db->from('tiket_divisi td');
		
		$this->db->join('parameter p','td.divisi_id = p.parameter_id','left');
		$this->db->join('parameter p2','td.tiket_kategori_id = p2.parameter_id','left');
		
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getDivisi() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('p.parameter as divisi,p.parameter_id as id_divisi,p.*');
		$this->db->from('parameter p');
		
		$this->db->join('parameter_category pc','p.parameter_category_id = pc.parameter_category_id','left');
		
		$this->db->where('pc.parameter_category','tiket_divisi');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getKategori() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('p.parameter as kategori,p.parameter_id as id_kategori,p.*');
		$this->db->from('parameter p');
		
		$this->db->join('parameter_category pc','p.parameter_category_id = pc.parameter_category_id','left');
		
		$this->db->where('pc.parameter_category','tiket_kategori');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function get_nasabah_id(){
		 $query = $this->db->get('anggota_data')->result();
		 return $query;
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["tiket_divisi_id" => $id])->row();
	}

	public function save(){

		$post = $this->input->post();
		
		$this->divisi_id 	= $post["divisi_id"];
		$this->tiket_kategori_id 	= $post["tiket_kategori_id"];
		$this->db->insert($this->_table, $this);
	}

	public function update($id){
		$data = array(
			"divisi_id" => $this->input->post('divisi_id'),
			"tiket_kategori_id" => $this->input->post('tiket_kategori_id')
         );   
		$this->db->where('tiket_divisi_id', $id);
	    $this->db->update('tiket_divisi', $data); // Untuk mengeksekusi perintah update data
	}
	public function user_get()
	{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select * from anggota_data where nasabah_id = '$session_nasabah' ";
	    $data = $this->db->query($query);
        
        return $data->result();
			
	}

	
	
	public function load_admin($nasabah_id)
	{
		$query="select * from user where nasabah_id = '$session_nasabah' ";
	    $data = $this->db->query($query);
        
        return $data->result();
			
	}
	
	function Load_tabel_user($nasabah_id) {
		$run = $this->db->query("SELECT 
									*
								FROM 
									user
								WHERE
									nasabah_id='".$nasabah_id."'
								");
		// print_r($this->db->last_query());die();
		return $run;
	}

	public function delete($id){
		$this->db->where('tiket_divisi_id', $id);
    	$this->db->delete('tiket_divisi'); // Untuk mengeksekusi perintah delete data
	}
}

/* End of file .php */