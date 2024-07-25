<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhoneModel extends CI_Model {

    public function getAllPhoneRecords() {
        return $this->db->get('phone_record')->result();
    }

    public function getPhoneRecordByEmail($email) {
        return $this->db->get_where('phone_record', array('email' => $email))->row();
    }

    public function getPhoneRecordById($id) {
        return $this->db->get_where('phone_record', array('id' => $id))->row();
    }

     public function getPhoneRecordsCount() {
        return $this->db->count_all('phone_record');
    }

    public function getPaginatedPhoneRecords($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('phone_record');
        return $query->result();
    }

    public function create($data) {
        return $this->db->insert('phone_record', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('phone_record', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('phone_record');
    }
}


?>
