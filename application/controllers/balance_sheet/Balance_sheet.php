<?php defined('BASEPATH') OR exit('No direct script access allowed');

class balance_sheet extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	//$this->load->model('ap/M_ap');
	$this->load->model('balance_sheet/M_balance_sheet');

		$this->load->helper('url');
	}

	public function balance_sheet_form(){
		$data['page'] = 'balance_sheet/balance_sheet_form';
		$this->load->view('template/template', $data);
	}

	public function view_bs(){
		$date = $this->input->post('periode');//your given date

		// get selected year
		$yearOnly=substr($date,0,4);
		$yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN

		'tld'. $tld = ($yearOnly-1).'-12-31';//TO GET PREV YEAR FOR LABADITAHAN
		
		$first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
		$date_from = date("Y-m-d",$first_date_find);

		$last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
		$date_to = date("Y-m-d",$last_date_find);


		$data['bsheetA'] = $this->M_balance_sheet->get_transA($date_to); //get each row
		$data['prev_month_asset'] = $this->M_balance_sheet->get_prev_asset($date_from);//previous month ASSET
		$data['total_asset'] = $this->M_balance_sheet->total_asset($date_to);//get total asset
		$data['total_prev_asset'] = $this->M_balance_sheet->total_prev_asset($date_from);//total prev asset


		$data['bsheetL'] = $this->M_balance_sheet->get_transL($date_to);//get each row liabiliti
		$data['prev_month_liab'] = $this->M_balance_sheet->get_prev_liab($date_from);// previous month LIABLITI
		$data['total_liabiliti'] = $this->M_balance_sheet->total_liabiliti($date_to);//get total liabiliti
		$data['total_prev_liabiliti'] = $this->M_balance_sheet->total_prev_liabiliti($date_from);//get total liabiliti

		// to get laba ditahan
		$data['LDI5'] = $this->M_balance_sheet->LD_income_akun5($tld);
		$data['LDI8'] = $this->M_balance_sheet->LD_income_akun8($tld);
		$data['LDE7'] = $this->M_balance_sheet->LD_expense_akun7($tld);
		$data['LDE802'] = $this->M_balance_sheet->LD_expense_akun802($tld);
		// $data['LDE900_999'] = $this->M_balance_sheet->LD_expense_akun900_999();

		// to get laba/rugi tahun berjalan
		$data['LRI5'] = $this->M_balance_sheet->LR_income_akun5($yy,$date_to);
		$data['LRI8'] = $this->M_balance_sheet->LR_income_akun8($yy,$date_to);
		$data['LRE7'] = $this->M_balance_sheet->LR_expense_akun7($yy, $date_to);
		$data['LRE802'] = $this->M_balance_sheet->LR_expense_akun802($yy, $date_to);
		// $data['LRE910_999'] = $this->M_balance_sheet->LR_expense_akun910_999($date_to);


		// to get PREVIOUS laba/rugi tahun berjalan
		$data['PLRI5'] = $this->M_balance_sheet->PLR_income_akun5($yy,$date_from);
		$data['PLRI8'] = $this->M_balance_sheet->PLR_income_akun8($yy,$date_from);
		$data['PLRE7'] = $this->M_balance_sheet->PLR_expense_akun7($yy,$date_from);
		$data['PLRE802'] = $this->M_balance_sheet->PLR_expense_akun802($yy,$date_from);
		// $data['PLRE910_999'] = $this->M_balance_sheet->PLR_expense_akun910_999($date_from);

		
		$data['periode'] = $date;

		$this->load->view('balance_sheet/view_bs', $data);
	}

	public function export(){

		$date = $this->input->get('id');//your given date


		// get selected year
		$yearOnly=substr($date,0,4);
		$yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN

		$tld = ($yearOnly-1).'-12-31'."<br>";//TO GET PREV YEAR FOR LABADITAHAN
		
		$first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
		$date_from = date("Y-m-d",$first_date_find)."<br>";

		$last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
		$date_to = date("Y-m-d",$last_date_find);


		$data['bsheetA'] = $this->M_balance_sheet->get_transA($date_to); //get each row
		$data['prev_month_asset'] = $this->M_balance_sheet->get_prev_asset($date_from);//previous month ASSET
		$data['total_asset'] = $this->M_balance_sheet->total_asset($date_to);//get total asset
		$data['total_prev_asset'] = $this->M_balance_sheet->total_prev_asset($date_from);//total prev asset


		$data['bsheetL'] = $this->M_balance_sheet->get_transL($date_to);//get each row liabiliti
		$data['prev_month_liab'] = $this->M_balance_sheet->get_prev_liab($date_from);// previous month LIABLITI
		$data['total_liabiliti'] = $this->M_balance_sheet->total_liabiliti($date_to);//get total liabiliti
		$data['total_prev_liabiliti'] = $this->M_balance_sheet->total_prev_liabiliti($date_from);//get total liabiliti

		// to get laba ditahan
		$data['LDI5'] = $this->M_balance_sheet->LD_income_akun5($tld);
		$data['LDI8'] = $this->M_balance_sheet->LD_income_akun8($tld);
		$data['LDE7'] = $this->M_balance_sheet->LD_expense_akun7($tld);
		$data['LDE802'] = $this->M_balance_sheet->LD_expense_akun802($tld);
		// $data['LDE900_999'] = $this->M_balance_sheet->LD_expense_akun900_999();

		// to get laba/rugi tahun berjalan
		$data['LRI5'] = $this->M_balance_sheet->LR_income_akun5($yy,$date_to);
		$data['LRI8'] = $this->M_balance_sheet->LR_income_akun8($yy,$date_to);
		$data['LRE7'] = $this->M_balance_sheet->LR_expense_akun7($yy, $date_to);
		$data['LRE802'] = $this->M_balance_sheet->LR_expense_akun802($yy, $date_to);
		// $data['LRE910_999'] = $this->M_balance_sheet->LR_expense_akun910_999($date_to);


		// to get PREVIOUS laba/rugi tahun berjalan
		$data['PLRI5'] = $this->M_balance_sheet->PLR_income_akun5($yy,$date_from);
		$data['PLRI8'] = $this->M_balance_sheet->PLR_income_akun8($yy,$date_from);
		$data['PLRE7'] = $this->M_balance_sheet->PLR_expense_akun7($yy,$date_from);
		$data['PLRE802'] = $this->M_balance_sheet->PLR_expense_akun802($yy,$date_from);
		// $data['PLRE910_999'] = $this->M_balance_sheet->PLR_expense_akun910_999($date_from);

		
		$data['periode'] = $date;
		
		$this->load->view('balance_sheet/export', $data);
	}

}
?>