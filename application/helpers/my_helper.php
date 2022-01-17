<?php
	// Used everywhere
	// MSG
	function show_msg($content='', $type='success', $icon='fa-info-circle', $size='14px') {
		if ($content != '') {
			return  '<p class="box-msg">
				      <div class="info-box alert-' .$type .'">
					      <div class="info-box-icon">
					      	<i class="fa ' .$icon .'"></i>
					      </div>
					      <div class="info-box-content" style="font-size:' .$size .'">
				        	' .$content
				      	.'</div>
					  </div>
				    </p>';
		}
	}

	function randomKey($length) {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $max = strlen($characters) - 1;
        $string = '';

        for ($i = 0; $i < $length; $i++) {
          $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
	  }
	
	  /**
	   *  Create a random key, with a format limit.
	   */
	function ramdomKeyRegex($length, $pattern = "~(?=^.{8,}$)(?=.*\d)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$~") {
		do {
			$key = randomKey($length);
			$correct_format = (preg_match($pattern, $key) == 1);
		} while(!$correct_format);

		return $key;
	}

	function show_succ_msg($content='', $size='14px') {
		if ($content != '') {
			return   '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="text-align:center;font-size:' .$size .'">
				        	' .$content
				      	.'</div>
					  </div>
				    </p>';
		}
	}

	function show_err_msg($content='', $size='14px') {
		if ($content != '') {
			return   '<p class="box-msg">
				      <div class="info-box alert-danger">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="text-align:center;font-size:' .$size .'">
				        	' .$content
				      	.'</div>
					  </div>
				    </p>';
		}
	}

	function err_capca($content='', $size='14px') {
		if ($content != '') {
			return   '<div class="alert alert-danger alert-dismissible" style="margin-top: 5px; padding: 5px;text-align:center;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong>' .$content
				      	.'</strong></p>
            </div>';
		}
	}

	function sukses_daftar($content='', $size='14px') {
		if ($content != '') {
			return   '<div class="alert alert-success alert-dismissible" style="margin-top: 5px; padding: 5px; text-align:center;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong>' .$content
				      	.'</strong></p>
            </div>';
		}
	}

	function success_valid($content='', $size='14px') {
		if ($content != '') {
			return   '<div class="alert alert-success alert-dismissible" style="margin-top: 5px; padding: 5px;text-align:center;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong>' .$content
				      	.'</strong></p>
            </div>';
		}
	}

	// MODAL
	function show_my_modal($content='', $id='', $data='', $size='md') {
		$_ci = &get_instance();

		if ($content != '') {
			$view_content = $_ci->load->view($content, $data, TRUE);

			return '<div class="modal fade" id="' .$id .'" role="dialog">
					  <div class="modal-dialog modal-' .$size .'" role="document">
					    <div class="modal-content">
					        ' .$view_content .'
					    </div>
					  </div>
					</div>';
		}
	}

	function show_my_confirm($id='', $class='', $title='Konfirmasi', $yes = 'Ya', $no = 'Tidak') {
		$_ci = &get_instance();

		if ($id != '') {
			echo   '<div class="modal fade" id="' .$id .'" role="dialog">
					  <div class="modal-dialog modal-md" role="document">
					    <div class="modal-content">
					        <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
						      <h3 style="display:block; text-align:center;">' .$title .'</h3>
						      
						      <div class="col-md-6">
						        <button class="form-control btn btn-primary ' .$class .'"> <i class="glyphicon glyphicon-ok-sign"></i> ' .$yes .'</button>
						      </div>
						      <div class="col-md-6">
						        <button class="form-control btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ' .$no .'</button>
						      </div>
						    </div>
					    </div>
					  </div>
					</div>';
		}
	}

	function get_path_upload_dokumen_syarat_perusahaan($id_perusahaan, $file_name = NULL) {
		$path = "FILE_UPLOAD/{$id_perusahaan}/DOKUMEN_PERUSAHAAN/DOKUMEN_PERSYARATAN"; 
		
		if(!is_null($file_name)) {
			$path .= "/{$file_name}";
		}
		
		return $path;
	}

	function get_path_upload_permohonan($id_perusahaan, $id_permohonan, $file_name = NULL) {
		$path = "FILE_UPLOAD/{$id_perusahaan}/PERMOHONAN_{$id_permohonan}";

		if(!is_null($file_name)) {
			$path .= "/{$file_name}";
		}

		return $path;
	}

	function get_path_upload_permohonan_tambahan($id_perusahaan, $id_permohonan, $file_name = NULL) {
		$path = "FILE_UPLOAD/{$id_perusahaan}/PERMOHONAN_{$id_permohonan}/TAMBAHAN";

		if(!is_null($file_name)) {
			$path .= "/{$file_name}";
		}

		return $path;
	}

	function get_path_upload_akta_and_pengesahan($id_perusahaan, $file_name = NULL) {
		$path = "FILE_UPLOAD/{$id_perusahaan}/DOKUMEN_PERUSAHAAN/AKTA";

		if(!is_null($file_name)) {
			$path .= "/{$file_name}";
		}

		return $path;
	}

	function get_path_template_contoh($file_name = NULL) {
		$path = "FILE_UPLOAD/FILE_CONTOH";

		if(!is_null($file_name)) {
			$path .= "/{$file_name}";
		}

		return $path;
	}

	function get_enkriptedQS($id_permohonan, $url_type) {
		$_ci = &get_instance();
		$_ci->load->model("M_r_permohonan_izin");
		$_ci->load->model("M_izin_instansi");

		$JAVA_HOME = "/usr/java/jdk1.7.0_80/bin";

		$PATH = "/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin:/usr/java/jdk1.7.0_80/bin";
		
		$PATH = "PATH:$PATH";
				
		putenv("JAVA_HOME=$JAVA_HOME");
				
		putenv("PATH=$PATH");

		$cmd = shell_exec("java -version 2>&1");

		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$permohonan_izin = $_ci->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
		$id_form = $permohonan_izin->ID_FORM;
		$id_template = $permohonan_izin->ID_TEMPLATE;
		$id_perusahaan = $permohonan_izin->ID_PERUSAHAAN;
		$id_skema = $_ci->M_izin_instansi->select_by_id($permohonan_izin->ID_FORM)->ID_SKEMA;
		
		$enkriptor_jar = get_enkriptor_loc();
		$qs			= urlencode("idInstansi-15~idForm-{$id_form}~idTemplate-{$id_template}~idPermohonan-{$id_permohonan}~idPerusahaan-{$id_perusahaan}~idSkema-{$id_skema}");
		$command 	= "java -jar {$enkriptor_jar} ". $qs;
		// $command     = "java -jar {$enkriptor_jar} ". $qs . " 2>&1"; // Use this to print error

		exec($command, $output);

		if(empty($output)) {
			$output[0] = "session_creation_failed";
		}

		$enkriptedQS = $output[0];
		$enkriptedQS = "?sessID=".$enkriptedQS;

		$_ci->load->config('form_url_config');
		$base_url = $_ci->config->item($url_type);

		return $base_url.$enkriptedQS;
	}

	function full_clean($data, $escape = FALSE, $full_clean = TRUE) {

		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				$data[$key] = full_clean($val, $escape, $full_clean);
			}

			return $data;
		}

		if (is_object($data))
		{
			foreach ($data as $key => $val)
			{
				$data->$key = full_clean($val, $escape, $full_clean);
			}

			return $data;
		}

		$_ci = &get_instance();

		if($full_clean) {
			$data = htmlentities($data);
			$data = $_ci->security->xss_clean($data);
		}

		if($escape) {
			$data = $_ci->db->escape_str($data);
		}

		return $data;
	}

	function print_as_dropdown($data, $name = "", $selected = array(), $extra = "") {
		$data_list = preg_split('/\r\n|\r|\n/', $data);
		
		$dropdown_list = array();
		foreach($data_list as $item) {
			array_push($dropdown_list, $item);	
		}

		echo form_dropdown($name, $dropdown_list, $selected, $extra);
	}

	/**
	 * Mengatur header halaman untuk mendownload file bertipe PDF
	 */
	function set_file_download($file_path, $file_alias) {
		if(!file_exists($file_path) || !is_file($file_path)) {
			redirect("/");
		}
		
		$content_type = mime_content_type($file_path);
		$file_size = filesize($file_path);
		$content_disposition = "inline";

		if($file_size > (10 * 1000000)) { // If bigger than 10 MB, do not attempt to open in browser. Download instead.
			$content_disposition = "attachment";
		}
		
		header("Content-type: {$content_type}");
		header('Content-Length: ' . $file_size);
		header("Pragma: public");
		header("Expires: -1");
		header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
		
		header('Content-Disposition: '. $content_disposition .'; filename="'. $file_alias .'"'); // The double quote, use to protect the $file_alias format
		
		// To allow big file
		if (ob_get_level()) {
			ob_end_clean();
		}

		// Chunk download if is a big file
		$chunksize = 1 * (1024 * 1024); // how many bytes per chunk
		if ($file_size > $chunksize) {
			$handle = fopen($file_path, 'rb');
			$buffer = '';
		while (!feof($handle)) {
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			ob_flush();
			flush();
		}
			fclose($handle);
		} else {
			readfile($file_path);
		}
	}

	function get_current_email() {
			return "ucupajaoke@gmail.com";
	}

	function get_smtp_config() {
		set_time_limit(300);
		$config = array();
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = get_current_email();
		$config['smtp_pass'] = "ucupajaoke";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		// $config = array();
		// $config['protocol'] = "smtp";
		// $config['smtp_host'] = "ssl://mail.esdm.go.id";
		// $config['smtp_port'] = "465"; // 995 or 465
		// $config['smtp_user'] = get_current_email();
		// $config['smtp_pass'] = "06Cikini03";
		// $config['charset'] = "utf-8";
		// $config['mailtype'] = "html";
		// $config['newline'] = "\r\n";
		// $config['smtp_timeout'] = 500;

		return $config;
	}

	function sendEmails($t_user_data = array(), $subject, $message) {
		foreach ($t_user_data as $t_user) {
			sendEmail($t_user->EMAIL_USER, $subject, $message);
		}
	}

	function sendSingleEmails($t_user_data = array(), $t_user_cc = array(), $subject, $message) {
		$to_array = array();
		$cc_array = array();

		$to_array = array_map(function($item) {
			return $item->EMAIL_USER;
		}, $t_user_data);

		$cc_array = array_map(function($item) {
			return $item->EMAIL_USER;
		}, $t_user_cc);

		sendEmail($to_array, $subject, $message, $cc_array);
	}

	function sendEmail($to_email, $subject, $message, $to_cc = array()) {
		$ci = get_instance();
		$ci->load->library('email');
		$config = get_smtp_config();
	
		$ci->email->initialize($config);
	
		$ci->email->from(get_current_email(), 'Minerba');
		$ci->email->to($to_email);
		$ci->email->cc($to_cc);
		$ci->email->subject($subject);
		$ci->email->message($message);
	
		return $ci->email->send();
	}
	
	function move_element_to_top(&$array, $key) {
		$temp = array($key => $array[$key]);
		unset($array[$key]);
		$array = $temp + $array;
	}

	function clean_data($data) {
		$data = full_clean($data, TRUE);

		return $data;
	}

	function clean_sql(&$data) {
		$data = full_clean($data, TRUE, FALSE);
	}

	function issetor(&$var, $default = false) {
		return isset($var) ? $var : $default;
	}

	function isemptyor(&$var, $default = false) {
		return !empty($var) ? $var : $default;
	}

	function issetemptyor(&$var, $default = false) {
		$data = isset($var) ? $var : $default;

		return !empty($data) ? $data : $default;
	}

	function isnullor($var, $default = FALSE) {
		return (!is_null($var) ? $var : $default);
	}

	function vdd($data = NULL) {
		var_dump($data);
		die();
	}

	function deleteAllInsideDirectory($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				deleteAllInsideDirectory($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

	function formatBytes($bytes, $precision = 2, $divider = 1000) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	
		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log($divider)); 
		$pow = min($pow, count($units) - 1); 
	
		// Uncomment one of the following alternatives
		$bytes /= pow($divider, $pow);
		// $bytes /= (1 << (10 * $pow)); 
	
		return round($bytes, $precision) . ' ' . $units[$pow]; 
	}

	function checked_jenis_file($jenis_file, $val) {
		$jenis_file = explode(",", $jenis_file);

		if(in_array($val, $jenis_file)) {
			echo "checked";
		}
	}

	function tgl_indo($tanggal){
		$tanggal = date("Y-m-d", strtotime($tanggal));
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
	
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	function tgl_indo_ok($tanggal){
		$tanggal = date("Y-m-d", strtotime($tanggal));
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
	
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan] . ' ' . $pecahkan[0];
	}

	function get_max_size($format_bytes = FALSE) {
		$_ci = &get_instance();
        $_ci->load->config('allowed_extension');
		$max_size = $_ci->config->item("max_size_ace_file_input");

		if($format_bytes) {
			$max_size = formatBytes($max_size);
		}
		
		return $max_size;
	}

	function get_csrf_token() {
		$_ci = &get_instance();

		$csrf_token = $_ci->security->get_csrf_token_name();
		$csrf_hash = $_ci->security->get_csrf_hash();
		
		echo "<input type='hidden' name='{$csrf_token}' value='{$csrf_hash}' style='display: none'>";
	}

	function get_dokumen_readonly($dokumen, $print_readonly = NULL, $print_not_readonly = NULL) {
		$_ci = &get_instance();

		$is_verified = $_ci->session->userdata('isVerified');
		if(!empty($is_verified)) {
			$is_verified = $is_verified->IS_VERIFIED;
		} else {
			$is_verified = "N";
		}

		return ($dokumen->IS_UPDATEABLE == 'N' && $is_verified == 'Y');

		// if($dokumen->IS_UPDATEABLE == 'N' && $is_verified == 'Y') {
		// 	return isemptyor($print_readonly, "readonly='readonly'");
		// } else {
		// 	return isemptyor($print_not_readonly, "");
		// }
	}

	function decrypt_id_permohonan($encrypted_id_permohonan) {
		$_ci = &get_instance();
		$_ci->load->config('kode_tracking');
		$hash_key = $_ci->config->item('hashid_key');
		$min_char = $_ci->config->item('hashid_minimal_character');

		$hashids = new Hashids($hash_key, $min_char);

		$plain_id_permohonan = $hashids->decode($encrypted_id_permohonan);

		return (!empty($plain_id_permohonan) ? $plain_id_permohonan[0] : "");
	}

	function encrypted_id_permohonan($plain_id_permohonan) {
		$_ci = &get_instance();
		$_ci->load->config('kode_tracking');
		$hash_key = $_ci->config->item('hashid_key');
		$min_char = $_ci->config->item('hashid_minimal_character');

		$hashids = new Hashids($hash_key, $min_char);

		$encrypted_id_permohonan = $hashids->encode($plain_id_permohonan);

		return $encrypted_id_permohonan;
	}

	function dateDifference($date_1, $date_2, $differenceFormat = '%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($differenceFormat);
	
	}

	/**
	 * Function that groups an array of associative arrays by some key.
	 * 
	 * @param {String} $key Property to sort by.
	 * @param {Array} $data Array that stores multiple associative arrays.
	 */
	function array_group_by($key, $data) {
		$result = array();

		foreach($data as $val) {

			if(is_object($val)) {
				$val = (array) $val;
			}

			if(array_key_exists($key, $val)){
				$result[$val[$key]][] = $val;
			}else{
				$result[""][] = $val;
			}
		}

		return $result;
	}

	function enc_dec_id_permohonan($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'RY6tPAsEFJmpdQsKIsov2qL3VUXBngBdErnXIqCunZ0e8Z6ht3WdyQOti0ppQKD';
        $secret_iv = 'JmkQRnYNO7LktlkkR0PxeZbf2IpblxR76M3fltrh96iXA3CHlD4ehOUiNtLSuhF';

        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $real_string = base64_decode($string);

            if($real_string === FALSE) {
                return FALSE;
            }

            $output = openssl_decrypt($real_string, $encrypt_method, $key, 0, $iv);
        }

        return $output;
	}

	use Carbon\Carbon;
	use Carbon\CarbonPeriod;
	use Carbon\CarbonInterval;
	use Cmixin\BusinessDay;
	
	function enable_carbon() {
		BusinessDay::enable('Carbon\Carbon');

		$_ci = &get_instance();
		$_ci->load->config('holidays');
		$holiday_days = $_ci->config->item('holiday_days');

		// Set holidays
        Carbon::addHolidays('indonesia', $holiday_days);
		
        Carbon::setHolidaysRegion('indonesia');
	}

	function get_izin_pdf_url() {
		$_ci = &get_instance();
		$_ci->load->config('form_url_config');
		$base_url = $_ci->config->item('izin_pdf');

		return $base_url;
	}

	function get_enkriptor_loc() {
		$_ci = &get_instance();
		$_ci->load->config('form_url_config');
		$location = $_ci->config->item('enkriptor_location');

		return $location;
	}

	function check_maintenance() {
		$_ci = &get_instance();
		$_ci->load->config('maintenance');
		$is_maintenance = $_ci->config->item('is_maintenance');

		if($is_maintenance) {
			redirect("Maintenance");
		}
	}

	function current_date() {
		return tanggal_indo_ebtke(convert_datetime(date('Y-m-d H:i:s')), 1);
	}

	function convert_datetime($datetime = false, $timezone = "Asia/Jakarta") {
		if (!$datetime) return false;
	
		$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
		$datetime->setTimezone(new DateTimeZone($timezone));
		return $datetime->format('Y-m-d H:i:s');
	}
    
    function role_side_menu() {
		$_ci = &get_instance();
		
		$id_user = $_ci->session->userdata('userdata')->ID_USER;
		
		$_ci->load->model("M_role");
		return $_ci->M_role->select_akses_role($id_user);
		
	}
	
	function tanggal_indo_ebtke($tanggal, $type=NULL)
{
	if (!$tanggal) return false;

	$tgl = substr($tanggal, 8, 2);
	$bln = substr($tanggal, 5, 2);
	$thn = substr($tanggal, 0, 4);
	$jam = substr($tanggal, 11, 5);
	$fulltime = substr($tanggal, 11, 8);

	$date = date_create($thn.'-'.$bln.'-'.$tgl);
	$hari = date_format($date, 'l');

	switch ($hari) {
		case "Monday": $hari = "Senin"; break;
		case "Tuesday": $hari = "Selasa"; break;
		case "Wednesday": $hari = "Rabu"; break;
		case "Thursday": $hari = "Kamis"; break;
		case "Friday": $hari = "Jumat"; break;
		case "Saturday": $hari = "Sabtu"; break;
		default: $hari = "Minggu";
	}

	switch ($bln) {
		case 01: $bln_nama = "Januari"; break;
		case 02: $bln_nama = "Februari"; break;
		case 03: $bln_nama = "Maret"; break;
		case 04: $bln_nama = "April"; break;
		case 05: $bln_nama = "Mei"; break;
		case 06: $bln_nama = "Juni"; break;
		case 07: $bln_nama = "Juli"; break;
		case '08': $bln_nama = "Agustus"; break;
		case '09': $bln_nama = "September"; break;
		case 10: $bln_nama = "Oktober"; break;
		case 11: $bln_nama = "November"; break;
		default: $bln_nama = "Desember";
	}

	switch($type){
		case 1:
			$data = $hari . ', ' .$tgl.' '.$bln_nama.' '.$thn.' | '.$jam.' WIB';
			break;
		case 2:
			$data = $tgl.' '.$bln_nama.' '.$thn;
			break;
		case 3:
			$data = $hari.', '.$bln_nama.' '.$tgl.', '.$thn.' at '.$jam;
			break;
		case 4:
			$data = $thn.'/'.$bln.'/'.$tgl;
			break;
		case 5:
			$data = $tgl.'-'.$bln.'-'.$thn;
			break;
		case 6:
			$data = $thn.'-'.$bln.'-'.$tgl.' '.$fulltime;
			break;
		default:
			$data = $tgl.'-'.$bln.'-'.$thn.' &nbsp; '.$fulltime;
			break;
	}

	return $data;
}
?>