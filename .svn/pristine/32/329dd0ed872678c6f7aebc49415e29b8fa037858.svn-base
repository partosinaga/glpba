<?php defined('BASEPATH') OR exit('No direct script access allowed');

class begbal extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('master/M_begbal');

		$this->load->helper('url');
        
    }

	public function view_begbal(){
		$data['page']='master/view_begbal';
		$data['begbal'] = $this->M_begbal->get_begbal();
		$this->load->view('template/template', $data);
	}

	public function set_drcr(){
		$coa_id = $this->input->post('coa_id');
		$debit = $this->input->post('debit');
		$credit = $this->input->post('credit');

		for ($i= 0; $i < count($coa_id); $i++){ 
			$query = " update coa set debit = ".$debit[$i]." , credit = ".$credit[$i]." 
			where coa_id = '".$coa_id[$i]."';  ";
			$this->db->query($query);
		}
		 $this->session->set_flashdata('success', 'UPDATED');

		redirect('master/begbal/view_begbal');

	}

	

}
