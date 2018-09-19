<?php

class M_cb extends CI_Model
{
    public function get_coa()
    {
        $data = $this->db->query("
           SELECT
              c.header,
              c.coa_id,
              c.name_coa,
              sg.subgroup_id
            FROM
              coa c
              JOIN subgroup sg ON sg.subgroup_id = c.subgroup
            WHERE
              sg.subgroup_id = 101 AND c.name_coa != 'Kas & Setara Kas' AND c.name_coa != 'Ayat Silang'
        ");
        return $data->result();
    }
    public function get_trans1($date1)
    {
        echo $date1;
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS saldo
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date1."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
            GROUP BY
              gl_detail.coa_id
        ");
        return $data->result();
    }

    public function get_trans2($date2)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS saldo
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date2."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
            GROUP BY
              gl_detail.coa_id
        ");
        return $data->result();
    }
    public function get_trans3($date3)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS saldo
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date3."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
            GROUP BY
              gl_detail.coa_id
        ");
        return $data->result();
    }
    public function get_trans4($date4)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS saldo
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date4."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
            GROUP BY
              gl_detail.coa_id
        ");
        return $data->result();
    }
    public function get_trans5($date5)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS saldo
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date5."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
            GROUP BY
              gl_detail.coa_id
        ");
        return $data->result();
    }



    public function sum_trans1($date1)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS total
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date1."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
        ");
        return $data->row();
    }
    public function sum_trans2($date2)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS total
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date2."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
        ");
        return $data->row();
    }
    public function sum_trans3($date3)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS total
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date3."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
        ");
        return $data->row();
    }

    public function sum_trans4($date4)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS total
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date4."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
        ");
        return $data->row();
    }

    public function sum_trans5($date5)
    {
        $data = $this->db->query("
           SELECT
              gl_header.gl_date,
              subgroup.subgroup_id,
              subgroup.name_sg,
              coa.name_coa,
              coa.coa_id,
              SUM( gl_detail.debit ) - SUM( gl_detail.credit ) AS total
            FROM
              gl_detail
              JOIN gl_header ON gl_detail.gl_no = gl_header.gl_no
              JOIN coa ON coa.coa_id = gl_detail.coa_id
              JOIN subgroup ON subgroup.subgroup_id = coa.subgroup
            WHERE
              gl_header.gl_date <= '".$date5."'
              AND gl_header.`status` = 'posted'
              AND subgroup.subgroup_id = 101
        ");
        return $data->row();
    }

}