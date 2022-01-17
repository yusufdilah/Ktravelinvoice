<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Route_model extends CI_Model
{
	
	private $_table= "route";

	

	public function rules()
	{
		return [
			['field' => 'keterangan',
			'label' => 'keterangan',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		// $this->db->join('pic p','p.pic_id = '.$this->_table.'.pic','left');
		$this->db->order_by($this->_table.'.created_date', SORT_DESC);
		$data = $this->db->get();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["route_id" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->kd_route = $post["kd_route"];
		$this->keterangan = $post["keterangan"];
		$this->created_by = $session_nasabah;
		$this->db->insert($this->_table, $this);
	}


	public function update($id){
		$session_nasabah = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
		$data = array(
			"kd_route" => $this->input->post('kd_route'),
			"keterangan" => $this->input->post('keterangan'),
            "updated_by" => $session_nasabah,
            "updated_date" => $updated_date
         );   
		$this->db->where('route_id', $id);
	    $this->db->update('route', $data); // Untuk mengeksekusi perintah update data
	}

	

	public function delete($id){
		$this->db->where('route_id', $id);
    	$this->db->delete('route'); // Untuk mengeksekusi perintah delete data
	}
}
?>
