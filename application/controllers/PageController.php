<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PhoneModel', 'phone');
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'session', 'pagination'));
        $this->is_logged_in();
    }

    private function is_logged_in() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $config['base_url'] = site_url('PageController/index');
        $config['total_rows'] = $this->phone->getPhoneRecordsCount();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['phone_records'] = $this->phone->getPaginatedPhoneRecords($config['per_page'], $page);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('phone_record/index', $data);
    }

    public function create() {
        $this->load->view('phone_record/create');
    }

    public function store() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('phone_record/create');
        } else {
            $name = $this->input->post('name');
            $phone_number = $this->input->post('phone_number');
            $email = $this->input->post('email');

            $existing_record = $this->phone->getPhoneRecordByEmail($email);

            if ($existing_record) {
                $this->session->set_flashdata('error', 'Record with this email already exists.');
                redirect('create');
            } else {
                $data = array(
                    'name' => $name,
                    'phone_number' => $phone_number,
                    'email' => $email
                );

                if (!empty($_FILES['image']['name'])) {
                    $upload_path = './uploads/';

                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }

                    $config['upload_path'] = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2048;
                    $config['file_name'] = time() . '_' . $_FILES['image']['name'];

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $uploadData = $this->upload->data();
                        $data['image'] = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('create');
                    }
                }

                $this->phone->create($data);
                $this->session->set_flashdata('success', 'Record created successfully.');
                redirect('home');
            }
        }
    }

    public function edit($id) {
        $data['record'] = $this->phone->getPhoneRecordById($id);

        if (!$data['record']) {
            show_404();
        }

        $this->load->view('phone_record/edit', $data);
    }

    public function update($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['record'] = $this->phone->getPhoneRecordById($id);
            $this->load->view('phone_record/edit', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'phone_number' => $this->input->post('phone_number'),
                'email' => $this->input->post('email')
            );

            if (!empty($_FILES['image']['name'])) {
                $upload_path = './uploads/';

                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['image']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $data['image'] = $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('edit/' . $id);
                }
            }

            if ($this->phone->update($id, $data)) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update record.');
            }

            redirect('home');
        }
    }

    public function destroy($id) {
        if (!$id) {
            show_404();
        }

        if ($this->phone->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record.');
        }

        redirect('home');
    }

}
?>
