<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Manage_slideshow_model extends CI_Model
{
	
	private $_table= "info_terbaru_img";

	public $info_terbaru_img_id;
	public $info_terbaru_id;
	public $img;
	public $status;

	public function rules()
	{
		return [
			// ['field' => 'img',
			// 'label' => 'img',
			// 'rules' => 'required'],

			['field' => 'status',
			'label' => 'status',
			'rules' => 'required']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["info_terbaru_img_id" => $id])->row();
	}
	
	public function save($data_add){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');	
		$this->info_terbaru_id = $post["info_terbaru_id"];
		$this->img = $this->_uploadImage();
		$this->status = $post["status"];
		$this->created_by = $session_nasabah;	
		$this->db->insert($this->_table, $data_add);
	}

	public function update($id,$data_edit){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");
		
		
		$this->db->where('info_terbaru_img_id', $id);
	    $this->db->update('info_terbaru_img', $data_edit); // Untuk mengeksekusi perintah update data
	}

	private function _uploadImage()
	{
		$info_tb = 'info_tb_dtl';
		$a = mt_rand(1234567,1234699);
		$this->config->load('upload_setting', TRUE);
		
		$config = $this->config->item('upload_setting');
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('dmyhi');
		$config['file_name'] = $info_tb.$a ;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('img')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
	}

	public function delete($id){
		$this->_deleteImage($id);
		$this->db->where('info_terbaru_img_id', $id);
	    $this->db->delete('info_terbaru_img'); // Untuk mengeksekusi perintah delete data
	}
	public function delete_detail($id){
		$this->_deleteImage($id);
		$this->db->where('info_terbaru_id', $id);
	    $this->db->delete('info_terbaru_img'); // Untuk mengeksekusi perintah delete data
	}

	private function _deleteImage($id)
	{
		
		$this->config->load('upload_setting', TRUE);
		$config = $this->config->item('upload_setting');
		$path = $this->config->item('upload_path', 'upload_setting');
		$product = $this->getById($id);
		// echo '<pre>';
		// 						var_dump($path);
		// 						echo '</pre>';
		// 						die();
		if ($product->img != '') {
			$filename = explode(".", $product->img)[0];
			// echo $filename.' '.'test';die();
			return array_map('unlink', glob(FCPATH."$path/$filename.*"));
		}
	}

}


?>