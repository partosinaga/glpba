<?php defined('BASEPATH') OR exit('No direct script access allowed');

class close_month extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	//$this->load->model('ap/M_ap');
	$this->load->model('close_month/M_close_month');
	$this->load->model('close_year/M_close_year');

		$this->load->helper('url');
		
	}
	
	public function close_month_form(){
		$data['page'] = 'close_month/close_month_form';
		$this->load->view('template/template', $data);
	}

	public function close_month(){
		 $period = $this->input->post('period');
		

		$year=substr($period,0,4);
		$month=substr($period,5,5);

		//validate ever or no closed
		$valid = $this->M_close_month->validate($month, $year);
		if (count($valid) > 0) {
		 	$this->session->set_flashdata('error', 'Failed, '.$period.' have been closed!');
		} else {
		 	//insert saldo coa
			$this->M_close_month->closed_saldo($month, $year);
			//update status Fmonth in AR/AP/JV
			$this->M_close_month->closed_ar($month, $year);
			$this->M_close_month->closed_ap($month, $year);
			$this->M_close_month->closed_jv($month, $year);
			$this->M_close_month->closed_gl($month, $year);
			
			$this->session->set_flashdata('success', 'Success close '. $period.'!');
		}
		  		
		
		redirect('close_month/close_month/close_month_form');
	} 
	
	
	public function close_year_form(){
		$data['page'] = 'close_year/close_year';

		$this->load->view('template/template', $data);
	}

	public function close(){
		$this->M_close_year->close_year();

		$this->session->set_flashdata('success', 'Closed Success!');
		redirect('close_month/close_month/close_year_form');
	}

}