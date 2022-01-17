<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Kategori_model extends CI_Model
{
	
	private $_table= "parameter_category";
	
	
	public function rules()
	{
		return [
			
			['field' => 'desc',
			'label' => 'desc',
			'rules' => 'required']
		];
	}

	public function rulesDetail()
	{
		return [
			
			['field' => 'parameter',
			'label' => 'parameter',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('created_date',DESC);
		$data = $this->db->get();
		return $data->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["parameter_category_id" => $id])->row();
	}
	public function getByIdParameter($id){
		return $this->db->get_where('parameter', ["parameter_id" => $id])->row();
	}

	public function save_detail(){
		$post = $this->input->post();
		$created_by = $this->session->userdata('token_nasabah');

		$this->parameter_category_id = $post["parameter_category_id"];
		$this->parameter = $post["parameter"];
		if ($post["value_int"]=='') {
			$this->value_int = null;
		}else{
			$this->value_int = $post["value_int"];
		}
		$this->value_text = $post["value_text"];
		if ($post["seq"]=='') {
			$this->seq = null;
		}else{
			$this->seq = $post["seq"];
		}
		$this->created_by = $created_by;
		$this->db->insert('parameter', $this);
	}
	public function save(){
		$post = $this->input->post();
		$created_by = $this->session->userdata('token_nasabah');

		$this->parameter_category = $post["parameter_category"];
		$this->desc = $post['desc'];
		$this->created_by = $created_by;
		$this->db->insert($this->_table, $this);
	}

	
	public function detailKategori($id){

		$this->db->select('pc.desc as kategori,
		parameter,value_text,value_int,p.*');
        $this->db->from('parameter p');
        $this->db->join('parameter_category pc', 'p.parameter_category_id = pc.parameter_category_id');
        $this->db->where('pc.parameter_category_id', $id);
        $this->db->order_by('p.created_date',DESC);
        $query = $this->db->get();
        $total_rows = $query->num_rows();
  		
        return $query->result();
	}


	public function updateDetail($id){
		$post = $this->input->post();
		$updated_by = $this->session->userdata('token_nasabah');
        date_default_timezone_set("Asia/Jakarta");	
        $updated_date = date('Y-m-d H:i:s');
		

		if ($post["value_int"]=='') {
			$data = array(
				"parameter_category_id" => $this->input->post('parameter_category_id'),
				"parameter" => $this->input->post('parameter'),
				"value_int" => null,
	            "value_text"=> $this->input->post('value_text'),
	            "seq"		=> null,
	            "updated_by"=> $updated_by,
	            "updated_date"=> $updated_date
			);
		}else{
			$data = array(
				"parameter_category_id" => $this->input->post('parameter_category_id'),
				"parameter" => $this->input->post('parameter'),
				"value_int" => $this->input->post('value_int'),
	            "value_text"=> $this->input->post('value_text'),
	            "seq"		=> $this->input->post('seq'),
	            "updated_by"=> $updated_by,
	            "updated_date"=> $updated_date
			);
		}

		$this->db->where('parameter_id', $id);
	    $this->db->update('parameter', $data); 
	    
	}

	public function update($id){
		$post = $this->input->post();
		$updated_by = $this->session->userdata('token_nasabah');
		date_default_timezone_set("Asia/Jakarta");	
        $updated_date = date('Y-m-d H:i:s');
		
			$data = array(
				"parameter_category" => $this->input->post('parameter_category'),
				"desc" 				 => $this->input->post('desc'),
	            "updated_by"=> $updated_by,
	            "updated_date"=> $updated_date
			);

		$this->db->where('parameter_category_id', $id);
	    $this->db->update('parameter_category', $data); 
	}

	
	public function delete_detail($id){
		$this->db->where('parameter_id', $id);
    		$this->db->delete('parameter'); 
	}
	public function delete($id){
		$this->db->where('parameter_category_id', $id);
    		$this->db->delete('parameter_category'); 
	}
}
?>
