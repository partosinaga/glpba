<?php defined('BASEPATH') OR exit('No direct script access allowed');

class trial_balance extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        //$this->load->model('ap/M_ap');
        $this->load->model('trial_balance/M_trial_balance');

        $this->load->helper('url');

    }

    public function tb_form()
    {
        $data['page'] = 'trial_balance/tb_form';
        $this->load->view('template/template', $data);
    }

    public function view_tb(){
        $this->benchmark->mark('code_start');
        $data['page'] = 'trial_balance/view_tb';

        $date = $this->input->get('periode');
        
        $yearOnly=substr($date,0,4);
        $year_start = $yearOnly.'-01-01'."<br>";//get year only

        $date_from = $date.'-01';
        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ",last day of this month");
        $date_to = date("Y-m-d",$last_date_find);


        $data['coa'] = $this->M_trial_balance->get_coa();
        $data['begining'] = $this->M_trial_balance->get_begining($date_from);
        $data['mutasi'] = $this->M_trial_balance->get_mutasi($date_from, $date_to);


        
        $data['t_begin']= count($data['begining']); //to count begining rows
        $data['t_mutasi']= count($data['mutasi']);//to count mutation rows

        $data['period'] = $date;
        $this->load->view('trial_balance/view_tb', $data);
        $this->benchmark->mark('code_end');

        
    }

    public function export()
    {
     

        $date = $this->input->get('id');
        
        $yearOnly=substr($date,0,4);
        $year_start = $yearOnly.'-01-01'."<br>";//get year only

        $date_from = $date.'-01';
        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ",last day of this month");
        $date_to = date("Y-m-d",$last_date_find);


         $data['coa'] = $this->M_trial_balance->get_coa();
        $data['begining'] = $this->M_trial_balance->get_begining($date_from);
        $data['mutasi'] = $this->M_trial_balance->get_mutasi($date_from, $date_to);


        
        $data['t_begin']= count($data['begining']); //to count begining rows
        $data['t_mutasi']= count($data['mutasi']);//to count mutation rows

        $data['period'] = $date;
        $this->load->view('trial_balance/export', $data);



    }

}