<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Helpdesk_model extends CI_Model
{
	
	private $_table= "tiket_history";

	// public $id;	
	public $tiket_id;
	public $pic_id;
	public $jawaban;
	public $file_1;
	public $file_2;
	public $internal_note;


	public function rules()
	{
		return [
			['field' => 'jawaban',
			'label' => 'jawaban',
			'rules' => 'required']	
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

    
   public function jml_tiket_jwb_spv() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.parameter as tipe_tiket,
					p2.parameter as kategori_tiket,
					p3.parameter as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as tiket_status,
					history.status_approve as status_approve,
					history.tiket_history_id,
					history.pic_id ,
					t .*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join parameter p on
					t.tipe = p.parameter_id
				left join parameter p2 on
					t.kategori = p2.parameter_id
				left join parameter p3 on
					t.prioritas = p3.parameter_id
				left join anggota_data ad on
					t.nasabah_id = ad.nasabah_id
				left join tiket_status ts on
					ts.tiket_status_id = t.status
				
				left join (
					select b.tiket_history_id, a.`tiket_id`, a.`pic_id`, a.`jawaban`, a.`internal_note`, a.`file_1`, a.`file_2`, a.`created_date`, a.`status_approve` from tiket_history as a join (select max(tiket_history_id) as tiket_history_id, tiket_id FROM tiket_history group by tiket_id ORDER BY tiket_history_id DESC) as b ON b.tiket_history_id = a.tiket_history_id
				) as history on history.tiket_id = t.tiket_id
				where
					tiket_pic.nasabah_id = $session_nasabah
					and ts.status = 'Open'
					and (history.pic_id is null
					or history.pic_id = 0 )
				group by
					tiket_id
				order by
					tiket_status_id asc
				";

	    $data = $this->db->query($query);
	    // select * from tiket_history th group by tiket_id order by tiket_history_id desc
		//print_r($this->db->last_query());die();
		return $data->num_rows();
	}

public function getByUnapprove($getByUnapprove) {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.parameter as tipe_tiket,
					p2.parameter as kategori_tiket,
					p3.parameter as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as tiket_status,
					history.status_approve as status_approve,
					history.tiket_history_id,
					history.pic_id ,
					t .*
				from
					$getByUnapprove
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join parameter p on
					t.tipe = p.parameter_id
				left join parameter p2 on
					t.kategori = p2.parameter_id
				left join parameter p3 on
					t.prioritas = p3.parameter_id
				left join anggota_data ad on
					t.nasabah_id = ad.nasabah_id
				left join tiket_status ts on
					ts.tiket_status_id = t.status
				
				left join (
					select b.tiket_history_id, a.`tiket_id`, a.`pic_id`, a.`jawaban`, a.`internal_note`, a.`file_1`, a.`file_2`, a.`created_date`, a.`status_approve` from tiket_history as a join (select max(tiket_history_id) as tiket_history_id, tiket_id FROM tiket_history group by tiket_id ORDER BY tiket_history_id DESC) as b ON b.tiket_history_id = a.tiket_history_id
				) as history on history.tiket_id = t.tiket_id
				where
					tiket_pic.nasabah_id = $session_nasabah
					and ts.status = 'Open'
					and (history.pic_id is null
					or history.pic_id = 0 )
				group by
					tiket_id
				
				order by created_date DESC	
				";

	    $data = $this->db->query($query);
	    //select * from tiket_history th group by tiket_id order by tiket_history_id desc
	    //print_r($this->db->last_query());die();
		return $data->result();
	}

	public function jml_tiket_open($getByUnapprove) {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.parameter as tipe_tiket,
					p2.parameter as kategori_tiket,
					p3.parameter as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as tiket_status,
					history.status_approve as status_approve,
					history.tiket_history_id,
					history.pic_id ,
					t .*
				from
					$getByUnapprove
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join parameter p on
					t.tipe = p.parameter_id
				left join parameter p2 on
					t.kategori = p2.parameter_id
				left join parameter p3 on
					t.prioritas = p3.parameter_id
				left join anggota_data ad on
					t.nasabah_id = ad.nasabah_id
				left join tiket_status ts on
					ts.tiket_status_id = t.status
				
				left join (
					select b.tiket_history_id, a.`tiket_id`, a.`pic_id`, a.`jawaban`, a.`internal_note`, a.`file_1`, a.`file_2`, a.`created_date`, a.`status_approve` from tiket_history as a join (select max(tiket_history_id) as tiket_history_id, tiket_id FROM tiket_history group by tiket_id ORDER BY tiket_history_id DESC) as b ON b.tiket_history_id = a.tiket_history_id
				) as history on history.tiket_id = t.tiket_id
				where
					tiket_pic.nasabah_id = $session_nasabah
					and ts.status = 'Open'
					and (history.pic_id is null
					or history.pic_id = 0 )
				group by
					tiket_id
				order by
					tiket_status_id asc
				";

	    $data = $this->db->query($query);
	    //select * from tiket_history th group by tiket_id order by tiket_history_id desc
		// print_r($this->db->last_query());die();
		return $data->num_rows();
	}
	

	public function getByUnapproveSpv()
		{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as status_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id
				left join ( SELECT
                            b.tes,
                            a.`tiket_id`,
                            a.`pic_id`,
                            a.`jawaban`,
                            a.`internal_note`,
                            a.`file_1`,
                            a.`file_2`,
                            a.`created_date`,
                            a.`status_approve`
                        FROM
                            tiket_history AS a
                        JOIN(
                            SELECT
                                MAX(tiket_history_id) AS tes,
                                tiket_id
                            FROM
                                tiket_history
                            GROUP BY
                                tiket_id
                            ORDER BY
                                tiket_history_id
                            DESC
                        ) AS b
                    ON
                        b.tes = a.tiket_history_id
                    ) AS th on t.tiket_id = th.tiket_id 	
				left join tiket_status ts on ts.tiket_status_id = t.status 
				where
					tiket_pic.nasabah_id = '$session_nasabah'
					and t.status = 1
					and th.pic_id <> 0
				group by t.tiket_id 
				order by created_date DESC
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        return $data->result();
	}

	public function getByUnJwbSpv() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.parameter as tipe_tiket,
					p2.parameter as kategori_tiket,
					p3.parameter as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as tiket_status,
					history.status_approve as status_approve,
					history.tiket_history_id,
					history.pic_id ,
					t .*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join parameter p on
					t.tipe = p.parameter_id
				left join parameter p2 on
					t.kategori = p2.parameter_id
				left join parameter p3 on
					t.prioritas = p3.parameter_id
				left join anggota_data ad on
					t.nasabah_id = ad.nasabah_id
				left join tiket_status ts on
					ts.tiket_status_id = t.status
				
				left join (
					select b.tiket_history_id, a.`tiket_id`, a.`pic_id`, a.`jawaban`, a.`internal_note`, a.`file_1`, a.`file_2`, a.`created_date`, a.`status_approve` from tiket_history as a join (select max(tiket_history_id) as tiket_history_id, tiket_id FROM tiket_history group by tiket_id ORDER BY tiket_history_id DESC) as b ON b.tiket_history_id = a.tiket_history_id
				) as history on history.tiket_id = t.tiket_id
				where
					tiket_pic.nasabah_id = $session_nasabah
					and ts.status = 'Open'
					and (history.pic_id is null
					or history.pic_id = 0 )
				group by
					tiket_id
				order by
					created_date desc,
					tiket_status_id asc
				";

	    $data = $this->db->query($query);
	    //select * from tiket_history th group by tiket_id order by tiket_history_id desc
		// print_r($this->db->last_query());die();
		return $data->result();
	}

	public function getByAnswer()
		{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as status_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id
				left join tiket_history th on t.tiket_id = th.tiket_id 	
				left join tiket_status ts on ts.tiket_status_id = t.status 
				where
					tiket_pic.nasabah_id = '$session_nasabah'
				and t.status = 2
				group by t.tiket_id 
				order by
					created_date desc
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        return $data->result();
	}

	public function getByClosed()
		{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					ts.status as status_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id
				left join tiket_history th on t.tiket_id = th.tiket_id 	
				left join tiket_status ts on ts.tiket_status_id = t.status 
				where
					tiket_pic.nasabah_id = '$session_nasabah'
				and t.status  = 3
				group by t.tiket_id 
				order by created_date desc
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        return $data->result();
	}

	public function jml_tiket_spv()
		{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id	
				left join tiket_history th on t.tiket_id = th.tiket_id 	
				where
				(th.pic_id = 0 or th.pic_id is null) 
				and
					tiket_pic.nasabah_id = '$session_nasabah'
				and t.status = 1
				group by tiket_id 	
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        // return $data->result();
        return $data->num_rows();
	}

	public function jml_tiket_answered()
	{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id	
				left join tiket_history th on t.tiket_id = th.tiket_id 	
				where
					tiket_pic.nasabah_id = '$session_nasabah'
				and t.status = 2
				group by tiket_id 	
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        // return $data->result();
        return $data->num_rows();
	}

	public function jml_tiket_closed()
	{
		$session_nasabah = $this->session->userdata('token_nasabah');
		$query="select
					p.`parameter` as tipe_tiket,
					p2.`parameter` as kategori_tiket,
					p3.`parameter` as prioritas_tiket,
					ad.nama_lengkap as pembuat_tiket,
					t.*
				from
					tiket t
				left join tiket_divisi td on
					td.tiket_kategori_id = t.kategori
				left join tiket_pic on
					tiket_pic.divisi_id = td.divisi_id
				left join `parameter` p on
					t.tipe = p.parameter_id
				left join `parameter` p2 on
					t.kategori = p2.parameter_id
				left join `parameter` p3 on 
					t.prioritas = p3.parameter_id	
				left join anggota_data ad on t.nasabah_id = ad.nasabah_id	
				left join tiket_history th on t.tiket_id = th.tiket_id 	
				where
					tiket_pic.nasabah_id = '$session_nasabah'
				and t.status = 3
				group by tiket_id 	
				";

	    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        // print_r($this->db->last_query());die();
        // return $data->result();
        return $data->num_rows();
	}

	public function getById($id) {
		$this->db->select('*');
		$this->db->from('tiket');
		$this->db->join('anggota_data', 'tiket.nasabah_id = anggota_data.nasabah_id','left');
		// $this->db->join('tiket_history', 'tiket.tiket_id = tiket_history.tiket_id','left');
		$this->db->where('tiket.tiket_id', $id);
		$data = $this->db->get();
		// $data = $this->db->query($sql);
		// print_r($this->db->last_query());die();
		return $data->row();
	}

	public function getByHistory($id) {
		$session_nasabah = $this->session->userdata('token_nasabah');
		// $session_level = $this->session->userdata('level');
		// echo 'Yg jawab tiket :'.$session_nasabah.$session_level;die();
		$this->db->select('*');
		$this->db->from('tiket_history');
		$this->db->join('tiket_pic tp', 'tp.pic_id = tiket_history.pic_id','left');
		$this->db->join('anggota_data ad', 'ad.nasabah_id = tp.nasabah_id','left');
		$this->db->where('tiket_id', $id);
		$data = $this->db->get();

		// $data = $this->db->query($sql);
		// print_r($this->db->last_query());die();
		return $data->result();
	}
	
	public function getPenjawabTiketlevel() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		// $session_level = $this->session->userdata('level');
		// echo 'Yg jawab tiket :'.$session_nasabah.$session_level;die();
		$this->db->select('tp.level as level_penjawab,tp.nasabah_id as nasabah_id_penjawab,
						tp.supervisor as is_supervisor_penjawab,
						tp.*');
		$this->db->from('tiket_pic tp');
		
		$this->db->join('anggota_data ad', 'ad.nasabah_id = tp.nasabah_id','left');
		$this->db->where('tp.nasabah_id', $session_nasabah);
		$data = $this->db->get();

		// $data = $this->db->query($sql);
		// print_r($this->db->last_query());die();
		return $data->result();
	}



	public function getByHistorySpv($id) {
		$this->db->select('*');
		$this->db->from('tiket_history');
		$this->db->join('tiket_pic tp', 'tp.pic_id = tiket_history.pic_id','left');
		$this->db->join('anggota_data ad', 'ad.nasabah_id = tp.nasabah_id','left');
		$this->db->where('tiket_id', $id);
		$this->db->order_by('created_date','DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $data = $this->db->query($sql);
		// print_r($this->db->last_query());die();
		return $data->row();
	}

	public function getPic() {
		$session_nasabah = $this->session->userdata('token_nasabah');
		$this->db->select('*');
		$this->db->from('tiket_pic tp');
		$this->db->join('anggota_data ad', 'ad.nasabah_id = tp.nasabah_id','left');
		$this->db->where('tp.nasabah_id', $session_nasabah);

		$data = $this->db->get();
		// $data = $this->db->query($sql);
		
		// print_r($this->db->last_query());die();

		return $data->row();
	}

	public function spv_tiket_get()
	{
		$session_nasabah = $this->session->userdata('token_nasabah');
		// $query="select * from anggota_data where nasabah_id = '$session_nasabah' ";
	 //    $data = $this->db->query($query);
        // $total_rows = $query->num_rows();
  		// echo $total_rows.'test';die();
  // 		var_dump($data);
		// echo '</pre>';
		// die();
        $this->db->select('tp.level as level');
		$this->db->from('tiket_pic tp');
		$this->db->join('anggota_data ad','tp.nasabah_id = ad.nasabah_id ','left');
		$this->db->where('tp.nasabah_id', $session_nasabah);
		// $this->db->like('level', 'supervisor');
		$data = $this->db->get();

		// print_r($this->db->last_query());die();
		// return $data->num_rows();
        // return $data->row();
	        if($data->num_rows() > 0) 
	        {
		        return $data->row();
	        }
		    else{
		        return false;
		    }
		// return $data->result();
		// return ($data->num_rows() > 0) ? $data->result_array() : false;
	}


	public function FunctionName($value='')
	{
		$query="from_id, (SELECT COUNT(id) FROM user_messages WHERE from_id=1223 AND status=1) AS sent_unread,
            (SELECT COUNT(id) FROM user_messages WHERE from_id=1223 AND status=2) AS sent_read";
	      $query_run=$this->db->select($query);
	      $query_run->where('from_id', $member_id);
	      $query_run->group_by('from_id');

	      $result = $query_run->get('user_messages');
	      //echo $this->db->last_query();
	       return $result->row();
	}

	

	public function save(){
		$post = $this->input->post();
		// $this->info_terbaru_id = uniqid();
		// $item_level = "";
		
		$this->jawaban = $post["jawaban"];
		$this->tiket_id = $post["tiket_id"];
		$this->pic_id = $post["pic_id"];
		$this->internal_note = $post["internal_note"];
		$this->status_approve = 1;
		
		$this->file_1 = $this->_uploadFile1();
		$this->file_2 = $this->_uploadFile2();
		
		$this->db->insert($this->_table, $this);
		// print_r($this->db->last_query());die();
		$this->db->set('updated_date', $curent_date);
		$this->db->where('tiket_id', $post["tiket_id"]);
		$this->db->update('tiket');

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
	}

	public function save_spv(){
		$post = $this->input->post();
		// $this->info_terbaru_id = uniqid();
		
		$this->jawaban = $post["jawaban"];
		$this->tiket_id = $post["tiket_id"];
		$this->pic_id = $post["pic_id"];
		$this->internal_note = $post["internal_note"];
		$this->status_approve 	= 1;
		
		if(!empty($_FILES['file_1']['name']))
		{
			// echo "ini ada file".die();
			$this->file_1 = $this->_uploadFile1();
			// echo "ini tidak ada file".die();
			// $this->file_1 = $post["file_1_input"];
		}else{
			// echo "ini tidak ada file".die();
			$this->file_1 = $post["file_1_input"];
		}

		if(!empty($_FILES['file_2']['name']))
		{
			// echo "ini ada file".die();
			$this->file_2 = $this->_uploadFile2();
			// echo "ini tidak ada file".die();
			// $this->file_1 = $post["file_1_input"];
		}else{
			// echo "ini tidak ada file".die();
			$this->file_2 = $post["file_2_input"];
		}
		$file_test = $post["file_1_input"];
		// echo $file_test.'test';die();
		// $this->file_1 = $this->_uploadFile1();
		// $this->file_2 = $this->_uploadFile2();
		// print_r($this->db->last_query());die();
		$this->db->insert($this->_table, $this);
		// print_r($this->db->last_query());die();
		$this->db->set('status', 2);
		$this->db->set('updated_date', $curent_date);
		$this->db->where('tiket_id', $post["tiket_id"]);
		$this->db->update('tiket');

		// print_r($this->db->last_query());die();
		return $this->db->affected_rows();
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
		$this->db->where('registrasi_id', $id);
    	$this->db->delete('registrasi'); // Untuk mengeksekusi perintah delete data
	}

	public function close_tiket($id){
		$curent_date = date('Y-m-d');
		$this->db->set('status', 3);
		$this->db->set('updated_date', $curent_date);
		$this->db->where('tiket_id', $id);
    	$this->db->update('tiket'); // 
	}



	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('registrasi', $data);
	}
}
?>
