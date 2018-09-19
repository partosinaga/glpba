<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('master/M_contact');
        $this->load->helper('url');
    }

    public function view_contact()
    {
        $data['page'] = 'master/view_contact';
        $data['debtor'] = $this->M_contact->get_data();
        $this->load->view('template/template', $data);
    }

    public function add_contact()
    {

        $debtor_id = $this->input->post('debtor_id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $is_debtor = $this->input->post('is_debtor');
        $is_creditor = $this->input->post('is_creditor');

        $data = array('contact_id' => $debtor_id,
            'name' => $name,
            'address' => $address,
            'contact' => $contact,
            'is_debtor' =>$is_debtor,
            'is_creditor' => $is_creditor
        );
        $this->M_contact->add($data, 'contact');
        $this->session->set_flashdata('success', 'Saved!');
        redirect('master/contact/view_contact');

    }

    public function delete_contact($id)
    {
        $this->db->where('contact_id', $id);
        $this->db->delete('contact');
        $this->session->set_flashdata('success', 'DELETED');
        redirect('master/contact/view_contact');
    }

    public function edit_contact()
    {
        $data['page'] = 'master/edit_contact';
        $id = $this->uri->segment(4);
        $data['contact'] = $this->M_contact->get_edit($id);
        $this->load->view('template/template', $data);
    }

    public function save_edit()
    {
        $debtor_id = $this->input->post('debtor_id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $id_debtor = $this->input->post('is_debtor');
        $is_creditor = $this->input->post('is_creditor');


        $this->M_contact->save_edit($debtor_id, $name, $address, $contact, $id_debtor, $is_creditor);
        $this->session->set_flashdata('success', 'UPDATED');
        redirect('master/contact/view_contact');
    }

}
