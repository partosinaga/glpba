<?php defined('BASEPATH') OR exit('No direct script access allowed');

class unclose_month extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	//$this->load->model('ap/M_ap');
	$this->load->model('unclose_month/M_unclose_month');

		$this->load->helper('url');
		
	}

	public function unclose_month_form(){
		$data['page'] = 'unclose_month/unclose_month_form';
		$data['unclose'] = $this->M_unclose_month->unclose_month();
		$data['last'] = $this->M_unclose_month->get_last();
		$this->load->view('template/template', $data);
	}

	public function unclose(){
		$period = $this->input->post('period');
		$year=substr($period,0,4);
		$month=substr($period,5,4);
		
		//delete closed saldo
		$this->M_unclose_month->delete_closed_saldo($month, $year);
		//update Fmonth ar/ap/jv
		$this->M_unclose_month->update_ar($month, $year);
		$this->M_unclose_month->update_ap($month, $year);
		$this->M_unclose_month->update_jv($month, $year);
		//update Fclose gl_header
		$this->M_unclose_month->update_Fclose($month, $year);



		$this->session->set_flashdata('success', 'Success unclose ' .$period.'!');
		redirect('unclose_month/unclose_month/unclose_month_form');
	}

}