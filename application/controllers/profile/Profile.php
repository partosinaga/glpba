<?php defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('profile/M_profile');

		$this->load->helper('url');
	}
	public function view_profile(){
		$user = $this->input->get('id');
		$data['page'] = 'profile/view_profile';
		
		$data['user'] = $this->M_profile->view_profile($user);
		$this->load->view('template/template', $data);
	}
}