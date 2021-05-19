<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	function views($content, $data = NULL){
        $data['head'] = $this->load->view('layout/head', $data, TRUE);
        $data['sidebar'] = $this->load->view('layout/sidebar', $data, TRUE);
        $data['topbar'] = $this->load->view('layout/topbar', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', $data, TRUE);
        $data['js'] = $this->load->view('layout/js', $data, TRUE);
        
        $this->load->view('layout/template', $data);
    }
}

