<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel', 'user');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[50]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            if ($this->user->create($data)) {
                $this->session->set_flashdata('success', 'Registration successful. Please login.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                redirect('register');
            }
        }
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->user->getByUsername($username);

            if ($user && password_verify($password, $user->password)) {
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($user_data);
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                log_message('error', 'Invalid login attempt: ' . $username);
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login'); 
    }
}
?>
