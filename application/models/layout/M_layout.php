<?php
class M_layout extends CI_Model
{
    public function get_category($id){
        $data = $this->db->query("SELECT * FROM category WHERE id_report = '".$id."'");
        return $data->result();
    }

    public function get_subcategory($id){
        $data = $this->db->query("SELECT * FROM subcategory WHERE id_category = '".$id."' ");
        return $data->result();
    }

    public function save($data, $table){
        $this->db->insert($table, $data);
    }

    public function get_all($id){
        $data = $this->db->query("
        SELECT
          d.id_detail,
          c.account as ctg_account,
          sc.`name`,
          d.account,
          d.is_range,
          d.is_cf,
          d.range_start,
          d.range_end,
          d.custom
        FROM
          detail_category d
          JOIN category c ON c.id_category = d.id_category
          JOIN subcategory sc ON sc.id_subcategory = d.id_subcategory
        WHERE
          d.id_report = '".$id."'
        ORDER BY
          d.id_detail ASC
        ");
        return $data->result();
    }

    public function remove($id_report, $id){
        if($id_report == 3){
            $this->db->query("DELETE FROM detail_category WHERE id_detail = '".$id."'");//
            $this->db->query("UPDATE COA SET cashflow = NULL WHERE cashflow = '".$id."'");
        }else{
            $this->db->query("DELETE FROM detail_category WHERE id_detail = '".$id."'");//
            $this->db->query("UPDATE COA SET id_detail = NULL WHERE id_detail = '".$id."'");
        }
    }

    public function save_edit($id_report, $id,$account,$range_start,$range_end,$custom,$is_cf, $is_range ){
        if($id_report == 3){ //if id report == 3 update cashflow column on coa.
            $this->db->query("UPDATE coa SET cashflow = NULL"); //REMOVE ALL ID_DETAIL COLUMN FROM COA AND THEN FILL AGAIN IN NEXT STEP
            for ($i = 0; $i < count($id); $i++) {

                if ($is_range[$i] == 1) { //to range
                    $this->db->query("UPDATE coa SET cashflow = '" . $id[$i] . "' WHERE coa_id BETWEEN '" . $range_start[$i] . "' AND '" . $range_end[$i] . "' ");
                }
                if ($is_range[$i] != 1) { //not range
                    $cut = explode("+", $custom[$i]);
                    for ($x = 0; $x < count($cut); $x++) {
                        $this->db->query("UPDATE coa SET cashflow = '" . $id[$i] . "' WHERE coa_id = '" . $cut[$x] . "' ");
                    }
                }
                $this->db->query("
                    UPDATE detail_category
                    SET
                    account = '" . $account[$i] . "',
                    range_start = '" . $range_start[$i] . "',
                    range_end = '" . $range_end[$i] . "',
                    custom = '" . $custom[$i] . "',
                    is_range = '" . $is_range[$i] . "',
                    is_cf = '" . $is_cf[$i] . "'
                    WHERE
                    id_detail = '" . $id[$i] . "'
                ");
            }


        }else {


            $this->db->query("UPDATE coa
                                JOIN detail_category ON detail_category.id_detail = coa.id_detail
                                SET coa.id_detail = NULL, coa.report_type = NULL
                                WHERE
                                  detail_category.id_report = '" . $id_report . "'"); //REMOVE ALL ID_DETAIL COLUMN FROM COA AND TEHN FILL AGAIN IN NEXT STEP
            for ($i = 0; $i < count($id); $i++) {

                if ($is_range[$i] == 1) { //to range
                    $this->db->query("UPDATE coa SET id_detail = '" . $id[$i] . "' , report_type = '".$id_report."' WHERE coa_id BETWEEN '" . $range_start[$i] . "' AND '" . $range_end[$i] . "' ");
                }
                if ($is_range[$i] != 1) { //not range
                    $cut = explode("+", $custom[$i]);
                    for ($x = 0; $x < count($cut); $x++) {
                        $this->db->query("UPDATE coa SET id_detail = '" . $id[$i] . "' , report_type = '".$id_report."' WHERE coa_id = '" . $cut[$x] . "' ");
                    }
                }
                $this->db->query("
                    UPDATE detail_category
                    SET
                    account = '" . $account[$i] . "',
                    range_start = '" . $range_start[$i] . "',
                    range_end = '" . $range_end[$i] . "',
                    custom = '" . $custom[$i] . "',
                    is_range = '" . $is_range[$i] . "',
                    is_cf = '" . $is_cf[$i] . "'
                    WHERE
                    id_detail = '" . $id[$i] . "'
                ");
            }
        }
    }

    public function get_ctgr(){
        $data = $this->db->query("SELECT * from category");
        return $data->result();
    }
    public function get_expands($id){
        $data = $this->db->query("SELECT * from subcategory where id_category = '".$id."' ");
        return $data->result();
    }

    public function save_edit_category($id, $account){
        for($a = 0 ; $a < count($id); $a++){
            $this->db->query("UPDATE category SET account = '".$account[$a]."' WHERE id_category = '".$id[$a]."' ");
        }
    }

    public function save_edit_subcategory($id, $name){
        for($a = 0 ; $a < count($id); $a++){
            $this->db->query("UPDATE subcategory SET `name` = '".$name[$a]."' WHERE id_subcategory = '".$id[$a]."' ");
        }
    }

}
