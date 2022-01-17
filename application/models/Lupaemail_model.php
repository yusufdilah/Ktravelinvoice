<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Lupaemail_model extends CI_Model
{
	
	private $_table= "lupa_email";

	// public $id;	
	public $nama;
	public $email;
	public $nip;
	public $simpanan_pokok;
	public $simpanan_wajib;

	public function rules()
	{
		return [

		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	// public function getById($id){
	// 	return $this->db->get_where($this->_table, ["lupa_email_id" => $id])->row();
	// }	

	public function getById($id) {
		$this->db->select('ad.nasabah_id as nasabah_id_anggota ,
						nama_lengkap ,
						password ,
						ad.ktp as ktp_anggota ,
						alamat_domisili ,
						perusahaan,
						unit_kerja ,
						jabatan ,
						hp,
					lupa_email.*');
		$this->db->from('lupa_email');
		$this->db->join('anggota_data ad', 'ad.nip = lupa_email.nip','left');
		// $this->db->join('tiket_history', 'tiket.tiket_id = tiket_history.tiket_id','left');
		$this->db->where('lupa_email_id', $id);
		
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_harga_bbm WHERE ID_HARGA_BBM = '{$id}'";

		// $data = $this->db->query($sql);
		// print_r($this->db->last_query());die();
		return $data->row();
	}	
	
	// public function getByUnapprove(){
	// 	return $this->db->get_where($this->_table, ["status" => 1])->row();
	// }

	public function getByUnapprove($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status',1);
		$this->db->order_by('created_date','DESC');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getByReject($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status',3);
		$this->db->order_by('created_date','DESC');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function countReject($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status',3);
		$this->db->order_by('created_date','DESC');
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->num_rows();
	}

	public function save(){
		$post = $this->input->post();
		// $this->registrasi_id = uniqid();
		$this->img = $this->_uploadImage();
		$this->judul = $post["judul"];
		$this->isi = $post["isi"];
		$this->you_tube = $post["you_tube"];
		$this->db->insert($this->_table, $this);
	}
// 

	

	public function approve($dataApprove) {
		// echo "string";die();
		$table = "lupa_email";
		$lupa_email_id = $dataApprove['lupa_email_id'];
		
		$this->db->set('status', 2, FALSE);
		$this->db->where('lupa_email_id', $lupa_email_id);
		$this->db->update('lupa_email');

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
	}

	public function reject($dataApprove) {
		// echo "string";die();
		$table = "lupa_email";
		$lupa_email_id = $dataApprove['lupa_email_id'];
		
		$this->db->set('status', 3);
		$this->db->where('lupa_email_id', $lupa_email_id);
		$this->db->update('lupa_email');

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
	}

	public function cek_anggota($dataApprove) {
		$table_anggota  = "anggota_data";
		$nasabah_id		= $dataApprove['nasabah_id'];
		$this->db->select('*');
		$this->db->from($table_anggota);
		$this->db->where('nasabah_id',$nasabah_id);
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}	

	// public function approve($dataApprove) {
	// 	// echo "string";die();
	// 	$table = "registrasi";
	// 	$registrasi_id = $dataApprove['registrasi_id'];
	// 	$nama = $dataApprove['nama'];
	// 	$email = $dataApprove['email'];
	// 	$nip = $dataApprove['nip'];
	// 	$data = array(
	
	// 	    'status' => 2,

	// 	);
	// 	$this->db->where('registrasi_id', $registrasi_id);
	// 	$this->db->update($table, $data);
	// 	// print_r($this->db->last_query());die();
	// 	return $this->db->affected_rows();
	// }	

	
	// public function approve($id){
	// 	 $this->session->set_flashdata('success', 'Itu akan jadi proses approve');
	// }

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('registrasi_id', $id);
    $this->db->delete('registrasi'); // Untuk mengeksekusi perintah delete data
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('registrasi', $data);
	}
}
?>
