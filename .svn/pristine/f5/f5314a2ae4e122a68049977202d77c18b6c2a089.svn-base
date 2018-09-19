<?php
class M_currency extends CI_Model{

	public function add_currency($data,$table){
		$this->db->insert($table,$data);
	}
	public function get_currency(){
		$data = $this->db->query("select * from currency");
		return $data->result();
	}

	public function edit_currency($curr_id){
		$data = $this->db->query("select * from currency where curr_id = '".$curr_id."'; ");
		return $data->result();
	}

	public function save_edit($curr_id, $curr_name){
		$data = $this->db->query("UPDATE currency set curr_name = '".$curr_name."' 
			where curr_id = ".$curr_id." ");
	} 

}
?>