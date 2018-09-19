<?php
class M_tag extends CI_Model{


	public function add($data,$table){
		$this->db->insert($table,$data);
	}
	public function get_data(){
		$data = $this->db->query("SELECT * FROM tag");
		return $data->result();
	}
	public function get_edit($id){
		$data = $this->db->query("SELECT * FROM tag WHERE id ='".$id."' ");
		return $data->result();
	}
	public function save_edit($id, $name_tag, $status){
		$this->db->query("update tag set name_tag = '".$name_tag."' , status = '".$status."' WHERE id = '".$id."'");
	}
}
?>