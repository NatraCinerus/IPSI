<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('md_main');
    }

	public function index(){
        $data['produk'] = $this->md_main->get_produk_all();
        $this->load->view('themes/header',$data);
        $this->load->view('shopping/list_produk',$data);
        $this->load->view('themes/footer');
	}

    public function panel(){
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
    //fungsi pemesanan


    public function tampil_cart()
    {
        $this->load->view('themes/header');
        $this->load->view('shopping/tampil_cart');
        $this->load->view('themes/footer');
    }
    
    public function check_out()
    {
        $this->load->view('themes/header');
        $this->load->view('shopping/check_out');
        $this->load->view('themes/footer');
    }
    
    public function detail_produk()
    {
        $id=($this->uri->segment(3))?$this->uri->segment(3):0;
        $data['kategori'] = $this->md_main->get_kategori_all();
        $data['detail'] = $this->md_main->get_produk_id($id)->row_array();
        $this->load->view('themes/header',$data);
        $this->load->view('shopping/detail_produk',$data);
        $this->load->view('themes/footer');
    }
    
    
    function tambah()
    {
        $data_produk= array('id' => $this->input->post('id'),
                             'name' => $this->input->post('nama'),
                             'price' => $this->input->post('harga'),
                             'gambar' => $this->input->post('gambar'),
                             'qty' =>$this->input->post('qty')
                            );
        $this->cart->insert($data_produk);
        redirect('main');
    }

    public function halo($value)
    {
        var_dump($value);
    }

    function hapus($rowid) 
    {
        $rowid = $this->uri->segment(2);
        var_dump($rowid);
        if ($rowid=="all")
            {
                $this->cart->destroy();
            }
        else
            {
                $data = array('rowid' => $rowid,
                              'qty' =>0);
                $this->cart->update($data);
            }
        // redirect('tampil_cart');
    }

    function ubah_cart()
    {
        $cart_info = $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $gambar = $cart['gambar'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
            $data = array('rowid' => $rowid,
                            'price' => $price,
                            'gambar' => $gambar,
                            'amount' => $amount,
                            'qty' => $qty);
            $this->cart->update($data);
        }
        redirect('tampil_cart');
    }

    public function proses_order()
    {
        //-------------------------Input data pemesanan--------------------------
        $data_pemesanan = array('nama' => $this->input->post('nama'),
                                'tanggal' => date('Y-m-d'));
        $id_pemesanan = $this->md_main->pemesanan($data_pemesanan);
        //-------------------------Input data detail order-----------------------       
        if ($cart = $this->cart->contents())
            {
                foreach ($cart as $item)
                    {
                        $data_detail = array('id_pemesanan' =>$id_pemesanan,
                                        'id_produk' => $item['id'],
                                        'qty' => $item['qty'],
                                        'total_harga' => ($item['price'] * $item['qty']));         
                        $proses = $this->md_main->tambah_detail_order($data_detail);
                    }
            }
        //-------------------------Hapus shopping cart--------------------------        
        $this->cart->destroy();
        $this->load->view('themes/header');
        $this->load->view('shopping/sukses');
        $this->load->view('themes/footer');
    }
}