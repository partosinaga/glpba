<?php defined('BASEPATH') OR exit('No direct script access allowed');

class user_settings extends CI_Controller{
	function __Construct(){
	parent ::__construct();
    $this->load->library(array('import/PHPExcel','import/PHPExcel/IOFactory'));
	$this->load->model('admin/M_user_settings');
	$this->load->helper('url');
	}

	public function user_settings(){
		$data['page'] = 'admin/user_settings';
		$data['user'] = $this->M_user_settings->get_user();
		$this->load->view('template/template', $data);
	}

	public function log_login(){
		$data['page'] = 'admin/log_login';
		$uid = $this->session->userdata('user_id');
	
		$data['log'] = $this->M_user_settings->log_login($uid);
		$this->load->view('template/template', $data);

	}

	public function yuhu(){
		$data['page'] = 'yuhu';
		$this->load->view('template/template', $data);
 	}

    public function change_password(){
        $id = $this->input->post('username');
        $new_pass = $this->input->post('new');
        $this->M_user_settings->change_password($id, $new_pass);

        $this->session->set_flashdata('success', 'New Password Saved');
        redirect('home/dashboard');
    }

 	

}