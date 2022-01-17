<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Underconstruction_mode_model extends CI_Model
{
	
	private $_table= "underconstruction_mode";

	// public $id;	
	public $construction;
	public $img;

	public function rules()
	{
		return [

			['field' => 'construction',
			'label' => 'construction',
			'rules' => 'required']
		];
	}

	// public function getALL(){
	// 	return $this->db->get($this->_table)->result();
	// }

	function get_for_batch_insert2()
{
    $query = $this->db->query("EXEC INSERT_TTUMBATCH");
    if ($query) {
        return $query->result();
    } else {
        return false;
    }
}

	public function getALL(){
		$this->db->select("*");
		$this->db->from("underconstruction_mode");
		$data = $this->db->get();

		// return $data->result();
		if ($data) {
        return $data->result();
	    } else {
	        return false;
	    }

	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["underconstruction_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		// $this->underconstruction_id = uniqid();
		$this->img = $this->_uploadImage();
		$this->construction = $post["construction"];
		$this->db->insert($this->_table, $this);
	}

	

	public function update($id){
		$item = $this->Underconstruction_mode_model->getById($id);
		$item_img = $item->img;

		if (!empty($_FILES['img']['name'])) {
			
			$data = array(
				"img" => $this->_deleteImage($id),		
				"img" => $this->_uploadImage(),
				"construction" => $this->input->post('construction')
			);
		}
		else {
			
			$data = array(
				"img" => $this->input->post('old_img'),
				"construction" => $this->input->post('construction')
			);

		}

		$this->db->where('underconstruction_id', $id);
	    $this->db->update('underconstruction_mode', $data); // Untuk mengeksekusi perintah update data
	}

	public function _uploadImage()
	{
		$und_co = 'und_co_';
		$a = mt_rand(1234567,1234699);	
		$this->config->load('upload_setting', TRUE);
		
		$config = $this->config->item('upload_setting');
		$config['file_name'] = $info_tb.$a;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('img')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
		// return "default.jpg";
	}


	// Fungsi untuk melakukan menghapus data 
	public function delete($id){
		$this->_deleteImage($id);
		$this->db->where('underconstruction_id', $id);
    	$this->db->delete('underconstruction_mode'); // Untuk mengeksekusi perintah delete data
	}


	private function _deleteImage($id)
	{
		
		$this->config->load('upload_setting', TRUE);
		$config = $this->config->item('upload_setting');
		$path = $this->config->item('upload_path', 'upload_setting');
		$product = $this->getById($id);
		
		if ($product->img != '') {
			$filename = explode(".", $product->img)[0];
			return array_map('unlink', glob(FCPATH."$path/$filename.*"));
		}
	}

	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('underconstruction_mode', $data);
	}
}
?>
