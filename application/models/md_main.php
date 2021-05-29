<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class md_main extends CI_Model {

    public function cek_login($table,$where){      
        return $this->db->get_where($table,$where);
    }

    public function update_last_login($username){
        $this->db->query("UPDATE akun SET last_login = NOW() WHERE username = '$username';");
    }   

    public function list_menu()
    {
        $barang = $this->db->get('produk');
        return $barang;
    }
    public function product($id)
    {
        return $this->db->get_where('produk',array('idProduk'=>$id));
    }
    public function input_simpan($file_name)
    {
        $dataproduk = array(
            'namaProduk'   =>$this->input->post('namaProduk'),
            'hargaProduk'         =>$this->input->post('hargaProduk'),
            'fotoProduk'          =>$file_name);
        $this->db->insert('produk',$dataproduk);
    }
    public function edit_simpan($file_name,$id)
    {
        $dataproduk = array(
            'namaProduk'   =>$this->input->post('namaProduk'),
            'hargaProduk'         =>$this->input->post('hargaProduk'),
            'fotoProduk'          =>$file_name);
        $this->db->where('idProduk',$id);
        $this->db->update('produk',$dataproduk);
    }
    public function hapus($id)
    {
        $this->db->where('idProduk',$id);
        $this->db->delete('produk');
    }

    public function register()
    {
        $datauser = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        return $this->db->insert('akun', $datauser);
    }

    public function get_produk_all()
    {
        $query = $this->db->get('produk');
        return $query->result_array();
    }
    
    public function get_produk_kategori($kategori)
    {
        if($kategori>0)
            {
                $this->db->where('kategori',$kategori);
            }
        $query = $this->db->get('tbl_produk');
        return $query->result_array();
    }
    
    public function get_kategori_all()
    {
        $query = $this->db->get('tbl_kategori');
        return $query->result_array();
    }
    
    public  function get_produk_id($id)
    {
        $this->db->select('tbl_produk.*,nama_kategori');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori', 'kategori=tbl_kategori.id','left');
        $this->db->where('id_produk',$id);
        return $this->db->get();
    }   
    
    public function pemesanan($data)
    {
        $this->db->insert('pemesanan', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function tambah_order($data)
    {
        $this->db->insert('tbl_order', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function tambah_detail_order($data)
    {
        $this->db->insert('detail_pemesanan', $data);
    }
}