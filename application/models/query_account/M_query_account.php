<?php
class M_query_account extends CI_Model{

	public function get_coaGl(){
		$return = $this->db->query("select DISTINCT(gl_detail.coa_id), coa.name_coa 
				from gl_detail
				join coa
				on coa.coa_id = gl_detail.coa_id
				order by gl_detail.coa_id ASC");
		return $return;
	}

	public function view_qa_ar($coa_id, $module){
		$data = $this->db->query("
			SELECT
				gl_header.reff_no, gl_header.gl_date, gl_header.status,  gl_header.description, gl_header.gl_no, gl_detail.debit, gl_detail.credit
			FROM
				`gl_detail`
			join gl_header
			on gl_header.gl_no = gl_detail.gl_no
			join coa
			on coa.coa_id = gl_detail.coa_id
			WHERE
				gl_detail.coa_id = '".$coa_id."' AND gl_header.Fmodule ='".$module."'");
		return $data->result();
	}
	public function view_qa_ap($coa_id, $module){
		$data = $this->db->query("SELECT
				gl_header.reff_no, gl_header.gl_date, gl_header.status,  gl_header.description, gl_header.gl_no, gl_detail.debit, gl_detail.credit
			FROM
				`gl_detail`
			join gl_header
			on gl_header.gl_no = gl_detail.gl_no
			join coa
			on coa.coa_id = gl_detail.coa_id
			WHERE
				gl_detail.coa_id = '".$coa_id."' AND gl_header.Fmodule ='".$module."'");
		return $data->result();
	}

	public function view_qa_jv($coa_id, $module){
		$return = $this->db->query("SELECT
				gl_header.reff_no, gl_header.gl_date, gl_header.status,  gl_header.description, gl_header.gl_no, gl_detail.debit, gl_detail.credit
			FROM
				`gl_detail`
			join gl_header
			on gl_header.gl_no = gl_detail.gl_no
			join coa
			on coa.coa_id = gl_detail.coa_id
			WHERE
				gl_detail.coa_id = '".$coa_id."' AND gl_header.Fmodule ='".$module."'");
		return $return->result();
	}
	


}
?>