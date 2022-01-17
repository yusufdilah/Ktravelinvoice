<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_slider_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Home_slider_model");
        $this->load->library('form_validation');
        // $this->load->library('image_lib');
        $this->config->load('upload_setting', TRUE);	
        $this->config->load('api_setting', TRUE);
        $this->load->library('upload');
    }

    public function index()
    {
        $data["home_slider"] = $this->Home_slider_model->getALL();
        $this->load->view("home_slider/lihat_home_slider", $data);
    }

    public function add()
    {
        $dataHomeslider = $this->input->post();
        $judul = $dataHomeslider['judul'];
        $expired  = $dataHomeslider['expired'];
        $isi  = $dataHomeslider['isi'];
        $you_tube  = $dataHomeslider['you_tube'];
        $curent_date = date('Y-m-d');
        $Home_slider_model = $this->Home_slider_model;
        $validation = $this->form_validation;
		$validation->set_rules($Home_slider_model->rules());
        if ($validation->run()) {
            if ($expired <= $curent_date) {
                # code...
                $this->session->set_flashdata('message', 'Expired harus lebih besar dari hari ini');
                redirect('Home_slider_controller/add');
            }else {
                $this->input->post();
                // $this->img = $this->_uploadImage();
                $home_slider = 'home_slider_';
                $a = mt_rand(1234567,1234699);
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                date_default_timezone_set("Asia/Jakarta");
                $tanggal = date('dmy_his');
                $config['file_name']            = $home_slider.$a;
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
                $config['max_size']             = '220';
                
                $this->upload->initialize($config);
                $upload = $_FILES['img']['name'];
            // var_dump($upload);die();
                if (!empty($upload)) {
                    # code...
                        $session_nasabah = $this->session->userdata('token_nasabah');   
                        if ($this->upload->do_upload('img')) {
                        $imageName = $this->upload->data();
                        // $this->Home_slider_model->upload($data_img);
                        $config['image_libary'] = 'gd2';
                        $config['source_image'] = './file.upload.1/'.$imageName['file_name'];
                        // var_dump($config['source_image']);die();
                        $config['create_thumb'] = false;
                        $config['mantain_ratio'] = false;
                        $config['quality'] = '50%';
                        $config['width'] = 1280;
                        $config['height'] = 720;
                        $config['new_image'] = './file.upload.1/'.$imageName['file_name'];
                        $this->load->library('image_lib',$config);
                        // // $this->image_lib->clear();    
                        $this->image_lib->resize();

                        // return $this->upload->data("file_name");
                        $data_add=[
                            'img' => $imageName['file_name'],
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'expired' => $expired,
                            'created_by' => $session_nasabah
                        ];
                        $Home_slider_model->save($data_add);
                        // $maxid = 0;
                        $row = $this->db->query('SELECT MAX(home_slider_id) AS `maxid` FROM `home_slider`')->row();
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
                                                                "kategori"=>"home_slider_detail",
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
                          //       var_dump($result);
                          //       echo '</pre>';
                          //       die();
                        $response_json_code  = $json['response_code'];
                        $response_json_share = $json['response_data'];
                                if ($response_json_code != 105 || $response_json_share != 'success_input') 
                                {
                                    $br = "<br>(Push API Gagal !)";
                                    $this->session->set_flashdata('message', 'Gagal Tambah Home Slider '.$br.''); // Buat session flashdata
                                    redirect('Home_slider_controller/add'); 
                                } else{
                                        $this->session->set_flashdata('success', 'Tambah Home Slider dengan judul '.$judul.' Berhasil Disimpan');
                                        redirect('Home_slider_controller');  
                                }

                            // $this->session->set_flashdata('success', 'Tambah Home Slider dengan judul '.$judul.' Berhasil Disimpan');
                            // redirect('Home_slider_controller');
                    }else{

                        // $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Home_slider_controller/add');
                    }
                }else {
                    $data_add=[
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'expired' => $expired,
                            'created_by' => $session_nasabah
                        ];
                    $Home_slider_model->save($data_add);
                    $row = $this->db->query('SELECT MAX(home_slider_id) AS `maxid` FROM `home_slider`')->row();
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
                                                                "kategori"=>"home_slider_detail",
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
                          //       var_dump($result);
                          //       echo '</pre>';
                          //       die();
                        $response_json_code  = $json['response_code'];
                        $response_json_share = $json['response_data'];
                                if ($response_json_code != 105 || $response_json_share != 'success_input') 
                                {
                                    $br = "<br>(Push API Gagal !)";
                                    $this->session->set_flashdata('message', 'Gagal Tambah Home Slider '.$br.''); // Buat session flashdata
                                    redirect('Home_slider_controller/add'); 
                                } else{
                                        $this->session->set_flashdata('success', 'Tambah Home Slider dengan judul '.$judul.' Berhasil Disimpan');
                                        redirect('Home_slider_controller');  
                                }    
                }
            }    
        }
        $this->load->view("home_slider/tambah_home_slider");
    }



    public function edit($id){
        $Home_slider_model = $this->Home_slider_model; //object model
        $dataHomeslider = $this->input->post();
        $judul = $dataHomeslider['judul'];
        $expired  = $dataHomeslider['expired'];
        $isi  = $dataHomeslider['isi'];
        $you_tube  = $dataHomeslider['you_tube'];
        $old_img  = $dataHomeslider['old_img'];
        $curent_date = date('Y-m-d'); 
        date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($Home_slider_model->rules()); //terapkan rules di Home_slider_model.php
        if ($validation->run()) { //lakukan validasi form
            if ($expired <= $curent_date) {
                $this->session->set_flashdata('message', 'Expired harus lebih besar dari hari ini');
                redirect('Home_slider_controller/edit/'.$id);
            }else {
                $home_slider = 'home_slider_';
                $a = mt_rand(1234567,1234699);
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                $tanggal = date('dmy_his');
                $config['file_name']            = $home_slider.$a;
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg';
                $config['max_size']             = '220';
                $this->upload->initialize($config);
                $upload = $_FILES['img']['name'];
                if (!empty($upload)) {
                        $session_nasabah = $this->session->userdata('token_nasabah');   

                        if ($this->upload->do_upload('img')) {
                        $imageName = $this->upload->data();
                        $config['image_libary'] = 'gd2';
                        $config['source_image'] = './file.upload.1/'.$imageName['file_name'];
                        $config['create_thumb'] = false;
                        $config['mantain_ratio'] = false;
                        $config['quality'] = '50%';
                        $config['width'] = 1280;
                        $config['height'] = 720;
                        $config['new_image'] = './file.upload.1/'.$imageName['file_name'];
                        $this->load->library('image_lib',$config);
                        $this->image_lib->resize();
                        $data_edit=[
                            'img' => $Home_slider_model->_deleteImage($id),
                            'img' => $imageName['file_name'],
                            'judul' => $judul,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'expired' => $expired,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                            $Home_slider_model->update($id,$data_edit); // update data
                            $this->session->set_flashdata('success', 'Data Home Slider Berhasil Diubah');
                            redirect('Home_slider_controller/edit/'.$id);
                    }else{
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Home_slider_controller/edit/'.$id);
                    }
                }else {
                    $session_nasabah = $this->session->userdata('token_nasabah'); 
                    $data_edit=[
                            'judul' => $judul,
                            'img' => $old_img,
                            'isi' => $isi,
                            'you_tube' => $you_tube,
                            'expired' => $expired,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                        $Home_slider_model->update($id,$data_edit); // update data
                        $this->session->set_flashdata('success', 'Data Home Slider Berhasil Diubah');
                        redirect('Home_slider_controller/edit/'.$id);    
                } 
            }
        }
        $data['home_slider'] = $this->Home_slider_model->getById($id);
        $this->load->view('home_slider/edit_home_slider', $data);
    }

    public function delete($id){
	    $this->Home_slider_model->delete($id); 
        $url_api_share      = $this->config->item('url_api_global', 'api_setting');
        $url_share          = $url_api_share.'link_share_generate';
        $user_auth          = $this->config->item('user_api', 'api_setting');
        $pass_auth          = $this->config->item('password_api', 'api_setting');
        $response_json_code = 0;
        $ch_share       = curl_init($url_share); // create a new cURL resource
        $result         = $this->config->item('result','api_setting');// setup request to send  
        $save_share   = json_encode(
                                    array("flag"=>"delete",
                                          "kategori"=>"home_slider_detail",
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
                    $this->session->set_flashdata('message', 'Gagal Hapus Home Slider '.$br.''); // Buat session flashdata
                    redirect('Home_slider_controller'); 
        } else{
                    $this->session->set_flashdata('success', 'Data Home Slider Berhasil Dihapus');
                    redirect('Home_slider_controller'); 
        }
	    // $this->session->set_flashdata('success', 'Data Home Slider Berhasil Dihapus');
	    // redirect('Home_slider_controller');
	}

}
