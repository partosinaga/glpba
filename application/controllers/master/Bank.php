<?php defined('BASEPATH') OR exit('No direct script access allowed');

class bank extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('master/M_bank');

		$this->load->helper('url');
        
    }

	public function view_bank(){
		
		$data['page']='master/view_bank';
		$data['bank'] = $this->M_bank->get_bank();
		//get form  table currency
		$data['getCurr']= $this->db->get('currency');
		$this->load->view('template/template', $data);
	}

	public function add_bank(){
		$bank_id = $this->input->post('bank_id');
		$name = $this->input->post('name');
		$account_code = $this->input->post('account_code');
		$currency = $this->input->post('currency');
		$start_date = $this->input->post('start_date');
		$begining_balance = $this->input->post('begining_balance');

		$data1 = $this->M_bank->cek_account_code_coa($account_code);
		$data2 = $this->M_bank->cek_account_code_bank($bank_id);
		if (count($data1) > 0) {
			$this->session->set_flashdata('error', 'Account code have been Used');
		} elseif (count($data2) > 0) {
			$this->session->set_flashdata('error', 'Bank ID have been Used');
		} else {
			$data = array(
			'bank_id'=> $bank_id,
			'name' => $name,
			'account_code' => $account_code,
			'currency' => $currency,
			'start_date' => $start_date,
			'begining_balance' => $begining_balance,
			);

			$this->M_bank->add_bank($data, 'bank');
		 	$this->session->set_flashdata('success', 'ADDED');
		}
		redirect('master/bank/view_bank');
	}

	public function delete_bank($account_code){
		$this->db->where('account_code', $account_code);
		$this->db->delete('bank');
		$this->session->set_flashdata('success', 'DELETED');
		redirect('master/bank/view_bank');
	}

	public function edit_bank($id){
		$data['page'] = 'master/edit_bank';
		$data['bank'] = $this->M_bank->get_bank();
		$data['editBank']= $this->M_bank->edit_bank($id);
		//get form  table currency
		$data['getCurr']= $this->db->get('currency');
		$this->load->view('template/template', $data);
	}

	public function save_edit(){
		$id = $this->input->post('id');
		$bank_id = $this->input->post('bank_id');
		$name = $this->input->post('name');
		$account_code = $this->input->post('account_code');
		$currency = $this->input->post('currency');
		$start_date = $this->input->post('start_date');
		$begining_balance = $this->input->post('begining_balance');


			$data = array (
			'bank_id' => $bank_id,
			'name' => $name,
			'account_code' => $account_code,
			'currency' => $currency,
			'start_date' => $start_date,
			'begining_balance' => $begining_balance,
			);


		$this->M_bank->save_edit($id, $bank_id, $name, $account_code, $currency, $start_date, $begining_balance);
		$this->session->set_flashdata('success', 'UPDATED');
	
		
		redirect('master/bank/view_bank');
	}

}
