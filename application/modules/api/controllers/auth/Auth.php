<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/api/controllers/MyRest.php';

class Auth extends MyRest {

    function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth_api', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'auth_conf_api'), $this->config->item('error_end_delimiter', 'auth_conf_api'));
        $this->lang->load('auth_api');
    }

    // create a new group
    function signUp_post() {
        //validate form input
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('logintype', 'logintype', 'required');
        $this->form_validation->set_rules('mobileNo', 'mobileNo', 'required|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]|max_length[10]');

        $logintype = $this->input->post('logintype');

        if ($logintype) {
            $this->form_validation->set_rules('socialId', 'Social Id', 'trim|required|is_unique[qyura_userSocial.userSocial_socialId,userSocial_deleted=0]');
            $this->form_validation->set_rules('image', 'Image', 'trim|required');
            $this->form_validation->set_rules('userName', 'user name', 'trim|required');
        } else {
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[qyura_users.users_email,qyura_users.users_deleted=0]');
        }

        if ($this->form_validation->run() == true) {
            
        } else {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        }

        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
            $username = explode('@', $email);
            $username = $username[0];
        }
        if ($this->form_validation->run() == true && $user_id = $this->Ion_auth_api->register($username, $password, $email, $additional_data)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $profData = array(
                'patientDetails_patientName'=>$this->input->post('name'),
                'patientDetails_usersId'=>$user_id
            );
            $this->Ion_auth_api->setPatientProf($profData);
            $response = array('status' => TRUE, 'message' => $this->Ion_auth_api->messages());
            $this->response($response, 400);
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $message = (validation_errors() ? validation_errors() : ($this->Ion_auth_api->errors() ? $this->Ion_auth_api->errors() : $this->session->flashdata('message')));
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        }
    }

    //activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->Ion_auth_api->activate($id, $code);
        } else if ($this->Ion_auth_api->is_admin()) {
            $activation = $this->Ion_auth_api->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->Ion_auth_api->messages());
            redirect("auth", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->Ion_auth_api->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    //deactivate the user
    function deactivate($id = NULL) {
        if (!$this->Ion_auth_api->logged_in() || !$this->Ion_auth_api->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->Ion_auth_api->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->Ion_auth_api->logged_in() && $this->Ion_auth_api->is_admin()) {
                    $this->Ion_auth_api->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    //create a new user
    function create_user() {
        
        $this->data['title'] = "Create User";

        if (!$this->Ion_auth_api->logged_in() || !$this->Ion_auth_api->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'auth_conf_api');

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'auth_conf_api') . ']|max_length[' . $this->config->item('max_password_length', 'auth_conf_api') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }
        
        if ($this->form_validation->run() == true && $this->Ion_auth_api->register($username, $password, $email, $additional_data)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->Ion_auth_api->messages());
            redirect("auth", 'refresh');
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->Ion_auth_api->errors() ? $this->Ion_auth_api->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->_render_page('auth/create_user', $this->data);
        }
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

}
