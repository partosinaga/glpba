<?php defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('master/M_user');

		$this->load->helper('url');
        
    }

	public function view_user(){
		
		$data['page']='master/view_user';

		$data['user'] = $this->M_user->get_user();
		
		$this->load->view('template/template', $data);
	}

	public function add_user(){
		$user_id=$this->input->post('user_id');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$departemen=$this->input->post('departemen');
		$arentry=$this->input->post('arentry');
		$arpost=$this->input->post('arpost');
		$apentry=$this->input->post('apentry');
		$appost=$this->input->post('appost');
		$glentry=$this->input->post('glentry');
		$glpost=$this->input->post('glpost');
		$reportacc=$this->input->post('reportacc');
		$adminacc=$this->input->post('adminacc');

		$data = array (
			'user_id' => $user_id,
			'username' => $username,
			'password' => $password,
			'departemen' => $departemen,
			'AREntry' => $arentry,
			'ARPost' => $arpost,
			'APEntry' => $apentry,
			'APPost' => $appost,
			'GLEntry' => $glentry,
			'GLPost' => $glpost,
			'reportACC' => $reportacc,
			'adminACC' => $adminacc
			);

		$this->M_user->add_user($data, 'user');
		$this->session->set_flashdata('success', 'ADDED');

		redirect('master/user/view_user');
	}

	public function delete_user($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->delete('user');
		$this->session->set_flashdata('success', 'DELETED');

		redirect('admin/user_settings/user_settings');
	}	

	public function edit_user($user_id){
		$data['page']='master/edit_user';
		$data['user'] = $this->M_user->get_user();
		$data['editUser'] = $this->M_user->edit_user($user_id);
		$this->load->view('template/template', $data);
	}
	public function save_edit(){
		$user_id = $this->input->post('user_id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$departemen = $this->input->post('departemen');
		$arentry=$this->input->post('arentry');
		$arpost=$this->input->post('arpost');
		$apentry=$this->input->post('apentry');
		$appost=$this->input->post('appost');
		$glentry=$this->input->post('glentry');
		$glpost=$this->input->post('glpost');
		$reportacc=$this->input->post('reportacc');
		$adminacc=$this->input->post('adminacc');
		$data = array (
			'user_id' => $user_id,
			'username' => $username,
			'password' => $password,
			'departemen' => $departemen,
			'AREntry' => $arentry,
			'ARPost' => $arpost,
			'APEntry' => $apentry,
			'APPost' => $appost,
			'GLEntry' => $glentry,
			'GLPost' => $glpost,
			'reportACC' => $reportacc,
			'adminACC' => $adminacc
			);
		$this->M_user->save_edit($user_id, $username, $password, $departemen,$arentry,$arpost,$apentry,$appost,$glentry,$glpost,$reportacc,$adminacc);
		$this->session->set_flashdata('success', 'UPDATED');

		redirect('admin/user_settings/user_settings');


	}

}
