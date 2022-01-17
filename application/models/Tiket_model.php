<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Tiket_model extends CI_Model
{
	
	private $_table= "tiket";

	// public $id;	
	// public $judul;
	// public $isi;
	// public $status;
	public $hpp;

	public function rules()
	{
		
		return [
			['field' => 'tgl_berangkat',
			'label' => 'tgl_berangkat',
			'rules' => 'required'],

			['field' => 'hpp',
			'label' => 'hpp',
			'rules' => 'required'],

			['field' => 'service_fee',
			'label' => 'service_fee',
			'rules' => 'required'],

			['field' => 'biaya_lain',
			'label' => 'biaya_lain',
			'rules' => 'required'],

			['field' => 'harga_jual',
			'label' => 'harga_jual',
			'rules' => 'required'],

			['field' => 'biaya_lain',
			'label' => 'biaya_lain',
			'rules' => 'required'],

			['field' => 'bookers',
			'label' => 'bookers',
			'rules' => 'required'],

			['field' => 'akomodasi',
			'label' => 'akomodasi',
			'rules' => 'required']
		];
	}

	public function getALL(){
		$this->db->select('maskapai.akomodasi as nm_akomodasi,divisi.nama_divisi,detail_maskapai.nama_maskapai,route.keterangan,vendor.nm_vendor,customer.nama_customer');
		$this->db->select('tiket.* ');
		$this->db->from($this->_table);
		$this->db->join('detail_maskapai', 'detail_maskapai.maskapai_id = '.$this->_table.'.maskapai','LEFT');
		$this->db->join('divisi', 'divisi.divisi_id = '.$this->_table.'.divisi','LEFT');
		$this->db->join('route', 'route.route_id = '.$this->_table.'.route','LEFT');
		$this->db->join('vendor', 'vendor.vendor_id = '.$this->_table.'.vendor','LEFT');
		$this->db->join('customer', 'customer.customer_id = '.$this->_table.'.customer','LEFT');
		$this->db->join('maskapai', 'maskapai.akomodasi_id = '.$this->_table.'.akomodasi','LEFT');	
		$this->db->order_by(''.$this->_table.'.created_date','DESC');
		$this->db->where('is_close <>', 1);
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function list_tiket_closed(){
		$this->db->select('maskapai.akomodasi as nm_akomodasi,divisi.nama_divisi,detail_maskapai.nama_maskapai,route.keterangan,vendor.nm_vendor,customer.nama_customer');
		$this->db->select('tiket.* ');
		$this->db->from($this->_table);
		$this->db->join('detail_maskapai', 'detail_maskapai.maskapai_id = '.$this->_table.'.maskapai','LEFT');
		$this->db->join('divisi', 'divisi.divisi_id = '.$this->_table.'.divisi','LEFT');
		$this->db->join('route', 'route.route_id = '.$this->_table.'.route','LEFT');
		$this->db->join('vendor', 'vendor.vendor_id = '.$this->_table.'.vendor','LEFT');
		$this->db->join('customer', 'customer.customer_id = '.$this->_table.'.customer','LEFT');
		$this->db->join('maskapai', 'maskapai.akomodasi_id = '.$this->_table.'.akomodasi','LEFT');	
		$this->db->order_by(''.$this->_table.'.created_date','DESC');
		$this->db->where('is_close',1);
		$data = $this->db->get();
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function count_jml_close_tiket(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('created_date','DESC');
		$this->db->where('is_close',1);
		$data = $this->db->get();
				// print_r($this->db->last_query());die();
		return $data->num_rows();
	}

	function get_akomodasi($akomodasi_id){
		$query = $this->db->get_where('detail_maskapai', array('akomodasi_id' => $akomodasi_id));
		return $query;
	}

	// function get_akomodasi($akomodasi_id){
	// 	$this->db->select('detail_maskapai.nama_maskapai as maskapai,maskapai.akomodasi');
	// 	$this->db->select('maskapai.* ');
 //        $this->db->from('maskapai');
 //        $this->db->join('detail_maskapai', 'maskapai.akomodasi_id = detail_maskapai.akomodasi_id');
 //        $this->db->where('maskapai.akomodasi_id', $akomodasi_id);
 //        $this->db->order_by('maskapai.created_date','desc');
 //        $query = $this->db->get();
 //        $total_rows = $query->num_rows();
 //        // print_r($this->db->last_query());die();
 //        return $query->result();
	// }

	function get_vendor($vendor_id){
		$query = $this->db->get_where('vendor', array('vendor_id' => $vendor_id));
		return $query;
	}

	// public function getById($id){
	// 	return $this->db->get_where($this->_table, ["perusahaan_id" => $id])->row();
	// }

	public function getById($id){
		// return $this->db->get_where($this->_table, ["perusahaan_id" => $id])->row();
		$this->db->select($this->_table.'.*,customer.nama_customer, customer.nip_customer, divisi.nama_divisi')
		->from($this->_table)
		->join('customer', 'customer.customer_id='.$this->_table.'.customer')
		->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi')
		->where($this->_table.'.tiket_id', $id);
		$data = $this->db->get();
		return $data->row();
	}
	// public function save(){
	// 	$post = $this->input->post();
	// 	$session_nasabah = $this->session->userdata('token_nasabah');
	// 	// echo '<pre>';
	// 	// var_dump($post);
	// 	// echo '</pre>';
	// 	// die();
	// 	// $this->faq_id = uniqid();
	// 	$this->tgl_issued = $post["tgl_issued"];
	// 	$this->tgl_berangkat = $post["tgl_berangkat"];
	// 	$this->kode_booking = $post["kode_booking"];
	// 	$this->no_memo = $post["no_memo"];
	// 	$this->customer = $post["customer"];
	// 	$this->divisi = $post["divisi"];
	// 	$this->akomodasi = $post["akomodasi"];
	// 	$this->maskapai = $post["maskapai"];
	// 	$this->hotel = $post["hotel"];
	// 	$this->alamat_hotel = $post["alamat_hotel"];
	// 	$this->route = $post["route"];
	// 	$this->vendor = $post["vendor"];
	// 	$this->hpp = $post["hpp"];
	// 	$this->service_fee = $post["service_fee"];
	// 	$this->biaya_lain = $post["biaya_lain"];
	// 	$this->harga_jual = $post["harga_jual"];
	// 	$this->bookers = $post["bookers"];
	// 	$this->created_by = $session_nasabah;
	// 	// if(!empty($_FILES['file_1']['name']))
	// 	// {
	// 	// 	// echo "ini ada file".die();
	// 	// 	$this->file_1 = $this->_uploadFile1();
	// 	// 	// echo "ini tidak ada file".die();
	// 	// 	// $this->file_1 = $post["file_1_input"];
	// 	// }else{
	// 	// 	// echo "ini tidak ada file".die();
	// 	// 	$this->file_1 = $post["file_1_input"];
	// 	// }

	// 	// if(!empty($_FILES['file_2']['name']))
	// 	// {
	// 	// 	// echo "ini ada file".die();
	// 	// 	$this->file_2 = $this->_uploadFile2();
	// 	// 	// echo "ini tidak ada file".die();
	// 	// 	// $this->file_1 = $post["file_1_input"];
	// 	// }else{
	// 	// 	// echo "ini tidak ada file".die();
	// 	// 	$this->file_2 = $post["file_2_input"];
	// 	// }
	// 	$this->db->insert($this->_table, $this);
	// 	// print_r($this->db->last_query());die();
	// }

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
		$this->tiket_id = $post["tiket_id"];
		
		
		$this->db->where('tiket_id', $id);
	    $this->db->update('tiket', $data_edit); // Untuk mengeksekusi perintah update data
	}

	private function _uploadFile1()
	{
		$this->config->load('upload_setting', TRUE);
		
		$config = $this->config->item('upload_setting');

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_1')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
	}

	private function _uploadFile2()
	{
		$this->config->load('upload_setting', TRUE);

		$config = $this->config->item('upload_setting');

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_2')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
	}
	

	public function delete($id){
		$this->db->where('tiket_id', $id);
    	$this->db->delete('tiket'); // Untuk mengeksekusi perintah delete data
	}

	public function _deleteFileTiket($id)
	{
		
		$this->config->load('upload_setting', TRUE);
		$config = $this->config->item('upload_setting');
		$path = $this->config->item('upload_path', 'upload_setting');
		$item = $this->getById($id);
		
		if ($item->tiket_file != '') {
			$filename = explode(".", $item->tiket_file)[0];
			return array_map('unlink', glob(FCPATH."$path/$filename.*"));
		}
	}

	public function _deleteFileSPJ($id)
	{
		
		$this->config->load('upload_setting', TRUE);
		$config = $this->config->item('upload_setting');
		$path = $this->config->item('upload_path', 'upload_setting');
		$item = $this->getById($id);
		
		if ($item->spj_file != '') {
			$filename = explode(".", $item->spj_file)[0];
			return array_map('unlink', glob(FCPATH."$path/$filename.*"));
		}
	}

	public function close_tiket($id){
		$this->db->where('tiket_id', $id);
    	$this->db->update('tiket', ['is_close'=> 1]);
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('faq', $data);
	}

	// generate list tiket untuk add invoice
	public function generateListTiket($divisi_id, $from, $to){
		$this->db->select($this->_table.'.*, divisi.nama_divisi, 
		divisi.nm_group_head, maskapai.nama_maskapai, route.kd_route, vendor.nm_vendor, customer.nama_customer, customer.nip_customer');
		$this->db->from($this->_table);
		$this->db->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi');
		$this->db->join('maskapai', 'maskapai.akomodasi_id=tiket.akomodasi');
		$this->db->join('route', 'route.route_id=tiket.route');
		$this->db->join('vendor', 'vendor.vendor_id=tiket.vendor');
		$this->db->join('customer', 'customer.customer_id=tiket.customer');
		$this->db->where('tiket.tgl_issued>=',$from);
		$this->db->where('tiket.tgl_issued<=', $to);
		$this->db->where('tiket.divisi=', $divisi_id);
		$this->db->where('tiket.is_close=', 1);
		$data = $this->db->get();
		// print_r($this->db->last_query());die();		
		return $data->result();
	}

	// mengambil data tiker juga untk data yang sudah di input;
	public function invoiceListTiket($no_invoice, $divisi_id){
		$this->db->select($this->_table.'.*, divisi.nama_divisi, 
		divisi.nm_group_head, maskapai.nama_maskapai, route.kd_route, vendor.nm_vendor, customer.nama_customer, customer.nip_customer');
		$this->db->from($this->_table);
		$this->db->join('divisi', 'divisi.divisi_id='.$this->_table.'.divisi');
		$this->db->join('maskapai', 'maskapai.akomodasi_id=tiket.akomodasi');
		$this->db->join('route', 'route.route_id=tiket.route');
		$this->db->join('vendor', 'vendor.vendor_id=tiket.vendor');
		$this->db->join('customer', 'customer.customer_id=tiket.customer');
		$this->db->where($this->_table.'.no_invoice', $no_invoice);
		$this->db->where($this->_table.'.divisi', $divisi_id);
		
		$data = $this->db->get();
		// print_r($this->db->last_query());die();	
		return $data->result();
	}

	// hapus relasi dengan invoice yang dihapus
	public function removeTiketFromInvoice($id){
		$this->db->where('tiket_id', $id);
    	$this->db->update($this->_table, ['no_invoice'=>null]);
	}
}
?>
