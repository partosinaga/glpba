<?php
class M_syspar extends CI_Model{

	public function get_syspar(){
		$data = $this->db->query("select * from system_parameter
									join currency
									on system_parameter.base_currency = currency.curr_id");
		return $data->result();
	}

	public function save_edit($id, $company_id, $name, $top_approval, $base_currency, $financial_month, $financial_year, 
			$reaa, $reac){
		$data=$this->db->query(" update system_parameter set 
			name = '".$name."' ,
			top_approval = '".$top_approval."' ,
			base_currency = '".$base_currency."' ,
			financial_month = '".$financial_month."' , 
			financial_year = '".$financial_year."',
			reaa = '".$reaa."', 
			reac = '".$reac."' ,
			company_id = '".$company_id."'
			where id = '".$id."'
			;");

	}

	public function get_coa(){
		$data = $this->db->query("select * from coa where subgroup between 400 and 499 AND active = 'active'");
		return $data->result();
	}

}
?>