<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cfd extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('cash_flow/M_cfd');
        $this->load->model('cash_flow/M_cashflow');
        $this->load->helper('url');
    }

    public function cfd_form()
    {
        $data['page'] = 'cash_flow/daily/cfd_form';

        $this->load->view('template/template', $data);
    }

    public function view_cfd()
    {
        $date = $this->input->get('periode');

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d",$first_date_find)."<br>";
        $yearOnly = substr($date, 0, 4);
        $yearStart = $yearOnly.'-01-01';
        $lastyear = strtotime ( '-1 year' , strtotime ( $date ) ) ;
        $prevYearStart = date ( 'Y' , $lastyear ).'-01-01';

        $data['coa'] = $this->M_cfd->get_coa();
        $data['monthly'] = $this->M_cfd->get_monthly($date);
        $data['monthlyPrev'] = $this->M_cfd->get_monthly_prev($date_from);

        $data['ytd'] = $this->M_cfd->get_total($yearStart, $date);
        $data['ytdPrev'] = $this->M_cfd->get_total_prev($prevYearStart);

        $data['bgn'] =  $this->M_cashflow->get_cash_bank($date_from);
        $data['bgn_prev'] =  $this->M_cashflow->get_cash_bank_ytd($date);

        $data['periode'] = $date;
        $this->load->view('cash_flow/daily/view_cfd', $data);
    }

    public function export()
    {
        $date = $this->input->get('id');

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d",$first_date_find)."<br>";
        $yearOnly = substr($date, 0, 4);
        $yearStart = $yearOnly.'-01-01';
        $lastyear = strtotime ( '-1 year' , strtotime ( $date ) ) ;
        $prevYearStart = date ( 'Y' , $lastyear ).'-01-01';

        $data['coa'] = $this->M_cfd->get_coa();
        $data['monthly'] = $this->M_cfd->get_monthly($date);
        $data['monthlyPrev'] = $this->M_cfd->get_monthly_prev($date_from);

        $data['ytd'] = $this->M_cfd->get_total($yearStart, $date);
        $data['ytdPrev'] = $this->M_cfd->get_total_prev($prevYearStart);

        $data['bgn'] =  $this->M_cashflow->get_cash_bank($date_from);
        $data['bgn_prev'] =  $this->M_cashflow->get_cash_bank_ytd($date);

        $data['periode'] = $date;
        $this->load->view('cash_flow/daily/export', $data);
    }

}