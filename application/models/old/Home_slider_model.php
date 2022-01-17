<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home_slider_model extends CI_Model
{
	
	private $_table= "home_slider";

	// public $id;	
	public $judul;
	public $isi;
	public $img;
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
	public function getALLexpired(){
		$a = mt_rand(1234567890,1234567989); 
		
		$curent_date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where('expired >',  $curent_date);
		$data = $this->db->get();
		return $data->result();
	}

	public function Load_expired($judul,$expired) {
		$curent_date = date('Y-m-d');
		$run = $this->db->query("SELECT 
									*
								FROM 
									home_slider
								WHERE
									judul='".$judul."'
									and 
									expired > '".$expired."'
								");
		// print_r($this->db->last_query());die();
		return $run;
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["home_slider_id" => $id])->row();
	}

	public function save($data_add){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');	
		
		$this->db->insert($this->_table, $data_add);
	}



	public function update($id,$data_edit){
		date_default_timezone_set("Asia/Jakarta");
		$curent_date = date('Y-m-d H:i:s');
		$session_nasabah = $this->session->userdata('token_nasabah');
		$post = $this->input->post();
		$this->home_slider_id = $post["home_slider_id"];
		$item = $this->Home_slider_model->getById($id);
		$item_img = $item->img;
		
		$this->db->where('home_slider_id', $id);
	    $this->db->update('home_slider', $data_edit); // Untuk mengeksekusi perintah update data
	}
	
	public function upload($data_img){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');	
		
		$this->db->insert($this->_table, $data_img);
		// print_r($this->db->last_query());die();
	}

	private function _uploadImage()
	{
		$home_slider = 'home_slider_';
		$a = mt_rand(1234567,1234699);
		$this->config->load('upload_setting', TRUE);
		
		$config = $this->config->item('upload_setting');
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('dmy_his');
		$config['file_name'] 			= $home_slider.$a;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('img')) {
			 $imageName = $this->upload->data('file_name');
            $data_img=[
                'img' => $imageName,
            ];
            // $this->Home_slider_model->upload($data_img);
            $configer['image_libary'] = 'gd2';
            $configer['source_image'] = './file.upload.1/'.$imageName;

            $configer['create_thumb'] = false;
            $configer['mantain_ratio'] = false;
            $configer['quality'] = '100%';
            $configer['width'] = 1280;
            // var_dump($configer['width']);die();
            $configer['height'] = 720;
            $configer['new_image'] = './file.upload.1/'.$imageName;
            // var_dump($configer['new_image']);die();
            $this->load->library('image_lib',$configer);
            // // $this->image_lib->clear();    
            $this->image_lib->resize();


			return $this->upload->data("file_name");
		}
		
	}	

	public function delete($id){
		$this->_deleteImage($id);
		$this->db->where('home_slider_id', $id);
    	$this->db->delete('home_slider'); // Untuk mengeksekusi perintah delete data
	}

	public function _deleteImage($id)
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

}
?>
