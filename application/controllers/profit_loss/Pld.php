<?php defined('BASEPATH') OR exit('No direct script access allowed');

class pld extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('profit_loss/M_pld');
        $this->load->helper('url');
    }

    public function pld_form()
    {
        $data['page'] = 'profit_loss/daily/pld_form';
        $this->load->view('template/template', $data);
    }

    public function view_pld()
    {
        $date = $this->input->post('period');
        $data['income'] = $this->M_pld->get_income($date);
        $data['sum_income'] = $this->M_pld->sum_income($date);

        $data['expense'] = $this->M_pld->get_expense($date);
        $data['sum_expense'] = $this->M_pld->sum_expense($date);

        $data['other'] = $this->M_pld->other_in_ex($date);
        $data['sum_other'] = $this->M_pld->sum_other($date);

        $data['subtraction'] = $this->M_pld->subtraction($date);

        $data['period'] = $date;
        $this->load->view('profit_loss/daily/view_pld', $data);
    }

    public function export()
    {
        $date = $this->input->get('id');
        $data['income'] = $this->M_pld->get_income($date);
        $data['sum_income'] = $this->M_pld->sum_income($date);

        $data['expense'] = $this->M_pld->get_expense($date);
        $data['sum_expense'] = $this->M_pld->sum_expense($date);

        $data['other'] = $this->M_pld->other_in_ex($date);
        $data['sum_other'] = $this->M_pld->sum_other($date);

        $data['subtraction'] = $this->M_pld->subtraction($date);

        $data['period'] = $date;
        $this->load->view('profit_loss/daily/export', $data);
    }
}