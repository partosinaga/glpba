<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cash_bank extends CI_Controller
{
    function __Construct(){
        parent ::__construct();
        $this->load->model('cash_bank/M_cb');

        $this->load->helper('url');
    }

    public function view_cb()
    {
        $this->benchmark->mark('code_start');
        $a=5;
        for($i=1; $i <= $a; $i++ ){
            $date[$i] = date('Y-m-d', strtotime('-'.$i.' days'))."<br>";
        }
        $date1 = $date[1];
        $date2 = $date[2];
        $date3 = $date[3];
        $date4 = $date[4];
        $date5 = $date[5];
//        get coa kas & bank
        $data['coa'] = $this->M_cb->get_coa();
        //get tranx
        $data['one'] = $this->M_cb->get_trans1($date1);
        $data['two'] = $this->M_cb->get_trans2($date2);
        $data['three'] = $this->M_cb->get_trans3($date3);
        $data['four'] = $this->M_cb->get_trans4($date4);
        $data['five'] = $this->M_cb->get_trans5($date5);

        //get sum
        $data['sum_satu'] = $this->M_cb->sum_trans1($date1)->total;
        $data['sum_dua'] = $this->M_cb->sum_trans2($date2)->total;
        $data['sum_tiga'] = $this->M_cb->sum_trans3($date3)->total;
        $data['sum_empat'] = $this->M_cb->sum_trans4($date4)->total;
        $data['sum_lima'] = $this->M_cb->sum_trans5($date5)->total;

        $this->load->view('cash_bank/view_cb', $data);
        $this->benchmark->mark('code_end');

    }

    public function find(){
        $this->benchmark->mark('code_start');
        $period = $this->input->post('period');



        $a =4;
        for($i=0; $i <= $a; $i++ ){
            $date[$i] = date('Y-m-d', strtotime('-'.$i.'days', strtotime($period)))."<br>";
        }

        $date1 = $date[0];
        $date2 = $date[1];
        $date3 = $date[2];
        $date4 = $date[3];
        $date5 = $date[4];

        //get coa kas & bank
        $data['coa'] = $this->M_cb->get_coa();
        //get tranx
        $data['one'] = $this->M_cb->get_trans1($date1);
        $data['two'] = $this->M_cb->get_trans2($date2);
        $data['three'] = $this->M_cb->get_trans3($date3);
        $data['four'] = $this->M_cb->get_trans4($date4);
        $data['five'] = $this->M_cb->get_trans5($date5);

        //get sum
        $data['sum_satu'] = $this->M_cb->sum_trans1($date1)->total;
        $data['sum_dua'] = $this->M_cb->sum_trans2($date2)->total;
        $data['sum_tiga'] = $this->M_cb->sum_trans3($date3)->total;
        $data['sum_empat'] = $this->M_cb->sum_trans4($date4)->total;
        $data['sum_lima'] = $this->M_cb->sum_trans5($date5)->total;




        $data['period'] = $period;
        $this->load->view('cash_bank/find_cb', $data);
        $this->benchmark->mark('code_end');
    }
}