<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data = $this->data;
        $this->db->where('id >', 3);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Menu Management";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->input->post('submit') == "add") {
                $this->addMenu();
            } elseif ($this->input->post('submit') == "update") {
                $this->editMenu();
            }
        }
    }

    public function addMenu()
    {
        $insert = $this->input->post();
        unset($insert['submit']);
        $this->db->insert('user_menu', $insert);
        // $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">New menu added</div>');
        $this->session->set_flashdata('flash', 'New menu added');
        redirect('menu');
    }

    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('flash', 'Deleting menu success');
        redirect('menu');
    }

    public function editMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $this->db->where('id', $id);
        $this->db->update('user_menu', ['menu' => $menu]);
        $this->session->set_flashdata('flash', 'Updating menu success');
        redirect('menu');
    }

    public function getMenu()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        echo json_encode($this->db->get('user_menu')->row());
    }

    public function subMenu()
    {
        $data = $this->data;
        $data['title'] = "Submenu Management";
        $data['submenu'] = $this->Menu_model->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('menu_id', 'Menu ID', 'trim|required');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');
        $this->form_validation->set_rules('icon', 'Icon', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $insert = $this->input->post();
            if ($insert['submit'] == 'add') {
                $this->addSubMenu($insert);
            } elseif ($insert['submit'] == 'update') {
                $this->editSubMenu($insert);
            }
        }
    }
    public function addSubMenu($insert)
    {
        unset($insert['submit']);
        $this->db->insert('user_sub_menu', $insert);
        $this->session->set_flashdata('flash', 'New sub-menu added');
        redirect('menu/submenu');
    }

    public function editSubMenu($insert)
    {
        $key = array_keys($insert);
        (!array_search("is_active", $key) ? $insert["is_active"] = '0' : null);

        unset($insert['submit']);

        $this->db->where('id', $insert['id']);
        $this->db->update('user_sub_menu', $insert);
        $this->session->set_flashdata('flash', 'Updating sub-menu success');
        redirect('menu/submenu');
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('flash', 'Deleting sub-menu success');
        redirect('menu/submenu');
    }
}
