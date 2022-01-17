<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Info_terbaru_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Info_terbaru_model");
        $this->load->model("Manage_slideshow_model");
        $this->load->library('form_validation');
        $this->config->load('upload_setting', TRUE);    
        $this->config->load('api_setting', TRUE);
        $this->load->library('upload');
    }

    public function index()
    {
        $data["info_terbaru"] = $this->Info_terbaru_model->getALLJoin();
        $this->load->view("info_terbaru/lihat_info_terbaru", $data);
    }


    public function detail($id)
    {
        $detail = $id;
        // echo $detail.'ak';die();
        $data['detail_info_terbaru'] = $this->Info_terbaru_model->detail_info_terbaru($id);
        $data["manage_slideshow"] = $this->Manage_slideshow_model->getById($id);
        $data["detail"] = $this->Info_terbaru_model->getById($id);
        $this->load->view('manage_slideshow/lihat_manage_slideshow', $data); // Load view form.php
        // $this->load->view("info_terbaru/lihat_info_terbaru", $data);
    }    


    	
    public function add()
    {
        $dataInfo_terbaru = $this->input->post();
        $judul = $dataInfo_terbaru['judul'];
        $cuplikan    = $dataInfo_terbaru['cuplikan'];
        $isi  = $dataInfo_terbaru['isi'];
        $you_tube  = $dataInfo_terbaru['you_tube'];
        $status  = $dataInfo_terbaru['status'];
        $curent_date = date('Y-m-d');
        $Info_terbaru_model = $this->Info_terbaru_model;
        $validation = $this->form_validation;
        $validation->set_rules($Info_terbaru_model->rules());

        if ($validation->run()) {
                $this->input->post();
                // $this->img = $this->_uploadImage();
                $info_tb = 'info_tb_';
                $a = mt_rand(1234567890,1234567989);
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                date_default_timezone_set("Asia/Jakarta");
                $config['file_name']            = $info_tb.$a;
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
                $config['max_size']             = '220';
                $this->upload->initialize($config);
                $upload = $_FILES['img_cuplik']['name'];
            // var_dump($upload);die();
                if (!empty($upload)) 
                {
                    $session_nasabah = $this->session->userdata('token_nasabah');   
                    if ($this->upload->do_upload('img_cuplik')) {
                        $imageName = $this->upload->data();
                        $config['image_libary'] = 'gd2';
                        $config['source_image'] = './file.upload.1/'.$imageName['file_name'];
                        $config['create_thumb'] = false;
                        $config['mantain_ratio'] = false;
                        $config['quality'] = '50%';
                        $config['width'] = 609;
                        $config['height'] = 609;
                        $config['new_image'] = './file.upload.1/'.$imageName['file_name'];
                        $this->load->library('image_lib',$config);
                        // // $this->image_lib->clear();    
                        $this->image_lib->resize();
                        // return $this->upload->data("file_name");
                        $data_add=[
                            'img_cuplik' => $imageName['file_name'],
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'cuplikan' => $cuplikan,
                            'status' => $status,
                            'created_by' => $session_nasabah
                        ];
                        $Info_terbaru_model->save($data_add);
                        $row = $this->db->query('SELECT MAX(info_terbaru_id) AS `maxid` FROM `info_terbaru`')->row();
                        if ($row) {
                            $maxid = $row->maxid; 
                            // echo $maxid.'max_id';die();
                        } 
                        $url_api_share      = $this->config->item('url_api_global', 'api_setting');
                        $url_share          = $url_api_share.'link_share_generate';
                        $user_auth          = $this->config->item('user_api', 'api_setting');
                        $pass_auth          = $this->config->item('password_api', 'api_setting');
                        $response_json_code = 0;
                        $ch_share       = curl_init($url_share); // create a new cURL resource
                        $result         = $this->config->item('result','api_setting');// setup request to send  
                        $save_share   = json_encode(
                                                        array("flag"=>"input",
                                                                "kategori"=>"info_terbaru_detail",
                                                                "primary_key"=>$maxid
                                                        )
                                                    ); 
                        curl_setopt($ch_share, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
                        curl_setopt($ch_share, CURLOPT_POSTFIELDS, $save_share); // attach encoded JSON string to the POST fields
                        curl_setopt($ch_share, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
                        $result = curl_exec($ch_share); // execute the POST request
                        curl_close($ch_share); // close cURL resource
                        $json = json_decode($result,true);
                        $response_json_code  = $json['response_code'];
                        $response_json_share = $json['response_data'];   
                        if ($response_json_code != 105 || $response_json_share != 'success_input') {

                                    $this->session->set_flashdata('message', 'Gagal tambah info terbaru'); // Buat session flashdata
                                    redirect('Info_terbaru_controller/add'); 
                        } else{
                                    $this->session->set_flashdata('success', 'Tambah info terbaru dengan judul '.$judul.' Berhasil Disimpan');
                                    redirect('Info_terbaru_controller'); 
                        } 
                    }else{

                        // $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Info_terbaru_controller/add');
                    }
                }
                else{
                        $session_nasabah = $this->session->userdata('token_nasabah');  
                        $data_add=[
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'cuplikan' => $cuplikan,
                            'status' => $status,
                            'created_by' => $session_nasabah
                        ];
                        $Info_terbaru_model->save($data_add);
                        $row = $this->db->query('SELECT MAX(info_terbaru_id) AS `maxid` FROM `info_terbaru`')->row();
                        if ($row) {
                            $maxid = $row->maxid; 
                            // echo $maxid.'max_id';die();
                        } 
                        $url_api_share      = $this->config->item('url_api_global', 'api_setting');
                        $url_share          = $url_api_share.'link_share_generate';
                        $user_auth          = $this->config->item('user_api', 'api_setting');
                        $pass_auth          = $this->config->item('password_api', 'api_setting');
                        $response_json_code = 0;
                        $ch_share       = curl_init($url_share); // create a new cURL resource
                        $result         = $this->config->item('result','api_setting');// setup request to send  
                        $save_share   = json_encode(
                                                        array("flag"=>"input",
                                                                "kategori"=>"info_terbaru_detail",
                                                                "primary_key"=>$maxid
                                                        )
                                                    ); 
                        curl_setopt($ch_share, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
                        curl_setopt($ch_share, CURLOPT_POSTFIELDS, $save_share); // attach encoded JSON string to the POST fields
                        curl_setopt($ch_share, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
                        // echo '<pre>';
                        //         var_dump($save_share);
                        //         echo '</pre>';
                        //         die();
                        $result = curl_exec($ch_share); // execute the POST request
                        curl_close($ch_share); // close cURL resource
                        $json = json_decode($result,true);
                        // echo '<pre>';
                        //         var_dump($result);
                        //         echo '</pre>';
                        //         die();
                        $response_json_code  = $json['response_code'];
                        $response_json_share = $json['response_data'];   
                        if ($response_json_code != 105 || $response_json_share != 'success_input') {
                                    $br = "<br>(Push API Gagal !)";
                                    $this->session->set_flashdata('message', 'Gagal tambah info terbaru '.$br.''); // Buat session flashdata
                                    redirect('Info_terbaru_controller/add'); 
                        } else{
                                    // $this->session->set_flashdata('success', $result);
                                    // $br = "<br>(Push API Berhasil !)";
                                    $this->session->set_flashdata('success', 'Tambah info terbaru dengan judul '.$judul.' Berhasil Disimpan '.$br.'  ');
                                    redirect('Info_terbaru_controller'); 
                        }   
                    }
        }
        $this->load->view("info_terbaru/tambah_info_terbaru");
    }


    public function form_add($id)
    {
        $info_terbaru = $this->Info_terbaru_model;
        $data['info_terbaru'] = $this->Info_terbaru_model->getById($id);
        $data['detail_info_terbaru'] = $this->Info_terbaru_model->detail($id);
        $data['detail'] = $this->Info_terbaru_model->getById($id);
        $this->load->view("manage_slideshow/tambah_manage_slideshow");
    }


    public function edit($id){
        $dataInfo_terbaru = $this->input->post();
        $judul = $dataInfo_terbaru['judul'];
        $cuplikan    = $dataInfo_terbaru['cuplikan'];
        $isi  = $dataInfo_terbaru['isi'];
        $you_tube  = $dataInfo_terbaru['you_tube'];
        $status  = $dataInfo_terbaru['status'];
        $old_img  = $dataInfo_terbaru['old_img'];
        date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
        $curent_date = date('Y-m-d');
    	$Info_terbaru_model = $this->Info_terbaru_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($Info_terbaru_model->rules()); //terapkan rules di Info_terbaru_model.php
        if ($validation->run()) { //lakukan validasi form
                $info_tb = 'info_tb_';
                $a = mt_rand(1234567890,1234567989); //buat random number
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                $config['file_name']            = $info_tb.$a;
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
                $config['max_size']             = '220';
                $this->upload->initialize($config);
                $upload = $_FILES['img_cuplik']['name'];
            // var_dump($upload);die();
                if (!empty($upload)) {
                    # code...
                        $session_nasabah = $this->session->userdata('token_nasabah');   
                        if ($this->upload->do_upload('img_cuplik')) {
                        $imageName = $this->upload->data();
                        $config['image_libary'] = 'gd2';
                        $config['source_image'] = './file.upload.1/'.$imageName['file_name'];
                        $config['create_thumb'] = false;
                        $config['mantain_ratio'] = false;
                        $config['quality'] = '50%';
                        $config['width'] = 609;
                        $config['height'] = 609;
                        $config['new_image'] = './file.upload.1/'.$imageName['file_name'];
                        $this->load->library('image_lib',$config);
                        $this->image_lib->resize();
                        $data_edit=[
                            'img_cuplik' => $Info_terbaru_model->_deleteImage($id),
                            'img_cuplik' => $imageName['file_name'],
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'cuplikan' => $cuplikan,
                            'status' => $status,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                        $Info_terbaru_model->update($id,$data_edit);
                            $this->session->set_flashdata('success', 'Data Info terbaru '.$Info_terbaru_model->getById($id)->judul.' Berhasil Diubah');
                            redirect('Info_terbaru_controller/edit/'.$id);  
                    }else{

                        // $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Info_terbaru_controller/edit/'.$id);
                    }
                }else {
                    $session_nasabah = $this->session->userdata('token_nasabah');  
                    $data_edit=[
                            'img_cuplik' => $old_img,
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'cuplikan' => $cuplikan,
                            'status' => $status,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                            $Info_terbaru_model->update($id,$data_edit);
                            $this->session->set_flashdata('success', 'Data Info terbaru '.$Info_terbaru_model->getById($id)->judul.' Berhasil Diubah');
                            redirect('Info_terbaru_controller/edit/'.$id);  
                }
        }
        $data['info_terbaru'] = $this->Info_terbaru_model->getById($id);
        $this->load->view('info_terbaru/edit_info_terbaru', $data);
    }



    public function delete($id){
	    $this->Info_terbaru_model->delete($id); // Panggil fungsi delete() yang ada di Model
	    $url_api_share      = $this->config->item('url_api_global', 'api_setting');
        $url_share          = $url_api_share.'link_share_generate';
        $user_auth          = $this->config->item('user_api', 'api_setting');
        $pass_auth          = $this->config->item('password_api', 'api_setting');
        $response_json_code = 0;
        $ch_share       = curl_init($url_share); // create a new cURL resource
        $result         = $this->config->item('result','api_setting');// setup request to send  
        $save_share   = json_encode(
                                    array("flag"=>"delete",
                                          "kategori"=>"info_terbaru_detail",
                                          "primary_key"=>$id
                                    )
                        ); 
        curl_setopt($ch_share, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));
        curl_setopt($ch_share, CURLOPT_POSTFIELDS, $save_share); // attach encoded JSON string to the POST fields
        curl_setopt($ch_share, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
                        // echo '<pre>';
                        //         var_dump($save_share);
                        //         echo '</pre>';
                        //         die();
        $result = curl_exec($ch_share); // execute the POST request
        curl_close($ch_share); // close cURL resource
        $json = json_decode($result,true);
                        // echo '<pre>';
                          //       var_dump($result);
                          //       echo '</pre>';
                          //       die();
        $response_json_code  = $json['response_code'];
        $response_json_share = $json['response_data'];
        if ($response_json_code != 105 || $response_json_share != 'success_delete') {
                    $br = "<br>(Push API Gagal !)";
                    $this->session->set_flashdata('message', 'Gagal Hapus Info terbaru '.$br.''); // Buat session flashdata
                    redirect('Home_slider_controller'); 
        } else{
                    $this->session->set_flashdata('success', 'Data Info terbaru Berhasil Dihapus');
                    redirect('Info_terbaru_controller'); 
        }
	    // $this->session->set_flashdata('success', 'Data Info terbaru Berhasil Dihapus');
	    // redirect('Info_terbaru_controller');
	}
}
