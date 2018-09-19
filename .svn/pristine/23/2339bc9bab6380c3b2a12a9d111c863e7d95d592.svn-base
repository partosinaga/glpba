<?php
class M_query_journal extends CI_Model{

	public function get_all_transaction(){
		$data = $this->db->query("select * from gl_header where status = 'posted' order by gl_date DESC ");
		return $data->result();
	}
	

	

}
?>