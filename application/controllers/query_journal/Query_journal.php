<?php defined('BASEPATH') OR exit('No direct script access allowed');

class query_journal extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('query_journal/M_query_journal');

		$this->load->helper('url');
		
	}

	public function view_qj(){
		$data['page'] = 'query_journal/view_qj';
		$data['getGl'] = $this->M_query_journal->get_all_transaction();
		$this->load->view('template/template', $data);
	}

	public function detail_gl(){
			if (isset($_POST["transaction_detail"])) 
			{
				$output = '';
          $id = $_POST["transaction_detail"];
          $data['header'] = $this->M_query_journal->get_header($id);
          $data['detail'] = $this->M_query_journal->get_detail($id);
				

				$output .= '
				<div class="">
					<table class="table table-striped table-bordered table-hover dataTable table-po-detail">';

				foreach($data['header'] as $row) {
					$output .= '
					 <div class="row">
                      <div class="col-md-3">
                        <label>VOUCHER NO.</label><br>
                        '.$row->gl_no.'
                      </div>

                      <div class="col-md-3">
                        <label>GL DATE</label><br>
                        '.$row->gl_date.'
                      </div>

                      <div class="col-md-3">
                        <label>FINANCIAL MONTH / YEAR</label><br>
                        '.$row->Fmonth.' / '.$row->Fyear.'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <label>DESCRIPTION</label><br>
                        '.$row->description.'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>TOTAL</label><br>
                        '.number_format($row->total).'
                      </div>

                      <div class="col-md-3">
                        <label>REFERENCES</label><br>
                        '.$row->reff_no.'
                      </div>

                      <div class="col-md-3">
                        <label>MODUL</label><br>
                        '.strtoupper($row->Fmodule).'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>AUDIT USER</label><br>
                        '.$row->audit_user.'
                      </div>

                      <div class="col-md-3">
                        <label>AUDIT DATE/TIME</label><br>
                        '.$row->audit_date.'
                      </div>
                    </div><br>

                    
					 <tr>
					 	<td width="100px" align="center"><b>ACCOUNT</td>
					 	<td align="center"><b>DESCRIPTION</td>
					 	<td width="200px" align="center"><b>DEBIT</td>
					 	<td width="200px" align="center"><b>CREDIT</td>
					 </tr>

					';


				};


				foreach($data['detail'] as $row2) {
					$output .= '
					 <div class="row">
					 
					  <tr>
					 	<td>'.$row2->coa_id.'</td>
					 	<td>'.$row2->name_coa.'</td>
					 	<td align="right">'.number_format($row2->debit).'</td>
					 	<td align="right">'.number_format($row2->credit).'</td>
					 </tr>
					 </div>
					';

				
				};


				$output .= "</table></div>";
				echo $output;

			};
		}

	
}