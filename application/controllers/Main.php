<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('md_main');
    }

	public function index(){
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
		$this->views('dashboard/index');
	}

	public function menu(){
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
        $data['produk'] = $this->md_main->list_menu()->result_array();
		$this->views('menu/index',$data);
	}

	public function addMenu(){
		$this->views('menu/add');
	}

	public function addSubmit()
	{
		$config['upload_path']          = './assets/img/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['overwrite']            = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('fotoProduk'))
        {
          echo $this->upload->display_errors();
        }
        else
        {
          $image = $this->upload->data();
          $file_name = $image['file_name'];
        }
        $data['input_simpan'] = $this->md_main->input_simpan($file_name);

        redirect('main/menu');
	}

    public function delete()
    {
        $id = $this->uri->segment(2);
        $data['delete'] = $this->md_main->hapus($id);
        $this->session->set_flashdata('hapus', 'success');
        redirect('main/menu');
    }

    public function edit()
    {
        $id = $this->uri->segment(2);
        $data['product'] = $this->md_main->product($id)->row_array();
        $this->views('menu/edit',$data);    
    }

    public function setSubmit()
    {
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['overwrite']            = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('fotoProduk'))
        {
          // echo $this->upload->display_errors();
          $file_name = $this->input->post('img');
          $id = $this->input->post('idProduk');
          $data['input_simpan'] = $this->md_main->edit_simpan($file_name,$id);
        }
        else
        {
          $image = $this->upload->data();
          $file_name = $image['file_name'];
          $id = $this->input->post('idProduk');
          $data['input_simpan'] = $this->md_main->edit_simpan($file_name,$id);
        }
        

        redirect('main/menu');
    }
}