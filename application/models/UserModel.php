<?php
class UserModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function create($data) {
        return $this->db->insert('users', $data);
    }

    public function getByUsername($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }

    public function getByEmail($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}
?>
