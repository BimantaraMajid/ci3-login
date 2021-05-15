<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        // role id
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        // menu id
        $menu_id = $queryMenu['id'];
        // check access 
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        // result and redirect if access not found
        ($userAccess->num_rows() < 1) ? redirect('auth/blocked') : null;
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);
    if ($result->num_rows() > 0) {
        return "checked";
    }
}