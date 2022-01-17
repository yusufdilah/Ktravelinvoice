<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Info_terbaru_model extends CI_Model
{
	
	private $_table= "info_terbaru";

	// public $id;
	public $img_cuplik;
	public $judul;
	public $isi;
	public $cuplikan;
	public $you_tube;

	public function rules()
	{
		return [
			['field' => 'judul',
			'label' => 'judul',
			'rules' => 'required'],

			['field' => 'isi',
			'label' => 'isi',
			'rules' => 'required']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getALLJoin(){
		$this->db->select('info_terbaru.info_terbaru_id as id_info_terbaru');
		$this->db->select('info_terbaru_img_id');
		$this->db->select('info_terbaru.* ');
        $this->db->from($this->_table);
        $this->db->join('info_terbaru_img', 'info_terbaru_img.info_terbaru_id = info_terbaru.info_terbaru_id',LEFT);
        $this->db->group_by('info_terbaru.info_terbaru_id');
        $this->db->order_by('info_terbaru.created_date',desc);
        $query = $this->db->get();
        $total_rows = $query->num_rows();
  		// print_r($this->db->last_query());die();
        return $query->result();
	}
	public function detail_info_terbaru($id){

		$this->db->select('info_terbaru_img.status as status_detail,judul');
		$this->db->select('info_terbaru_img.* ');
        $this->db->from('info_terbaru_img');
        $this->db->join('info_terbaru', 'info_terbaru_img.info_terbaru_id = info_terbaru.info_terbaru_id');
        $this->db->where('info_terbaru.info_terbaru_id', $id);
        $this->db->order_by('info_terbaru_img.created_date',desc);
        $query = $this->db->get();
        $total_rows = $query->num_rows();
  		
        return $query->result();
	}
	public function detail($id){

		$this->db->select('*');
        $this->db->from('info_terbaru');
        $this->db->join('info_terbaru_img', 'info_terbaru_img.info_terbaru_id = info_terbaru.info_terbaru_id');
        $this->db->where('info_terbaru.info_terbaru_id', $id);
        $query = $this->db->get();
        $total_rows = $query->num_rows();
        return $query->result();
	}
	
	public function jml_detail($id)
	{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select * from info_terbaru
				left join info_terbaru_img 
				on 
				info_terbaru_img.info_terbaru_id = 	info_terbaru.info_terbaru_id
				where info_terbaru.info_terbaru_id = ".$id."
				";

	    $data = $this->db->query($query);
        // print_r($this->db->last_query());die();
        return $data->num_rows();
	}	

	public function getById($id){
		return $this->db->get_where($this->_table, ["info_terbaru_id" => $id])->row();
	}

	public function save($data_add){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
			
		$this->db->insert($this->_table, $data_add);
		// print_r($this->db->last_query());die();
	}
	
	public function update($id,$data_edit){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");
		$curent_date = date('Y-m-d');
		$this->info_terbaru_id = $post["info_terbaru_id"];
		$item = $this->Info_terbaru_model->getById($id);
		$item_img = $item->img_cuplik;
		
		$this->db->where('info_terbaru_id', $id);
	    $this->db->update('info_terbaru', $data_edit); // Untuk mengeksekusi perintah update data
	}


	private function _uploadImage()
	{
		$info_tb = 'info_tb_';
		$a = mt_rand(1234567890,1234567989);
		$this->config->load('upload_setting', TRUE);
		
		$config = $this->config->item('upload_setting');
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('dmyhi');
		$config['file_name'] = $info_tb.$a;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('img_cuplik')) {
			return $this->upload->data("file_name");
		}
		
	}

	public function delete($id){
		$this->_deleteImage($id);
		$this->db->where('info_terbaru_id', $id);
    	$this->db->delete('info_terbaru'); // Untuk mengeksekusi perintah delete data
	}

	public function _deleteImage($id)
	{
		
		$this->config->load('upload_setting', TRUE);
		$config = $this->config->item('upload_setting');
		$path = $this->config->item('upload_path', 'upload_setting');
		$product = $this->getById($id);
		
		if ($product->img_cuplik != '') {
			$filename = explode(".", $product->img_cuplik)[0];
			return array_map('unlink', glob(FCPATH."$path/$filename.*"));
		}
	}

	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('info_terbaru', $data);
	}
}
?>
