<?php
class M_bank_book extends CI_Model{

	public function view_bb($period, $account_code){
		$data = $this->db->query("
			SELECT
				gl_header.gl_date,
				gl_header.gl_no,
				gl_header.description,
				gl_header.total,
				gl_header.Fmodule,
				gl_detail.coa_id,
				gl_detail.debit,
				gl_detail.credit
			FROM
				gl_detail
			JOIN coa ON coa.coa_id = gl_detail.coa_id
			JOIN gl_header ON gl_header.gl_no = gl_detail.gl_no
			JOIN bank ON bank.account_code = coa.coa_id
			where bank.account_code = '".$account_code."' AND gl_header.gl_date <= '".$period."'
			order by gl_header.gl_date ASC;");
		return $data->result();
	}

	public function get_bank_name($account_code){
		$data = $this->db->query("select * from bank where account_code = '".$account_code."'");
		return $data->row();
	}
	

	

}
?>