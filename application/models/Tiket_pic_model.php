<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_pic_model extends CI_Model
{
	private $_table= "tiket_pic";
	public $divisi_id;
	public $nasabah_id;
	public $level;
	// public $tiket_kategori_id;
	
	

	public function rules()
	{
		return [
			
			['field' => 'divisi_id',
			'label' => 'divisi_id',
			'rules' => 'required'],

			['field' => 'nasabah_id',
			'label' => 'nasabah_id',
			'rules' => 'required'],

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

	function Load_pic_terdaftar($nasabah_id,$divisi_id) {
		$run = $this->db->query("SELECT 
									*
								FROM 
									tiket_pic
								WHERE
									nasabah_id='".$nasabah_id."'
									and 
									divisi_id='".$divisi_id."'
								");
		// print_r($this->db->last_query());die();
		return $run;
	}

	public function getAlljoin() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('ad.nama_lengkap as nm_pic,
			p.parameter as divisi, tp.*');
		$this->db->from('tiket_pic tp');
		
		$this->db->join('anggota_data ad','ad.nasabah_id = tp.nasabah_id','left');
		$this->db->join('parameter p','p.parameter_id = tp.divisi_id','left');
		$this->db->join('parameter_category pc','pc.parameter_category_id = p.parameter_category_id','left');
		
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
		return $this->db->get_where($this->_table, ["pic_id" => $id])->row();
	}

	public function save(){

		$post = $this->input->post();
		//    	echo '<pre>';
		// var_dump($post);
		// echo '</pre>';
		// die();		

		$this->divisi_id 		= $post["divisi_id"];
		$this->nasabah_id 		= $post["nasabah_id"];
		$this->level 			= $post["level"];
		if ($post["level"] == 'supervisor') {
			# code...
			$this->supervisor 	= 1;
			$this->staff 		= 0;
		}elseif ($post["level"] == 'staff') {
			# code...
			$this->supervisor 	= 0;
			$this->staff 		= 1;
		}
		$this->db->insert($this->_table, $this);
		// print_r($this->db->last_query());die();
	}

	public function update($id){
		// echo "string";die();
		$post = $this->input->post();
		if ($post["level"] == 'supervisor') {
			# code...
			$data = array(
					"divisi_id" => $this->input->post('divisi_id'),
					"nasabah_id" => $this->input->post('nasabah_id'),
					"level" => $this->input->post('level'),
					"supervisor" => 1,
					"staff" => 0
	         ); 
		}elseif ($post["level"] == 'staff') {
			# code...
			$data = array(
					"divisi_id" => $this->input->post('divisi_id'),
					"nasabah_id" => $this->input->post('nasabah_id'),
					"level" => $this->input->post('level'),
					"supervisor" => 0,
					"staff" => 1
	         ); 
		}
		 		
		$this->db->where('pic_id', $id);
	    $this->db->update('tiket_pic', $data); // Untuk mengeksekusi perintah update data
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
		print_r($this->db->last_query());die();
		return $run;
	}

	public function delete($id){
		$this->db->where('pic_id', $id);
    	$this->db->delete('tiket_pic'); // Untuk mengeksekusi perintah delete data
	}
}

/* End of file .php */