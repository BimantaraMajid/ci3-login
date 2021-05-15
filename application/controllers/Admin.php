<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = "Dashboard";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data = $this->data;
        $data['title'] = "Role";

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data_insert = $this->input->post();

            if ($data_insert['submit'] == 'add') {
                unset($data_insert['submit']);
                $this->db->insert('user_role', $data_insert);
                $this->session->set_flashdata('flash', 'New user role added');
                redirect('admin/role');
            } elseif ($data_insert['submit'] == 'edit') {
                unset($data_insert['submit']);
                $this->db->where('id', $data_insert['id']);
                $this->db->update('user_role', $data_insert);
                $this->session->set_flashdata('flash', 'Updating user role success');
                redirect('admin/role');
            }
        }
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('flash', 'Deleting user role success');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data = $this->data;
        $data['title'] = "Role Access";

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $data['menu'] = $this->db->get_where('user_menu', ['id !=' => 1])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }
}