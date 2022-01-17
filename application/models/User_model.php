<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	private $_table= "user";
	public $nasabah_id;
	public $level;
	public $status;
	

	public function rules()
	{
		return [
			['field' => 'level',
			'label' => 'level',
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

	public function getAlljoin() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('ad.nama_lengkap as nm_user, u.*');
		$this->db->from('user u');
		
		$this->db->join('anggota_data ad','ad.nasabah_id = u.nasabah_id','left');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}
	
	public function get_nasabah_id(){
		 $query = $this->db->get('anggota_data')->result();
		 return $query;
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["user_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		
		$this->nasabah_id 	= $post["nasabah_id"];
		$this->level 		= $post["level"];
		$this->status = 1;
		$this->db->insert($this->_table, $this);
	}

	public function update($id){
		$data = array(
			"nasabah_id" => $this->input->post('nasabah_id'),
			"level" => $this->input->post('level'),
            "status" => $this->input->post('status'),
            
         );   
		$this->db->where('user_id', $id);
	    $this->db->update('user', $data); // Untuk mengeksekusi perintah update data
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
		$this->db->where('user_id', $id);
    	$this->db->delete('user'); // Untuk mengeksekusi perintah delete data
	}
}

/* End of file .php */