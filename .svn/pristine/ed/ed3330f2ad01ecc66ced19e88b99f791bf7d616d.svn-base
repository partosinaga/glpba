<?php
class M_subs_ledger extends CI_Model{

	public function get_coa(){
		$data = $this->db->query("SELECT
				coa.coa_id, coa.name_coa, subgroup.kelompok, group_coa.name
			FROM
				`coa`
			 join subgroup
			on subgroup.subgroup_id = coa.subgroup
			join group_coa
			on group_coa.group_id = subgroup.kelompok
			where coa.header = '' AND coa.active = 'active';");
		return $data->result();
	}

	public function get_trans($date_from, $date_to, $coa_from, $coa_to){
		$return = $this->db->query(" 
			SELECT
				coa.coa_id,
				coa.name_coa,
				gl_detail.gl_no,
				gl_header.gl_date,
				gl_header.description,
				gl_detail.coa_id,
				gl_detail.debit,
				gl_detail.credit,
				subgroup.kelompok
			FROM
				gl_detail
			JOIN gl_header ON gl_header.gl_no = gl_detail.gl_no
			JOIN coa ON coa.coa_id = gl_detail.coa_id
			JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
			WHERE gl_header.gl_date  >= '".$date_from."' AND  gl_header.gl_date <= '".$date_to."'
			AND  coa.coa_id  >= '".$coa_from."' AND coa.coa_id <= '".$coa_to."'
			ORDER BY gl_detail.coa_id ASC 
			 ");
		return $return->result();
	}

	public function get_begining_balance($date_from, $date_to, $coa_from, $coa_to){
		$data = $this->db->query("select coa.name_coa, coa.coa_id, SUM(gl_detail.debit) as balance_debit, SUM(gl_detail.credit) as balance_credit 
			from gl_detail
			join gl_header
			on gl_detail.gl_no = gl_header.gl_no
			join coa
			on coa.coa_id = gl_detail.coa_id
			where gl_header.gl_date < '".$date_from."' 
			AND  coa.coa_id  >= '".$coa_from."' and coa.coa_id <= '".$coa_to."'
			GROUP BY gl_detail.coa_id ASC ;");
		return $data->result();
	}
}
?>