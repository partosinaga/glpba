<?php defined('BASEPATH') OR exit('No direct script access allowed');

class currency extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('master/M_currency');

		$this->load->helper('url');
        
    }

    public function view_currency(){
    	$data['page']='master/view_currency';
    	$data['curr']= $this->M_currency->get_currency(); 
    	$this->load->view('template/template', $data);
    }

	public function add_currency(){
		$curr_id = $this->input->post('curr_id');
		$curr_name = $this->input->post('curr_name');

		$data = array(
			'curr_id' => $curr_id,
			'curr_name' => $curr_name,
			);

		$this->M_currency->add_currency($data, 'currency');
		$this->session->set_flashdata('message', array('info', 'fa-check',  'SUCCESS', 'ADDED!'));

		redirect('master/currency/view_currency');
	}

	public function delete_currency($curr_id){
		$this->db->where('curr_id', $curr_id);
		$this->db->delete('currency');
		$this->session->set_flashdata('message', array('info', 'fa-check',  'SUCCESS', 'DELETED!'));

		redirect('master/currency/view_currency');
	}

	public function edit_currency($curr_id){
		$data['page'] = 'master/edit_currency';
    	$data['curr'] = $this->M_currency->get_currency(); 
		$data['editCurr'] = $this->M_currency->edit_currency($curr_id);
		$this->load->view('template/template', $data);
	}

	public function save_edit(){
		$curr_id = $this->input->post('curr_id');
		$curr_name = $this->input->post('curr_name');

		$data = array(
			'curr_id' => $curr_id,
			'cur_name' => $curr_name,
			);
		
		$this->M_currency->save_edit($curr_id, $curr_name);
		$this->session->set_flashdata('message', array('info', 'fa-check',  'SUCCESS', 'UPDATED!'));
		
		redirect('master/currency/view_currency');
	}

}
