<?php defined('BASEPATH') OR exit('No direct script access allowed');

class query_account extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	//$this->load->model('ap/M_ap');
	$this->load->model('query_account/M_query_account');

		$this->load->helper('url');
		
	}

	public function qa_form(){
		$data['page']='query_account/qa_form';
		$data['coaGL'] = $this->M_query_account->get_coaGl();
		$this->load->view('template/template', $data);
	}

	public function view_qa(){
		$coa_id = $this->input->post('coa_id');
		$module = $this->input->post('module');

		if ($this->input->post('module') == "AR") {
			$data['qaList'] = $this->M_query_account->view_qa_ar($coa_id, $module);
	
		} elseif ($this->input->post('module') == "AP") {
			$data['qaList'] = $this->M_query_account->view_qa_ap($coa_id, $module);
		} else {
			$data['qaList'] = $this->M_query_account->view_qa_jv($coa_id, $module);
		};
		
		$data['coa_id'] = $coa_id;
		$data['module'] = $module;

		$data['page']='query_account/view_qa';
		$this->load->view('template/template', $data);


	}
}