<?php
class M_trial_balance extends CI_Model{

	public function get_coa(){
		$data = $this->db->query("select * from coa where active = 'active'");
		return $data->result();
	}

	public function get_begining($date_from){
		$data = $this->db->query("
			SELECT
					h.gl_date,
					d.coa_id,
					c.name_coa,
					sum( d.debit ) as d_begin,
					sum( d.credit ) as c_begin
				FROM
					gl_detail d
					JOIN gl_header h ON h.gl_no = d.gl_no
					JOIN coa c ON c.coa_id = d.coa_id
				WHERE
					h.gl_date < '".$date_from."' AND h.`status` = 'posted' AND Fclose = 'close'
				GROUP BY
					c.coa_id
			");
		return $data->result();
	}

	public function get_mutasi($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				c.coa_id,
				c.name_coa,
				h.description,
				SUM( d.debit ) AS d_mutasi,
				SUM( d.credit ) AS c_mutasi
			FROM
				gl_detail d
				JOIN coa c ON c.coa_id = d.coa_id
				JOIN gl_header h ON h.gl_no = d.gl_no 
			WHERE
				h.gl_date BETWEEN '".$date_from."' AND '".$date_to."' AND h.`status` = 'posted' AND Fclose = 'close'
			GROUP BY
				d.coa_id
			");
		return $data->result();
	}

}
?>