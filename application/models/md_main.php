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
}