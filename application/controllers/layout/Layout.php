<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('layout/M_layout');
        $this->load->helper('url');

    }

    public function bs_layout(){
        $data['page'] = 'layout/layout';
        $id = 1;//id report for balance sheet
        $data['category'] = $this->M_layout->get_category($id);
        $data['detail'] = $this->M_layout->get_all($id);

        $this->load->view('template/template', $data);
    }

    public function subcategory(){
        $id = $this->input->post('id', TRUE);
        $subcategory = $this->M_layout->get_subcategory($id);
        $output =null;
        foreach($subcategory as $sc){
            $output .= '<option value='.$sc->id_subcategory.'>'.strtoupper($sc->name).'</option>';
        }
        echo $output;
    }

    public function save(){
        $id_category = $this->input->post('id_category');
        $id_subcategory = $this->input->post('id_subcategory');
        $account = $this->input->post('account');
        $report_id = $this->input->post('report_id');
        $url = $this->input->post('url');

        $data = array(
            'id_report' => $report_id,
            'id_category' =>$id_category,
            'id_subcategory' =>$id_subcategory,
            'account' =>$account
        );
        $this->M_layout->save($data, 'detail_category');
        $this->session->set_flashdata('success', 'Success');
        redirect('layout/layout/'.$url.'');
    }

    public function remove(){
        $id = $this->input->post('id');
        $url = $this->input->post('url');
        $id_report = $this->input->post('id_report');

        $this->db->trans_begin();
        $this->M_layout->remove($id_report, $id);
        if($this->db->trans_status() === FALSE){
            echo "faild";
            exit();
        }else{
            $this->db->trans_commit();
            echo "succ";
            exit();
        }

        redirect('layout/layout/'.$url.'');
    }

    public function save_edit(){
        $id_report = $_POST['id_report'];
        $id = $_POST['id'];
        $account = $_POST['account'];
        $range_start = $_POST['range_start'];
        $range_end = $_POST['range_end'];
        $custom = $_POST['custom'];
        $is_cf = $_POST['is_cf'];
        $is_range = $_POST['is_range'];

        $this->M_layout->save_edit($id_report, $id,$account,$range_start,$range_end,$custom,$is_cf, $is_range );

        //echo $this->db->last_query()
    }

    public function pl_layout(){

        $data['page'] = 'layout/pl_layout';
        $id = 2;//id report for balance sheet
        $data['category'] = $this->M_layout->get_category($id);
        $data['detail'] = $this->M_layout->get_all($id);
        $this->load->view('template/template',$data);
    }

    public function cf_layout(){
        $data['page'] = 'layout/cf_layout';
        $id = 3;//id report for balance sheet
        $data['category'] = $this->M_layout->get_category($id);
        $data['detail'] = $this->M_layout->get_all($id);
        $this->load->view('template/template',$data);
    }

    public function category(){
        $data['page'] = 'layout/category';
        $data['ctgr'] = $this->M_layout->get_ctgr();
        $this->load->view('template/template', $data);
    }
    public function get_expands(){
        $id = $this->input->post('id', TRUE);
        $detail = $this->M_layout->get_expands($id);
        $output = NULL;
        $no = 1;
        foreach($detail as $d){
            $output .= '<tr>
                            <td align="center">'.$no++.'</td>
                            <td><input type="text" class="form-control font-sm" name="name_sub[]" style=" height: 24px;font-size: 12px" value="'.$d->name.'"></td>
                            <td><input type="hidden" class="form-control font-sm" name="id_subcategory[]" style=" height: 24px;font-size: 12px" value="'.$d->id_subcategory.'"></td>
                        </tr>';
        }

        echo $output;
    }

    public function save_edit_category(){
        $account = $_POST['account'];
        $id = $_POST['id_category'];

        $this->M_layout->save_edit_category($id, $account);


    }
    public function save_edit_subcategory(){
        $name = $_POST['name_sub'];
        $id = $_POST['id_subcategory'];


        $this->M_layout->save_edit_subcategory($id, $name);
    }


}