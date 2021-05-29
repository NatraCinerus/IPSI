<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikator extends MY_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('md_main'); 
		$this->load->library('session');
	}

	public function login(){
		$this->load->view('login/index');
	}

	public function validasi_akun()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->md_main->cek_login("akun",$where)->num_rows();
		echo $cek;
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
			);

			$this->session->set_userdata($data_session);
			$this->md_main->update_last_login($username);
			redirect('panel');

		}else{
			$this->session->set_flashdata('attempt', 'fail');
			redirect("login");
		}
	}

	public function register()
	{
		$this->load->view('login/register');
	}

	public function buatAkun()
	{
		$cek = $this->md_main->register();
		if ($cek){
			$this->session->set_flashdata('attempt', 'success');
			redirect('login');
		}else{
			$this->session->set_flashdata('attempt', 'gagal');
			redirect('register');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}