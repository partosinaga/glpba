<?php defined('BASEPATH') OR exit('No direct script access allowed');

class tutup_tahun extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('close_year/M_close_year');
	$this->load->helper('url');
	}


	public function close_year_form(){
		$data['page'] = 'close_year/close_year';

		$this->load->view('template/template', $data);
	}

	public function close(){
		$this->M_close_year->close_year();

		$this->session->set_flashdata('success', 'Closed Success!');
		redirect('close_year/close_year/close_year_form');
	}


}
?>