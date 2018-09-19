<?php
class M_profit_loss extends CI_Model{

	public function get_income($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS income
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok = 5
			GROUP BY
				coa.coa_id
		");
		return $data->result();
	}
	public function get_expense($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS expense
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 6 AND 7
			GROUP BY
				coa.coa_id
				");
		return $data->result();
	}

	public function sum_income($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS sum_income
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok = 5
			");
		return $data->result();
	}

	

	public function sum_expense($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS sum_expense
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 6 AND 7
			");
		return $data->row();
	}


	// YEAR TO DATE
	public function get_prevIncome($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS prev_income
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok = 5
			GROUP BY
				coa.coa_id
			");
		return $data->result();
	}

	public function sum_prevIncome($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS prev_sum_income
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok = 5
			");
		return $data->row();
	}
	

	// PREV beban
	public function get_prevExpense($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS prev_expense
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 6 AND 7
			GROUP BY
				coa.coa_id
			");
		return $data->result();
	}

	public function sum_prevExpense($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS sum_prev_expense
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 6 AND 7
			");
		return $data->row();
	}

	// pendapatan & biaya lainnya
	public function get_coa_Oi_Oe(){
		$data = $this->db->query("
			SELECT
				coa.coa_id,
				coa.name_coa
			FROM
				coa 
				JOIN subgroup sg ON sg.subgroup_id = coa.subgroup 
			WHERE
				sg.kelompok BETWEEN 8 AND 9
			");
	return $data->result();
	}

	public function other_in_ex($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS other_in_ex
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9
			GROUP BY
				coa.coa_id
			");
	return $data->result();
	}

	public function prev_other_in_ex($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS prev_other_in_ex
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9
			GROUP BY
				coa.coa_id
			");
		return $data->result();
	}


	public function sum_other_in_ex($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS sum_other_in_ex
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9
			");
		return $data->row();
	}

	public function sum_prev_other_in_ex($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS sum_prev_other_in_ex
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9
			");
		return $data->row();
	}


	public function rica($date_from, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS ricabum
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$date_from."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9 AND coa.name_coa LIKE 'B%'

			");
		return $data->row();
	}
	public function prev_rica($yy, $date_to){
		$data = $this->db->query("
			SELECT
				cs.coa_id,
				coa.name_coa,
				SUM(cs.saldo) AS prev_ricabum
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok BETWEEN 8 AND 9 AND coa.name_coa LIKE 'B%'

			");
		return $data->row();
	}
























	// public function other_income($date_from, $date_to){
	// 	$data = $this->db->query("
	// 			SELECT
	// 				coa.coa_id,
	// 				coa.name_coa,
	// 				SUM(det.credit - det.debit) AS other_income
	// 			FROM
	// 				gl_detail det
	// 			JOIN gl_header head ON head.gl_no = det.gl_no
	// 			JOIN coa ON coa.coa_id = det.coa_id
	// 			JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 			WHERE
	// 				subgroup.subgroup_id BETWEEN 901 AND 904
	// 			AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 			GROUP BY
	// 				det.coa_id ASC
	// 		");
	// 	return $data->result();
	// }

	// public function sum_other_income($date_from, $date_to){
	// 	$data =$this->db->query("
	// 		SELECT
	// 			SUM(det.credit - det.debit) AS sum_other_income
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 901 AND 904
	// 		AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 		");
	// 	return $data->result();
	// }

	// // beban lainnya
	// public function other_expense($date_from, $date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id,
	// 			coa.name_coa,
	// 			SUM(det.debit - det.credit) AS other_expense
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id = 905
	// 		AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 		GROUP BY
	// 			det.coa_id ASC
	// 		");
	// 	return $data->result();
	// }

	// public function sum_other_expense($date_from, $date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			SUM(det.debit - det.credit) AS sum_other_expense
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id = 905
	// 		AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 		");
	// 	return $data->result();
	// }
	// // beban lainnya akun 910-999
	// public function other_expense2($date_from, $date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id,
	// 			coa.name_coa,
	// 			SUM(det.debit - det.credit) AS other_expense2
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 910 AND 999
	// 		AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 		GROUP BY
	// 			det.coa_id ASC
	// 		");
	// 	return $data->result();
	// }

	// public function sum_other_expense2($date_from, $date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id,
	// 			coa.name_coa,
	// 			SUM(det.debit - det.credit) AS sum_other_expense2
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 910 AND 999
	// 		AND head.gl_date BETWEEN '".$date_from."' AND '".$date_to."'
	// 		");
	// 	return $data->row();
	// }



	

	// // PREV pendapatan lainnya 
	// public function prev_other_income($date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id, coa.name_coa, SUM(det.credit-det.debit) as prev_other_income
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 901 AND 904 
	//  		AND head.gl_date BETWEEN (SELECT MAKEDATE(year(now()),1)) AND '".$date_to."'
	// 		GROUP BY
	// 			det.coa_id ASC
	// 		");
	// 	return $data->result();
	// }

	// public function sum_prev_other_income($date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id, coa.name_coa, SUM(det.credit-det.debit) as sum_prev_other_income
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 901 AND 904 
	//  		AND head.gl_date BETWEEN (SELECT MAKEDATE(year(now()),1)) AND '".$date_to."'

	// 		");
	// 	return $data->row();
	// }

	// // PREV other expense
	// public function prev_other_expense($date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			coa.coa_id, coa.name_coa, SUM(det.debit-det.credit) as prev_other_expense
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id = 905
	//  		AND head.gl_date BETWEEN (SELECT MAKEDATE(year(now()),1)) AND '".$date_to."'
	// 		GROUP BY
	// 			det.coa_id ASC
	// 		");
	// 	return $data->result();
	// }

}
?>