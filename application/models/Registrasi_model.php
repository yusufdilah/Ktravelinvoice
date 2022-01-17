<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Registrasi_model extends CI_Model
{
	
	private $_table= "registrasi";

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

	public function getById($id){
		return $this->db->get_where($this->_table, ["registrasi_id" => $id])->row();
	}	

	// public function getByUnapprove(){
	// 	return $this->db->get_where($this->_table, ["status" => 2])->row();
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

	// public function approve($id){
	// 	echo "string";die();
	// 	$this->db->set('status', '2', FALSE);
	// 	$this->db->where('registrasi_id', $id);
	//     $this->db->update('registrasi', $data); // Untuk mengeksekusi perintah update data
	// }	

	// public function approve($dataApprove) {
	// 	// echo "string";die();
	// 	$table = "registrasi";
	// 	$registrasi_id = $dataApprove['registrasi_id'];
	// 	$nama = $dataApprove['nama'];
	// 	$email = $dataApprove['email'];
	// 	$nip = $dataApprove['nip'];
	// 	$nasabah_id = $dataApprove['nasabah_id'];
	// 	$foto = $dataApprove['foto'];
	// 	$perusahaan_sebelum = $dataApprove['perusahaan_sebelum'];
	// 	$data = array(
	
	// 	    'registrasi_id' => $registrasi_id,
	// 	    'nama' => $nama,
	// 	    'email' => $email,
	// 	    'nip' => $nip,
	// 	    'nasabah_id' => $nasabah_id,
	// 	    'foto' => $foto,
	// 	    'perusahaan_sebelum' => $perusahaan_sebelum,
	// 	);
	// 	echo '<pre>';
	// 				var_dump($data);
	// 				echo '</pre>';
	// 				die();
	// 	$this->db->where('registrasi_id', $registrasi_id);
	// 	$this->db->update($table, $data);
	// 	// print_r($this->db->last_query());die();
	// 	return $this->db->affected_rows();
	// }		


	public function approve($dataApprove) {
		// echo "string";die();
		$table = "registrasi";
		$registrasi_id = $dataApprove['registrasi_id'];
		$nama = $dataApprove['nama'];
		$email = $dataApprove['email'];
		$nip = $dataApprove['nip'];
		$nasabah_id = $dataApprove['nasabah_id'];
		$foto = $dataApprove['foto'];
		$perusahaan_sebelum = $dataApprove['perusahaan_sebelum'];
		$data = array(
		    'nama_lengkap' => $nama,
		    'nip' => $nip,
		    'nasabah_id' => $nasabah_id,
		    'foto' => $foto,
		    'perusahaan_sebelum' => $perusahaan_sebelum,
		);
		$data_wajib = array(
		    
		    'nasabah_id' => $nasabah_id,
		);
		// echo '<pre>';
		// 			var_dump($data);
		// 			echo '</pre>';
		// 			die();
		$this->db->insert('anggota_data',$data);
		$this->db->insert('data_wajib',$data_wajib);
		// print_r($this->db->last_query());die();
		$this->db->set('status', 2, FALSE);
		$this->db->where('registrasi_id', $registrasi_id);
		$this->db->update('registrasi');

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

	public function reject($dataReject) {
		// echo "string";die();
		$table = "registrasi";
		$registrasi_id = $dataReject['registrasi_id'];
		$alasan_ditolak = $dataReject['alasan_ditolak'];
		
		$this->db->set('status', 3);
		$this->db->set('alasan_ditolak', $alasan_ditolak);
		$this->db->where('registrasi_id', $registrasi_id);
		$this->db->update($table);

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
	}

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
