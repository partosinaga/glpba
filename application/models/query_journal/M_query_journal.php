<?php
class M_query_journal extends CI_Model{

	public function get_all_transaction(){
		$data = $this->db->query("select * from gl_header where status = 'posted' order by gl_date DESC ");
		return $data->result();
	}


	public function get_header($id){
		$data = $this->db->query("SELECT * from gl_header WHERE gl_no =  '".$id."' ");
		return $data->result();
	}
	public function get_detail($id){
		$data = $this->db->query("SELECT gl_detail.coa_id, coa.name_coa, gl_detail.debit, gl_detail.credit
				from gl_detail
				JOIN coa
				ON coa.coa_id = gl_detail.coa_id WHERE gl_detail.gl_no =  '".$id."' ");
		return $data->result();
	}
}
?>