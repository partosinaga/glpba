<?php defined('BASEPATH') OR exit('No direct script access allowed');

class profit_loss extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('profit_loss/M_profit_loss');

		$this->load->helper('url');
	}

	public function profit_loss_form(){
		$data['page'] = 'profit_loss/profit_loss_form';
		$this->load->view('template/template', $data);
	}

	public function view_pl(){
		$date = $this->input->get('periode');//your given date

		// get selected year
		$yearOnly=substr($date,0,4);
		$yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN

		$first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
		$date_from = date("Y-m-d",$first_date_find)."<br>";

		$last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
		$date_to = date("Y-m-d",$last_date_find);


		$data['income'] = $this->M_profit_loss->get_income($date_from, $date_to);
		$data['expense'] = $this->M_profit_loss->get_expense($date_from, $date_to);
		$data['sumIncome'] = $this->M_profit_loss->sum_income($date_from, $date_to);
		$data['sumExpense'] = $this->M_profit_loss->sum_expense($date_from, $date_to);

		
		// $data['otherIncome'] = $this->M_profit_loss->other_income($date_from, $date_to);
		// $data['sumOtherIncome'] = $this->M_profit_loss->sum_other_income($date_from, $date_to);
		// $data['otherExpense'] = $this->M_profit_loss->other_expense($date_from, $date_to);
		// $data['sumOtherExpense'] = $this->M_profit_loss->sum_other_expense($date_from, $date_to);

		// $data['otherExpense2'] = $this->M_profit_loss->other_expense2($date_from, $date_to);
		// $data['sumOtherExpense2'] = $this->M_profit_loss->sum_other_expense2($date_from, $date_to);


		$data['prevIncome'] = $this->M_profit_loss->get_prevIncome($yy, $date_to);
		$data['sumPrevIncome'] = $this->M_profit_loss->sum_prevIncome($yy, $date_to);
		$data['prevExpense'] = $this->M_profit_loss->get_prevExpense($yy, $date_to);
		$data['sumPrevExpense'] = $this->M_profit_loss->sum_prevExpense($yy, $date_to);

		$data['coaOiOe'] = $this->M_profit_loss->get_coa_Oi_Oe();
		$data['otherInEx'] = $this->M_profit_loss->other_in_ex($date_from, $date_to);
		$data['prevOtherInEx'] = $this->M_profit_loss->prev_other_in_ex($yy, $date_to);

		$data['rica'] = $this->M_profit_loss->rica($date_from, $date_to);
		$data['prevRica'] = $this->M_profit_loss->prev_rica($yy, $date_to);


		$data['SumOtherInEx'] = $this->M_profit_loss->sum_other_in_ex($date_from, $date_to);
		$data['SumPrevOtherInEx'] = $this->M_profit_loss->sum_prev_other_in_ex($yy, $date_to);

		// $data['prevOtherIncome'] = $this->M_profit_loss->prev_other_income($date_to);
		// $data['sumPrevOtherIncome'] = $this->M_profit_loss->sum_prev_other_income($date_to);
		

		// $data['prevOtherExpense'] = $this->M_profit_loss->prev_other_expense($date_to);

		
		$data['periode'] = $date;
		$this->load->view('profit_loss/view_pl', $data);
	}

	public function export(){
		$date = $this->input->get('id');//your given date
		// get selected year
		$yearOnly=substr($date,0,4);
		$yy = $yearOnly.'-01-01'."<br>";//TO LABA RUGI TAHUN BERJALAN

		$first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
		$date_from = date("Y-m-d",$first_date_find)."<br>";

		$last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
		$date_to = date("Y-m-d",$last_date_find);


		$data['income'] = $this->M_profit_loss->get_income($date_from, $date_to);
		$data['expense'] = $this->M_profit_loss->get_expense($date_from, $date_to);
		$data['sumIncome'] = $this->M_profit_loss->sum_income($date_from, $date_to);
		$data['sumExpense'] = $this->M_profit_loss->sum_expense($date_from, $date_to);


		// $data['otherIncome'] = $this->M_profit_loss->other_income($date_from, $date_to);
		// $data['sumOtherIncome'] = $this->M_profit_loss->sum_other_income($date_from, $date_to);
		// $data['otherExpense'] = $this->M_profit_loss->other_expense($date_from, $date_to);
		// $data['sumOtherExpense'] = $this->M_profit_loss->sum_other_expense($date_from, $date_to);

		// $data['otherExpense2'] = $this->M_profit_loss->other_expense2($date_from, $date_to);
		// $data['sumOtherExpense2'] = $this->M_profit_loss->sum_other_expense2($date_from, $date_to);


		$data['prevIncome'] = $this->M_profit_loss->get_prevIncome($yy, $date_to);
		$data['sumPrevIncome'] = $this->M_profit_loss->sum_prevIncome($yy, $date_to);
		$data['prevExpense'] = $this->M_profit_loss->get_prevExpense($yy, $date_to);
		$data['sumPrevExpense'] = $this->M_profit_loss->sum_prevExpense($yy, $date_to);

		$data['coaOiOe'] = $this->M_profit_loss->get_coa_Oi_Oe();
		$data['otherInEx'] = $this->M_profit_loss->other_in_ex($date_from, $date_to);
		$data['prevOtherInEx'] = $this->M_profit_loss->prev_other_in_ex($yy, $date_to);

		$data['rica'] = $this->M_profit_loss->rica($date_from, $date_to);
		$data['prevRica'] = $this->M_profit_loss->prev_rica($yy, $date_to);


		$data['SumOtherInEx'] = $this->M_profit_loss->sum_other_in_ex($date_from, $date_to);
		$data['SumPrevOtherInEx'] = $this->M_profit_loss->sum_prev_other_in_ex($yy, $date_to);


		
		$data['periode'] = $date;
		$this->load->view('profit_loss/export', $data);
	}

}