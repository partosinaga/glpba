<?php

class M_cfd extends CI_Model
{
    public function get_coa()
    {
        $data = $this->db->query("
        SELECT
          ctg.id_category,
          ctg.account AS `name`,
          dc.id_detail,
          dc.account,
          c.subgroup,
          c.coa_id,
          c.name_coa
        FROM
          coa c
          JOIN detail_category dc ON dc.id_detail = c.cashflow
          JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
          JOIN category ctg ON ctg.id_category = dc.id_category
        ORDER BY
          sc.id_subcategory,
          dc.id_detail
              ");
        return $data->result();
    }
    public function get_monthly($date_to){
        $data = $this->db->query(" CALL cf_v1_monthly ('".$date_to."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }

    public function get_monthly_prev($date_from){
        $data = $this->db->query(" CALL cf_v1_prev_monthly ('".$date_from."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }

    public function get_total($yearStart, $date){
        $data = $this->db->query(" CALL cf_v1_total ('".$yearStart."', '".$date."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }

    public function get_total_prev($prevYearStart){
        $data = $this->db->query(" CALL cf_v1_total_prev ('".$prevYearStart."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }
}
