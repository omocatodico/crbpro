<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_today extends CI_Controller {

    public function index() {
        $this->load->database();
        $today = date('Y-m-d');
        $this->db->select('name, start_time, end_time, room, description');
        $this->db->from('events');
        $this->db->where('DATE(start_time)', $today);
        $query = $this->db->get();
        $data['events_today'] = $query->result_array();
        $this->load->view('event_today', $data);
    }
}