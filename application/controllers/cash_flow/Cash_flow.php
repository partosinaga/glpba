<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cash_flow extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('cash_flow/M_cashflow');
        $this->load->helper('url');
    }

    public function cfd_form()
    {
        $data['page'] = 'cash_flow/v2/cfd_form';

        $this->load->view('template/template', $data);
    }

    public function view_cfd()
    {
        $date = $this->input->get('periode');

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d", $first_date_find);
        //to get minus 1 year from selected date.(for annual)
        $lastyear = strtotime ( '-1 year' , strtotime ( $date ) ) ;
        $prevYearStart = date ( 'Y' , $lastyear ).'-01-01';
        $prevYearEnd = date('Y', $lastyear).'-12-31';
        //end of to get minus 1 year from selected date.(for annual)
        $yearOnly = substr($date, 0, 4);
        $year = $yearOnly;
        $yearStart = $year.'-01-01';


        $data['account'] = $this->M_cashflow->get_detail_category();
        $data['monthly'] = $this->M_cashflow->get_monthly($date);
        $data['monthly_prev'] = $this->M_cashflow->get_monthly_prev($date_from);

        $data['total'] = $this->M_cashflow->get_total($yearStart, $date);
        $data['total_prev'] = $this->M_cashflow->get_total_prev($prevYearStart);

        $data['bgn'] =  $this->M_cashflow->get_cash_bank($date_from);
        $data['bgn_prev'] =  $this->M_cashflow->get_cash_bank_ytd($date);
//        echo $this->db->last_query();


        $data['PrevYearStart'] = $prevYearStart;
        $data['yearStart'] = $yearStart;
        $data['date_to'] = $date;
        $data['date_from'] = $date_from;
        $this->load->view('cash_flow/v2/view_cfd', $data);
    }

    public function breakdown_monthly(){
        $report_type = $this->uri->segment('4');
        $date_to = $this->uri->segment('5');
        $date_from = $this->uri->segment('6');
        $id_detail = $this->uri->segment('7');
        $account = $this->uri->segment('8');
        $newdate = strtotime ( 'first day of -1 month' , strtotime ( $date_to ) ) ;
        $prevPeriod = date ( 'Y-m-d' , $newdate );

        $data['coa'] = $this->M_cashflow->get_coa($id_detail);
        $data['current'] = $this->M_cashflow->get_current_month($date_to, $id_detail);
        $data['previous'] = $this->M_cashflow->get_prev_month($date_from, $id_detail);

        $data['periode'] = $date_to;
        $data['account'] = $account;

        $this->load->view('cash_flow/v2/breakdown_monthly', $data);
    }



    public function breakdown_total(){
        $report_type = $this->uri->segment('4');
        $date_to = $this->uri->segment('5');
        $yearStart = $this->uri->segment('6');
        $prevYearStart = $this->uri->segment('7');
        $id_detail = $this->uri->segment('8');
        $account = $this->uri->segment('9');

        $newdate = strtotime ( 'first day of -1 month' , strtotime ( $date_to ) ) ;
        $prevPeriod = date ( 'Y-m-d' , $newdate );

        $data['coa'] = $this->M_cashflow->get_coa($id_detail);
        $data['total'] = $this->M_cashflow->get_breakdown_total($yearStart, $date_to, $id_detail);
        $data['total_prev'] = $this->M_cashflow->get_breakdown_total_prev($prevYearStart, $id_detail);

        $data['periode'] = $date_to;
        $data['account'] = $account;

        $this->load->view('cash_flow/v2/breakdown_total', $data);
    }

    public function export()
    {
        $date = $this->input->get('id');

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d", $first_date_find);
        //to get minus 1 year from selected date.(for annual)
        $lastyear = strtotime ( '-1 year' , strtotime ( $date ) ) ;
        $prevYearStart = date ( 'Y' , $lastyear ).'-01-01';
        $prevYearEnd = date('Y', $lastyear).'-12-31';
        //end of to get minus 1 year from selected date.(for annual)
        $yearOnly = substr($date, 0, 4);
        $year = $yearOnly;
        $yearStart = $year.'-01-01';


        $data['account'] = $this->M_cashflow->get_detail_category();
        $data['monthly'] = $this->M_cashflow->get_monthly($date);
        $data['monthly_prev'] = $this->M_cashflow->get_monthly_prev($date_from);

        $data['total'] = $this->M_cashflow->get_total($yearStart, $date);
        $data['total_prev'] = $this->M_cashflow->get_total_prev($prevYearStart);

        $data['bgn'] =  $this->M_cashflow->get_cash_bank($date_from);
        $data['bgn_prev'] =  $this->M_cashflow->get_cash_bank_ytd($date);
//        echo $this->db->last_query();


        $data['PrevYearStart'] = $prevYearStart;
        $data['yearStart'] = $yearStart;
        $data['date_to'] = $date;
        $data['date_from'] = $date_from;
        $this->load->view('cash_flow/v2/export', $data);
    }
}