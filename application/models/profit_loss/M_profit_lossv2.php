<?php
class M_profit_lossv2 extends CI_Model{

    public function get_account(){
        $data = $this->db->query("
            SELECT
              dc.is_cf,
              dc.id_detail,
              ctg.id_category,
              ctg.category,
              sc.id_subcategory,
              sc.`name`,
              dc.account
            FROM
              coa c
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              dc.id_report = 2
            GROUP BY
              c.id_detail
            ORDER BY
              dc.is_cf ASC
        ");
        return $data->result();
    }


    public function get_ytm($date_from, $date_to){
        $data = $this->db->query("
            SELECT
              ctg.id_category,
              ctg.category,
              sc.id_subcategory,
              sc.`name`,
              dc.account,
              sum( cs.saldo ) as balance_ytm,
              dc.id_detail
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date BETWEEN '".$date_from."' AND '".$date_to."'
              AND dc.id_report = 2
            GROUP BY
              dc.id_detail
            ORDER BY
              dc.is_cf ASC
        ");
        return $data->result();
    }

    public function get_ytd($yy, $date_to){
        $data = $this->db->query("
            SELECT
              dc.is_cf,
              dc.id_detail,
              ctg.id_category,
              ctg.category,
              sc.id_subcategory,
              sc.`name`,
              dc.account,
              sum( cs.saldo ) AS balance_ytd
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date BETWEEN '".$yy."' AND '".$date_to."'
              AND dc.id_report = 2
            GROUP BY
              dc.id_detail
            ORDER BY
              dc.is_cf ASC
        ");
        return $data->result();
    }

    public function get_breakdown($id_detail, $date_from, $date_to){
        $data  = $this->db->query("
            SELECT
              dc.id_report,
              c.id_detail,
              gld.coa_id,
              c.name_coa,
              glh.gl_no,
              glh.gl_date,
              glh.description,
              gld.debit,
              gld.credit
            FROM
              gl_detail gld
              JOIN gl_header glh ON glh.gl_no = gld.gl_no
              JOIN coa c ON c.coa_id = gld.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
            WHERE
              dc.id_report = 2
              AND dc.id_detail = ".$id_detail."
              AND glh.gl_date BETWEEN '".$date_from."'
              AND '".$date_to."'
            ORDER BY
            gld.coa_id ASC,
              glh.gl_date ASC

        ");
        return $data->result();
    }


    public function get_breakdownYtd($id_detail,$yy, $date_to){
        $data  = $this->db->query("
            SELECT
              dc.id_report,
              c.id_detail,
              gld.coa_id,
              c.name_coa,
              glh.gl_no,
              glh.gl_date,
              glh.description,
              gld.debit,
              gld.credit
            FROM
              gl_detail gld
              JOIN gl_header glh ON glh.gl_no = gld.gl_no
              JOIN coa c ON c.coa_id = gld.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
            WHERE
              dc.id_report = 2
              AND dc.id_detail = ".$id_detail."
              AND glh.gl_date BETWEEN '".$yy."' AND '".$date_to."'
            ORDER BY
            gld.coa_id ASC,
              glh.gl_date ASC

        ");
        return $data->result();
    }

}

?>


