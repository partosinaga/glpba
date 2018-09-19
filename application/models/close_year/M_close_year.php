<?php
class M_close_year extends CI_Model{


	// to input saldo akun aktiva(akun 1 dan 2) saat close year
	public function close_year($y, $year){
		$data = $this->db->query("
			INSERT INTO closed_saldo (date, coa_id, saldo, state) 
			SELECT
				'".$y."',
				closed_saldo.coa_id,
				closed_saldo.saldo,
				'cy'
			FROM
				closed_saldo
			join coa 
			on coa.coa_id = closed_saldo.coa_id
			WHERE
				YEAR (closed_saldo.date) = ".$year." AND coa.subgroup BETWEEN 100 AND 399
			");
	}
}
?>