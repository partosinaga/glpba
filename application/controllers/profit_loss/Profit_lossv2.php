<?php defined('BASEPATH') OR exit('No direct script access allowed');

class profit_lossv2 extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('profit_loss/M_profit_lossv2');

        $this->load->helper('url');
    }

    public function profit_loss_form()
    {
        $data['page'] = 'profit_loss/v2/profit_loss_formv2';
        $this->load->view('template/template', $data);
    }

    public function view_pl()
    {
        $date = $this->input->get('periode');//your given date

        // get selected year
        $yearOnly = substr($date, 0, 4);
        $yy = $yearOnly . '-01-01';

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d", $first_date_find);

        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
        $date_to = date("Y-m-d", $last_date_find);


        $data['account'] = $this->M_profit_lossv2->get_account();
        $data['yearToMonth'] = $this->M_profit_lossv2->get_ytm($date_from, $date_to);
        $data['yearToDate'] = $this->M_profit_lossv2->get_ytd($yy, $date_to);
//        $this->db->last_query();
        $data['yearStart'] = $yy;
        $data['dateFrom'] = $date_from;
        $data['dateTo'] = $date_to;
        $data['periode'] = $date;
        $this->load->view('profit_loss/v2/view_plv2', $data);
    }

    public function breakdown()
    {
        $id_detail = $this->uri->segment('4');
        $date_from = $this->uri->segment('5');
        $date_to = $this->uri->segment('6');
        $account = $this->uri->segment('7');

        $data['transaction'] = $this->M_profit_lossv2->get_breakdown($id_detail, $date_from, $date_to);

        $data['account'] = $account;
        $data['period'] = $date_from;
        $this->load->view('profit_loss/v2/breakdownv2', $data);
    }

    public function breakdownYtd()
    {
        $id_detail = $this->uri->segment('4');
        $date_to = $this->uri->segment('5');
        $yy = $this->uri->segment('6');
        $account = $this->uri->segment('7');

        $data['transaction'] = $this->M_profit_lossv2->get_breakdownYtd($id_detail,$yy,$date_to);
//        echo $this->db->last_query();
        $data['account'] = $account;
        $data['period'] = $date_to;
        $this->load->view('profit_loss/v2/breakdownv2', $data);
    }

    public function export()
    {
        $date = $this->input->get('id');//your given date

        // get selected year
        $yearOnly = substr($date, 0, 4);
        $yy = $yearOnly . '-01-01';

        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $date_from = date("Y-m-d", $first_date_find);

        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
        $date_to = date("Y-m-d", $last_date_find);


        $data['account'] = $this->M_profit_lossv2->get_account();
        $data['yearToMonth'] = $this->M_profit_lossv2->get_ytm($date_from, $date_to);
        $data['yearToDate'] = $this->M_profit_lossv2->get_ytd($date_to);
//        $this->db->last_query();
        $data['dateFrom'] = $date_from;
        $data['dateTo'] = $date_to;
        $data['periode'] = $date;
        $this->load->view('profit_loss/v2/exportv2', $data);
    }

}