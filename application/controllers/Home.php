<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __Construct(){
	parent ::__construct();
	$this->load->model('dashboard/M_dashboard');
	$this->load->helper('url');
	} 

	public function dashboard(){
		if($this->session->userdata('username') == null){
            redirect('home');
        }

        $user = $this->session->userdata('user_id');
 

		$data['page']='template/dashboard';
		$data['ar'] = $this->M_dashboard->get_ar();
		$data['ap'] = $this->M_dashboard->get_ap();
		$data['jv'] = $this->M_dashboard->get_jv();

		// GET REMINDER
		$m = date("m", strtotime("-1 months"));
		$y = date("Y");
		$data['current'] = $this->M_dashboard->get_current($m, $y);

		$data['logged'] = $this->M_dashboard->get_log($user);


		$this->load->view('template/template', $data);
	}
	public function index()
	{
		$this->load->view('login/form_login');
	}

	public function valid_login(){
		
		$us = $this->input->post('username');
		$ps = $this->input->post('password');
		
		$this->db->where('username', $us);	//nama kolom username pada form
		$this->db->where('password', $ps);	//nama kolom password pada form
		$akun = $this->db->get('user');
		if ($akun->num_rows() >0){ 
			
			$logindata = array(
				'user_id' => $akun->result_array()[0]['user_id'],
				'username'  => $us,
				'password'  => $akun->result_array()[0]['password'],
				'departemen'     => $akun->result_array()[0]['departemen'],
				'AREntry'     => $akun->result_array()[0]['AREntry'],
				'ARPost'     => $akun->result_array()[0]['ARPost'],
				'APEntry'     => $akun->result_array()[0]['APEntry'],
				'APPost'     => $akun->result_array()[0]['APPost'],
				'GLEntry'     => $akun->result_array()[0]['GLEntry'],
				'GLPost'     => $akun->result_array()[0]['GLPost'],
				'reportACC'     => $akun->result_array()[0]['reportACC'],
				'adminACC'     => $akun->result_array()[0]['adminACC'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($logindata);
			// to add log_login table
			$user_id = $akun->result_array()[0]['user_id'];
			$date = date('d-m-Y'). ' / ' . date('H;i;sa');
			$data = array('user_id' => $user_id,
							'date_time' => $date
							 );
			$this->M_dashboard->add_log($data, 'log_login');

			redirect('home/dashboard');

			} else { 
			redirect ('home/index');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}
}
