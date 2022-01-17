<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kategori_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["kategori"] = $this->Kategori_model->getAll();
        $this->load->view("kategori/lihat_kategori", $data);
    }

    public function add()
    {
        $setting_menu = $this->Kategori_model;
        $validation = $this->form_validation;
        $validation->set_rules($setting_menu->rules());
        
        if ($validation->run()) {
            $setting_menu->save();
            $this->session->set_flashdata('success', 'Tambah Parameter Kategori Berhasil Disimpan');
            redirect('Kategori_controller');
        }else{
        }

        $this->load->view("kategori/tambah_parameter_kategori");
    }

    public function detail($id){

        
        $id_kategori= $id;
        // echo $id_kategori.'okay';die();
        $data['datadetailKategori'] = $this->Kategori_model->detailKategori($id);
        $data['adddetailKategori'] = $this->Kategori_model->getById($id);
        
        $this->load->view('kategori/detail_kategori', $data);
    }
    public function newDetail($id){

        
        $data['datadetailKategori'] = $this->Kategori_model->detailKategori($id);
        $data['dataKategori'] = $this->Kategori_model->getAll();
        $data['adddetailKategori'] = $this->Kategori_model->getById($id);
        
        $this->load->view('kategori/tambah_kategori', $data);
    }
    public function saveDetail(){
        $parameter_category_id  = $this->input->post('parameter_category_id');
        $setting_kategori = $this->Kategori_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($setting_kategori->rulesDetail()); //terapkan rules di Kategori_model.php

        if ($validation->run()) { //lakukan validasi form
            
            $setting_kategori->save_detail(); // update data
            $this->session->set_flashdata('success', 'Data Detail Berhasil disimpan');
            redirect('Kategori_controller/detail/'.$parameter_category_id);
        }

        
    }
    public function edit($id){

        $setting_menu = $this->Kategori_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($setting_menu->rules()); //terapkan rules di Kategori_model.php

        if ($validation->run()) { //lakukan validasi form
            
            $setting_menu->update($id); // update data
            $this->session->set_flashdata('success', 'Data detail "'.$this->Kategori_model->getById($id)->parameter_category.'" Berhasil Diubah');
            redirect('Kategori_controller');
        }

        $data['dataParameterKategori'] = $this->Kategori_model->getById($id);
        $this->load->view('kategori/edit_parameter_kategori', $data);
    }
    public function editDetail($id){

        $setting_menu = $this->Kategori_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($setting_menu->rulesDetail()); //terapkan rules di Kategori_model.php

        if ($validation->run()) { //lakukan validasi form
            
            $setting_menu->updateDetail($id); // update data
            $this->session->set_flashdata('success', 'Data detail "'.$this->Kategori_model->getByIdParameter($id)->parameter.'" Berhasil Diubah');
            redirect('Kategori_controller/detail/'.$this->Kategori_model->getByIdParameter($id)->parameter_category_id);
        }

        $data['dataKategori'] = $this->Kategori_model->getByIdParameter($id);
        $this->load->view('kategori/edit_kategori', $data);
    }

    public function deleteDetail($id){
        $parameter_category_id = $this->Kategori_model->getByIdParameter($id)->parameter_category_id;
        
        $this->Kategori_model->delete_detail($id); 
        $this->session->set_flashdata('success', 'Data detail "'.$this->Kategori_model->getByIdParameter($id)->parameter.'" Berhasil Dihapus');
        redirect('Kategori_controller/detail/'.$parameter_category_id);
    }
    public function delete($id){
        $this->Kategori_model->delete($id); 
        $this->session->set_flashdata('success', 'Data Parameter Category Berhasil Dihapus');
        redirect('Kategori_controller');
    }
}
