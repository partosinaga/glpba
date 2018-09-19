<?php
class M_balance_sheet extends CI_Model{


	public function get_transA($date_to){ //current month aset
		$data=$this->db->query("
			SELECT
				sg.subgroup_id,
				sg.name_sg,
				cs.date,
				cs.coa_id,
				coa.name_coa,
				sg.kelompok,
				SUM(cs.saldo) AS asset_current
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$date_to."'
			AND sg.kelompok = 1
			GROUP BY
				coa.coa_id
			");
		return $data->result();
	}

	public function get_prev_asset($date_from){ //prev month aset
		$data=$this->db->query("
			SELECT
				sg.subgroup_id,
				sg.name_sg,
				cs.date,
				cs.coa_id,
				coa.name_coa,
				sg.kelompok,
				SUM(cs.saldo) AS asset_previous
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$date_from."' - INTERVAL 1 DAY
			AND sg.kelompok = 1
			GROUP BY
				coa.coa_id
				");
		return $data->result();
	}

	public function total_asset($date_to){ //total aset
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS t_asset
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <='".$date_to."'
			AND sg.kelompok = 1
			");
		return $data->row();
	}

	public function total_prev_asset($date_from){ //total aset previous
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS t_asset_prev
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <='".$date_from."' - INTERVAL 1 DAY
			AND sg.kelompok = 1
			");
		return $data->row();
	}
//END OF QUERY SSETS

//QUERY LIABILITI
	public function get_transL($date_to){
		$data=$this->db->query("
			SELECT
				sg.subgroup_id,
				sg.name_sg,
				cs.date,
				cs.coa_id,
				coa.name_coa,
				sg.kelompok,
				SUM(cs.saldo) AS liabiliti_current
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$date_to."'
				AND sg.kelompok IN (2, 3, 4)
			GROUP BY
				cs.coa_id

			");
		return $data->result();
	}

	public function get_prev_liab($date_from){
		$data=$this->db->query("
			SELECT
				sg.subgroup_id,
				sg.name_sg,
				cs.date,
				cs.coa_id,
				coa.name_coa,
				sg.kelompok,
				SUM(cs.saldo) AS liabiliti_previous
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$date_from."'-INTERVAL 1 DAY
			AND sg.kelompok IN (2, 3, 4)
			GROUP BY
				cs.coa_id
			 ");
		return $data->result();
	}

	public function total_liabiliti($date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS t_liabiliti
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <='".$date_to."'
			AND sg.kelompok  IN (2, 3, 4)
			");
		return $data->row();
	}
	public function total_prev_liabiliti($date_from){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS t_liabiliti_prev
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <='".$date_from."' -INTERVAL 1 DAY
			AND sg.kelompok  IN (2, 3, 4)
			");
		return $data->row();
	}

	// LABA DITAHAN
	public function LD_income_akun5($tld){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS ldi5
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date  <= '".$tld."'
			AND sg.kelompok = 5
			");
		return $data->row();
	}

	public function LD_income_akun8($tld){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS ldi8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$tld."' AND sg.subgroup_id = 801
			");
		return $data->row();
	}

	public function LD_expense_akun7($tld){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lde7
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$tld."'
			AND sg.kelompok = 7
			");
		return $data->row();
	}

	public function LD_expense_akun802($tld){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lde802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999 
			AND cs.date <= '".$tld."'
			");
		return $data->row();
	}

	// public function LD_expense_akun900_999(){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			SUM(det.debit - det.credit) AS lde900_999
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			coa.subgroup BETWEEN 910 AND 999
	// 		AND head.gl_date <= (SELECT DATE_SUB(LAST_DAY(DATE_ADD(NOW(), INTERVAL 12-MONTH(NOW()) MONTH)), INTERVAL 1 YEAR));
	// 		");
	// 	return $data->row();
	// }
// laba rugi tahun berjalan
	public function LR_income_akun5($yy,$date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lri5
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

	public function LR_income_akun8($yy,$date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lri8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id = 801
			AND cs.date BETWEEN '".$yy."' AND '".$date_to."'
			");
			return $data->row();
		}

	public function LR_expense_akun7($yy, $date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lre7
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."' 
			AND sg.kelompok = 7
			");
		return $data->row();
	}

	public function LR_expense_akun802($yy, $date_to){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lre802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999 
			AND cs.date BETWEEN '".$yy."' AND '".$date_to."' 
			");
		return $data->row();
	}

	// public function LR_expense_akun910_999($date_to){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			SUM(det.debit - det.credit) AS lre910_999
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 910 AND 999
	// 		AND head.gl_date BETWEEN (SELECT MAKEDATE(year(now()),1)) AND '".$date_to."'
	// 					");
	// 	return $data->row();
	// }

	// PREVIOUS LABA RUGI TAHUN BERJALAN 
	public function PLR_income_akun5($yy, $date_from){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plri5
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_from."' - INTERVAL 1 DAY
			AND sg.kelompok = 5
			");
		return $data->row();
	}

	public function PLR_income_akun8($yy, $date_from){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plri8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id = 801
			AND cs.date BETWEEN '".$yy."' AND '".$date_from."'- INTERVAL 1 DAY
			");
			return $data->row();
		}

	public function PLR_expense_akun7($yy, $date_from){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plre7
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_from."' - INTERVAL 1 DAY
			AND sg.kelompok = 7
			");
		return $data->row();
	}

	public function PLR_expense_akun802($yy, $date_from){
		$data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plre802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999 
			AND cs.date BETWEEN '".$yy."' AND '".$date_from."' - INTERVAL 1 DAY
			");
		return $data->row();
	}

	// public function PLR_expense_akun910_999($date_from){
	// 	$data = $this->db->query("
	// 		SELECT
	// 			SUM(det.debit - det.credit) AS plre910_999
	// 		FROM
	// 			gl_detail det
	// 		JOIN gl_header head ON head.gl_no = det.gl_no
	// 		JOIN coa ON coa.coa_id = det.coa_id
	// 		JOIN subgroup ON coa.subgroup = subgroup.subgroup_id
	// 		WHERE
	// 			subgroup.subgroup_id BETWEEN 910 AND 999
	// 		AND head.gl_date BETWEEN (SELECT MAKEDATE(year(now()),1)) AND '".$date_from."'
	// 					");
	// 	return $data->row();
	// }
}
?>