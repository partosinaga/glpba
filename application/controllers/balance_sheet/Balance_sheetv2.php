<?php defined('BASEPATH') OR exit('No direct script access allowed');

class balance_sheetv2 extends CI_Controller{
    function __Construct(){
        parent ::__construct();
        //$this->load->model('ap/M_ap');
        $this->load->model('balance_sheet/M_balance_sheetv2');

        $this->load->helper('url');
    }

    public function bs_form(){
        $data['page'] = 'balance_sheet/v2/bs_formv2';

        $this->load->view('template/template', $data);
    }
    public function view_bs(){
        $periode = $this->input->get('periode');

       // get selected year
        $yearOnly=substr($periode,0,4);
        $yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN
        $tld = ($yearOnly-1).'-12-31'."<br>";//TO GET PREV YEAR FOR LABADITAHAN
        // get dat from and date to
        $first_date_find = strtotime(date("Y-m-d", strtotime($periode)) .",first day of this month");
        $date_from = date("Y-m-d",$first_date_find);
        $last_date_find = strtotime(date("Y-m-d", strtotime($periode)) . ",last day of this month");
        $date_to = date("Y-m-d",$last_date_find);

        $data['account'] = $this->M_balance_sheetv2->get_account();
        //THIS MONTH
        $data['current'] = $this->M_balance_sheetv2->get_current($date_to);
        //PREVIOUS MONTH
        $data['previous'] = $this->M_balance_sheetv2->get_previous($date_from);


        //GET LABA DITAHAN
        $data['LDI5'] = $this->M_balance_sheetv2->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_balance_sheetv2->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_balance_sheetv2->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_balance_sheetv2->LD_expense_akun802($tld);

        // LABA RUGI BERJALAN
        $data['LRI5'] = $this->M_balance_sheetv2->LR_income_akun5($yy,$date_to);
        $data['LRI8'] = $this->M_balance_sheetv2->LR_income_akun8($yy,$date_to);
        $data['LRE7'] = $this->M_balance_sheetv2->LR_expense_akun7($yy, $date_to);
        $data['LRE802'] = $this->M_balance_sheetv2->LR_expense_akun802($yy, $date_to);

        // PREVIOUS LABA RUGI BERJALAN
        $data['PLRI5'] = $this->M_balance_sheetv2->PLR_income_akun5($yy,$date_from);
        $data['PLRI8'] = $this->M_balance_sheetv2->PLR_income_akun8($yy,$date_from);
        $data['PLRE7'] = $this->M_balance_sheetv2->PLR_expense_akun7($yy, $date_from);
        $data['PLRE802'] = $this->M_balance_sheetv2->PLR_expense_akun802($yy, $date_from);



        $data['dateFrom'] = $date_from;
        $data['dateTo'] = $date_to;
        $data['periode'] = $periode;
        $this->load->view('balance_sheet/v2/view_bsv2', $data);
    }

    public function breakdown(){
        $period = $this->uri->segment('4');
        $id_detail = $this->uri->segment('5');
        $account = $this->uri->segment('6');

        $data['rowData'] = $this->M_balance_sheetv2->get_breakdown($id_detail, $period);
        $data['rowTotal'] = $this->M_balance_sheetv2->total_breakdown($id_detail, $period);

        $data['period'] = $period;
        $data['account'] = $account;
        $this->load->view('balance_sheet/v2/breakdownv2', $data);
    }

    public function breakdownPrev(){
        $period = $this->uri->segment('4');
        $id_detail = $this->uri->segment('5');
        $account = $this->uri->segment('6');

        $data['rowData'] = $this->M_balance_sheetv2->get_breakdownPrev($id_detail, $period);
        $data['rowTotal'] = $this->M_balance_sheetv2->total_breakdownPrev($id_detail, $period);

        //GET PREVIOUS MONTH
        $newdate = strtotime ( '-1 month' , strtotime ( $period ) ) ;
        $newdate = date ( 'M-Y' , $newdate );

        $data['period'] = $newdate;
        $data['account'] = $account;
        $this->load->view('balance_sheet/v2/breakdownv2', $data);
    }
    //NOTED!!
    //breakdown laba ditahan, breakdown laba rugi berjalan, breakdown laba rugi previous menggunakan 1 file view.

    public function breakdownLabaDitahan(){
        $period = $this->uri->segment('4');
        $id_detail = $this->uri->segment('5');
        $account = $this->uri->segment('6');

        $yearOnly=substr($period,0,4);

        $tld = ($yearOnly-1).'-12-31';//TO GET PREV YEAR FOR LABADITAHAN
        $data['LDI5'] = $this->M_balance_sheetv2->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_balance_sheetv2->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_balance_sheetv2->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_balance_sheetv2->LD_expense_akun802($tld);

        //1. GET JUMLAH YANG SUDAH ADA PADA LABADITAHAN
        $data['rowData'] = $this->M_balance_sheetv2->get_breakdown($id_detail, $period);
        $data['rowTotal'] = $this->M_balance_sheetv2->total_breakdown($id_detail, $period);
        //2. HITUNG LABA DITAHAN
        $data['LDI5'] = $this->M_balance_sheetv2->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_balance_sheetv2->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_balance_sheetv2->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_balance_sheetv2->LD_expense_akun802($tld);

        $inc = $data['LDI5']->ldi5 +  $data['LDI8']->ldi8;
        $exp = $data['LDE7']->lde7 + $data['LDE802']->lde802;
        $labaDitahan = $inc - $exp;

        $data['balance'] = $labaDitahan;
        $data['period'] = $period;
        $data['account'] = $account;
        $this->load->view('balance_sheet/v2/breakdown_labaditahanv2', $data);
    }

    public function breakdownLabaBerjalan(){
        $period = $this->uri->segment('4');
        $id_detail = $this->uri->segment('5');
        $account = $this->uri->segment('6');
        // get selected year
        $yearOnly=substr($period,0,4);
        $yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN
        $tld = ($yearOnly-1).'-12-31'."<br>";//TO GET PREV YEAR FOR LABADITAHAN
        // get dat from and date to
        $last_date_find = strtotime(date("Y-m-d", strtotime($period)) . ",last day of this month");
        $date_to = date("Y-m-d",$last_date_find);
        //get coanya. KOLOM DEBIT DI UBAH AS BALANCE UNTUK MEMBUAT LABADITAHAN DAN LABA BERJALAN SATU FILE VIEW!!!
        $data['rowData'] = $this->M_balance_sheetv2->get_laba_berjalan_coa($id_detail);

        // to get laba/rugi tahun berjalan
        $data['LRI5'] = $this->M_balance_sheetv2->LR_income_akun5($yy,$date_to);
        $data['LRI8'] = $this->M_balance_sheetv2->LR_income_akun8($yy,$date_to);
        $data['LRE7'] = $this->M_balance_sheetv2->LR_expense_akun7($yy, $date_to);
        $data['LRE802'] = $this->M_balance_sheetv2->LR_expense_akun802($yy, $date_to);


        $inc = $data['LRI5']->lri5 + $data['LRI8']->lri8;
        $exp = $data['LRE7']->lre7 + $data['LRE802']->lre802;
        $labaBerjalan = $inc - $exp;


        $data['balance'] = $labaBerjalan;
        $data['period'] = $period;
        $data['account'] = $account;
        $this->load->view('balance_sheet/v2/breakdown_labaditahanv2', $data);
    }

    public function breakdownLabaBerjalanPrev(){
        $period = $this->uri->segment('4');
        $id_detail = $this->uri->segment('5');
        $account = $this->uri->segment('6');
        // get selected year
        $yearOnly=substr($period,0,4);
        $yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN
        $tld = ($yearOnly-1).'-12-31'."<br>";//TO GET PREV YEAR FOR LABADITAHAN
        // get dat from and date to
        $first_date_find = strtotime(date("Y-m-d", strtotime($period)) .",first day of this month");
        $date_from = date("Y-m-d",$first_date_find);
        //GET PREVIOUS MONTH
        $newdate = strtotime ( '-1 month' , strtotime ( $period ) ) ;
        $newdate = date ( 'M-Y' , $newdate );

        //get coanya. KOLOM DEBIT DI UBAH AS BALANCE UNTUK MEMBUAT LABADITAHAN DAN LABA BERJALAN SATU FILE VIEW!!!
        $data['rowData'] = $this->M_balance_sheetv2->get_laba_berjalan_coa($id_detail);

        $data['PLRI5'] = $this->M_balance_sheetv2->PLR_income_akun5($yy,$date_from);
        $data['PLRI8'] = $this->M_balance_sheetv2->PLR_income_akun8($yy,$date_from);
        $data['PLRE7'] = $this->M_balance_sheetv2->PLR_expense_akun7($yy, $date_from);
        $data['PLRE802'] = $this->M_balance_sheetv2->PLR_expense_akun802($yy, $date_from);

        $inc = $data['PLRI5']->plri5 + $data['PLRI8']->plri8;
        $exp = $data['PLRE7']->plre7 + $data['PLRE802']->plre802;
        $labaBerjalan = $inc - $exp;


        $data['balance'] = $labaBerjalan;
        $data['period'] = $newdate;
        $data['account'] = $account;
        $this->load->view('balance_sheet/v2/breakdown_labaditahanv2', $data);
    }
    // END OF NOTED!!


    public function export(){
        $periode = $this->input->get('id');

        // get selected year
        $yearOnly=substr($periode,0,4);
        $yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN
        $tld = ($yearOnly-1).'-12-31'."<br>";//TO GET PREV YEAR FOR LABADITAHAN
        // get dat from and date to
        $first_date_find = strtotime(date("Y-m-d", strtotime($periode)) .",first day of this month");
        $date_from = date("Y-m-d",$first_date_find);
        $last_date_find = strtotime(date("Y-m-d", strtotime($periode)) . ",last day of this month");
        $date_to = date("Y-m-d",$last_date_find);

        $data['account'] = $this->M_balance_sheetv2->get_account();
        //THIS MONTH
        $data['current'] = $this->M_balance_sheetv2->get_current($date_to);
        //PREVIOUS MONTH
        $data['previous'] = $this->M_balance_sheetv2->get_previous($date_from);


        //GET LABA DITAHAN
        $data['LDI5'] = $this->M_balance_sheetv2->LD_income_akun5($tld);
        $data['LDI8'] = $this->M_balance_sheetv2->LD_income_akun8($tld);
        $data['LDE7'] = $this->M_balance_sheetv2->LD_expense_akun7($tld);
        $data['LDE802'] = $this->M_balance_sheetv2->LD_expense_akun802($tld);

        // LABA RUGI BERJALAN
        $data['LRI5'] = $this->M_balance_sheetv2->LR_income_akun5($yy,$date_to);
        $data['LRI8'] = $this->M_balance_sheetv2->LR_income_akun8($yy,$date_to);
        $data['LRE7'] = $this->M_balance_sheetv2->LR_expense_akun7($yy, $date_to);
        $data['LRE802'] = $this->M_balance_sheetv2->LR_expense_akun802($yy, $date_to);

        // PREVIOUS LABA RUGI BERJALAN
        $data['PLRI5'] = $this->M_balance_sheetv2->PLR_income_akun5($yy,$date_from);
        $data['PLRI8'] = $this->M_balance_sheetv2->PLR_income_akun8($yy,$date_from);
        $data['PLRE7'] = $this->M_balance_sheetv2->PLR_expense_akun7($yy, $date_from);
        $data['PLRE802'] = $this->M_balance_sheetv2->PLR_expense_akun802($yy, $date_from);



        $data['dateFrom'] = $date_from;
        $data['dateTo'] = $date_to;
        $data['periode'] = $periode;
        $this->load->view('balance_sheet/v2/exportv2', $data);
    }


}