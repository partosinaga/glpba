<?php defined('BASEPATH') OR exit('No direct script access allowed');

class bank_book extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	//$this->load->model('ap/M_ap');
	$this->load->model('bank_book/M_bank_book');

		$this->load->helper('url');
		
	}

	public function bank_book_form(){
		$data['page'] = 'bank_book/bank_book_form';
		$data['bank'] = $this->db->get('bank');
		$this->load->view('template/template', $data);
	}

	public function view_bb(){
		$period = $this->input->post('period');
		$account_code = $this->input->post('account_code');

		$data['bb'] = $this->M_bank_book->view_bb($period, $account_code);

		$data['bank_name'] = $this->M_bank_book->get_bank_name($account_code)->name;

		$data['account_code'] = $account_code;
		$data['period'] = $period;
		//$data['page'] = '';
		$this->load->view('bank_book/view_bb', $data);

	}
}