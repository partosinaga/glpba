<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bsd extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        //$this->load->model('ap/M_ap');
        $this->load->model('balance_sheet/M_bsd');

        $this->load->helper('url');
    }

    public function bsd_form()
    {
        $data['page'] = 'balance_sheet/daily/bs_form';
        $this->load->view('template/template', $data);
    }

    public function view_bsd()
    {
        'date' . $date = $this->input->get('periode');

        $yearOnly = substr($date, 0, 4);
       echo 'tld' . $tld = ($yearOnly - 1) . '-12-31';
        // get selected year
        $yearOnly = substr($date, 0, 4);
        'yy ' . $yy = $yearOnly . '-01-01' . "<br>";

        $data['assets'] = $this->M_bsd->get_assets($date);
        $data['total_assets'] = $this->M_bsd->total_assets($date);

        $data['liabilities'] = $this->M_bsd->get_liabilities($date);
        $data['total_liabilities'] = $this->M_bsd->total_liabilities($date);

        // to get laba ditahan
        $data['LDI5'] = $this->M_bsd->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_bsd->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_bsd->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_bsd->LD_expense_akun802($tld);

        // to get laba/rugi tahun berjalan
        $data['LRI5'] = $this->M_bsd->LR_income_akun5($yy, $date);
//        echo $this->db->last_query()."<br>";
        $data['LRI8'] = $this->M_bsd->LR_income_akun8($yy, $date);
        $data['LRE7'] = $this->M_bsd->LR_expense_akun7($yy, $date);
        $data['LRE802'] = $this->M_bsd->LR_expense_akun802($yy, $date);
        $data['periode'] = $date;
        $this->load->view('balance_sheet/daily/view_bsd', $data);
    }

    public function export()
    {
        $date = $this->input->get('id');

        $yearOnly = substr($date, 0, 4);
        $tld = ($yearOnly - 1).'-12-31';
        // get selected year
        $yearOnly = substr($date, 0, 4);
        $yy = $yearOnly .'-01-01';

        $data['assets'] = $this->M_bsd->get_assets($date);
        $data['total_assets'] = $this->M_bsd->total_assets($date);

        $data['liabilities'] = $this->M_bsd->get_liabilities($date);
        $data['total_liabilities'] = $this->M_bsd->total_liabilities($date);

        // to get laba ditahan
        $data['LDI5'] = $this->M_bsd->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_bsd->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_bsd->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_bsd->LD_expense_akun802($tld);

        // to get laba/rugi tahun berjalan
        $data['LRI5'] = $this->M_bsd->LR_income_akun5($yy, $date);
//        echo $this->db->last_query()."<br>";
        $data['LRI8'] = $this->M_bsd->LR_income_akun8($yy, $date);
        $data['LRE7'] = $this->M_bsd->LR_expense_akun7($yy, $date);
        $data['LRE802'] = $this->M_bsd->LR_expense_akun802($yy, $date);
        $data['periode'] = $date;
        $this->load->view('balance_sheet/daily/export', $data);
    }

}