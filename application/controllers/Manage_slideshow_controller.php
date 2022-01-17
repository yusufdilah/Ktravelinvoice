<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Manage_slideshow_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Manage_slideshow_model");
        $this->load->model("Info_terbaru_model");
        $this->load->model("Underconstruction_mode_model");
        $this->load->library('form_validation');
        $this->config->load('upload_setting', TRUE);    
        $this->load->library('upload');
    }

    public function index()
    {
        $data['detail_info_terbaru'] = $this->Info_terbaru_model->detail_info_terbaru($id);
        $data["manage_slideshow"] = $this->Manage_slideshow_model->getById($id);
        $this->load->view('manage_slideshow/lihat_manage_slideshow', $data); // Load view form.php
        // $this->load->view("info_terbaru/lihat_info_terbaru", $data);
    }

    public function add()
    {
        $info_terbaru_id  = $this->input->post('info_terbaru_id');
        $status           = $this->input->post('status');
        $manage_slideshow = $this->Manage_slideshow_model;
        $validation = $this->form_validation;
        $validation->set_rules($manage_slideshow->rules());

        if ($validation->run()) {
            // echo "string";die();
                $this->input->post();
                // $this->img = $this->_uploadImage();
                $info_tb = 'info_tb_dtl';
                $a = mt_rand(1234567,1234699);
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                date_default_timezone_set("Asia/Jakarta");
                $config['file_name']            = $info_tb.$a;
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
                            'img' => $imageName['file_name'],
                            'info_terbaru_id' => $info_terbaru_id,
                            'status' => $status,
                            'created_by' => $session_nasabah
                        ];
                            $manage_slideshow->save($data_add);
                            $this->session->set_flashdata('success', 'Tambah Manage Slideshow  Berhasil Disimpan');
                            redirect('Info_terbaru_controller/detail/'.$info_terbaru_id);
                    }else{
                        // $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Manage_slideshow_controller/form_add/'.$info_terbaru_id);
                    }
                }else {
                    $session_nasabah = $this->session->userdata('token_nasabah');  
                    $data_add=[
                            'info_terbaru_id' => $info_terbaru_id,
                            'status' => $status,
                            'created_by' => $session_nasabah
                        ];
                            $manage_slideshow->save($data_add);
                            $this->session->set_flashdata('success', 'Tambah Manage Slideshow  Berhasil Disimpan');
                            redirect('Info_terbaru_controller/detail/'.$info_terbaru_id);   
                }
        }
        $data['info_terbaru'] = $this->Info_terbaru_model->getById($id);
        // $this->load->view("anak/tambah_anak", $data);
    }


    public function edit($id)
    {
        $info_terbaru_id  = $this->input->post('info_terbaru_id');
        $status           = $this->input->post('status');
        $info_terbaru_img_id    = $this->input->post('info_terbaru_img_id');
        $old_img    = $this->input->post('old_img');
        date_default_timezone_set("Asia/Jakarta");   
        $updated_date = date('Y-m-d H:i:s');
        $curent_date = date('Y-m-d');
        $manage_slideshow = $this->Manage_slideshow_model;
        $validation = $this->form_validation;
        $validation->set_rules($manage_slideshow->rules());

        if ($validation->run()) {
                $this->input->post();
                // $this->img = $this->_uploadImage();
                $info_tb = 'info_tb_dtl';
                $a = mt_rand(1234567,1234699);
                $this->config->load('upload_setting', TRUE);
                $config = $this->config->item('upload_setting');
                date_default_timezone_set("Asia/Jakarta");
                $config['file_name']            = $info_tb.$a;
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
                        $data_edit=[
                            'img' => $manage_slideshow->_deleteImage($id),
                            'img' => $imageName['file_name'],
                            'info_terbaru_id' => $info_terbaru_id,
                            'status' => $status,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                            $manage_slideshow->update($id,$data_edit);
                            $this->session->set_flashdata('success', 'Edit Manage Slideshow  Berhasil Disimpan');
                            redirect('Info_terbaru_controller/detail/'.$info_terbaru_id);
                    }else{
                        // $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                        redirect('Manage_slideshow_controller/edit/'.$info_terbaru_img_id);
                    }
                }else {
                    $session_nasabah = $this->session->userdata('token_nasabah');  
                    $data_edit=[
                            'img' => $old_img,
                            'info_terbaru_id' => $info_terbaru_id,
                            'status' => $status,
                            'updated_by' => $session_nasabah,
                            'updated_date' => $updated_date
                        ];
                            $manage_slideshow->update($id,$data_edit);
                            $this->session->set_flashdata('success', 'Edit Manage Slideshow  Berhasil Disimpan');
                            redirect('Info_terbaru_controller/detail/'.$info_terbaru_id); 
                }
        }
        $data['manage_slideshow'] = $this->Manage_slideshow_model->getById($id);
        $this->load->view('manage_slideshow/edit_manage_slideshow', $data);
    }

    public function form_add($id){
        $data['info_terbaru'] = $this->Info_terbaru_model->getById($id);
        $data['detail'] = $this->Info_terbaru_model->detail($id);
            $this->load->view('manage_slideshow/tambah_manage_slideshow', $data); // Load view form.php
    } 
    

    public function delete($id){
        $this->Manage_slideshow_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Manage Slideshow Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']); //fungsinya sama kaya return redirect->back
    }
}
