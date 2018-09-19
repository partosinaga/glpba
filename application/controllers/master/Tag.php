<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('master/M_tag');
        $this->load->helper('url');
    }

    public function view_tag()
    {
        $data['page'] = 'master/view_tag';
        $data['tag'] = $this->M_tag->get_data();
        $this->load->view('template/template', $data);
    }

    public function add_tag()
    {
        $name_tag = $this->input->post('name_tag');
        $status = $this->input->post('status');

        $data = array('name_tag' => $name_tag,
            'status' => $status
        );
        $this->M_tag->add($data, 'tag');
        $this->session->set_flashdata('success', 'Saved!');
        redirect('master/tag/view_tag');
    }

    public function delete_tag($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tag');
        $this->session->set_flashdata('success', 'DELETED');
        redirect('master/tag/view_tag');
    }

    public function edit_tag()
    {
        $data['page'] = 'master/edit_tag';
        $id = $this->uri->segment(4);
        $data['tag'] = $this->M_tag->get_edit($id);
        $this->load->view('template/template', $data);
    }

    public function save_edit()
    {
        $id = $this->input->post('id');
        $name_tag = $this->input->post('name_tag');
        $status = $this->input->post('status');


        $this->M_tag->save_edit($id, $name_tag, $status);
        $this->session->set_flashdata('success', 'UPDATED');
        redirect('master/tag/view_tag');
    }

}
