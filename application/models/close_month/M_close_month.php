<?php
class M_close_month extends CI_Model{


	public function validate($month, $year){
		$data = $this->db->query("SELECT `date` FROM closed_saldo WHERE MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year."' ");
		return $data->result();
	}
	

	public function closed_saldo($month, $year){
		$data = $this->db->query("
			INSERT INTO closed_saldo (date, coa_id, saldo) SELECT
				gl_header.gl_date,
				coa.coa_id,
				CASE
			WHEN coa.subgroup BETWEEN 100 AND 199 OR 
				 coa.subgroup BETWEEN 600 AND 799 OR
				 coa.subgroup BETWEEN 802 AND 999
			THEN
				SUM(gl_detail.debit - gl_detail.credit)
			ELSE
				SUM(gl_detail.credit - gl_detail.debit)
			END AS saldo
			FROM
				gl_detail
			JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
			JOIN coa ON coa.coa_id = gl_detail.coa_id
			JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
			WHERE
				MONTH (gl_header.gl_date) = '".$month."'
			AND YEAR (gl_header.gl_date) = '".$year."'
			AND gl_header.status = 'posted'
			GROUP BY
				gl_detail.coa_id
			");
		// return $data->resut();
	}

	public function closed_ar($month, $year){
		$data = $this->db->query("
			UPDATE ar_header set Fmonth = 'close' where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."' AND status = 'posted';
			");
	}
	public function closed_ap($month, $year){
		$data = $this->db->query("
			UPDATE ap_header set Fmonth = 'close' where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."' AND status = 'posted';
			");
	}
	public function closed_jv($month, $year){
		$data = $this->db->query("
			UPDATE jv_header set Fmonth = 'close' where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."' AND status = 'posted';
			");
	}

	public function closed_gl($month, $year){
		$data = $this->db->query("
			UPDATE gl_header set Fclose = 'close' where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."' AND status = 'posted';
			");
	}
}
?>