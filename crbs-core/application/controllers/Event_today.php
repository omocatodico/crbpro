<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_today extends CI_Controller {

    public function index() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->database();
        $today = date('Y-m-d');
        
        // Eventi di oggi
        $this->db->select([
            'b.notes AS name',
            'p.time_start AS start_time',
            'p.time_end AS end_time',
            'r.name AS room',
            'b.notes AS description',
            'u.displayname AS user__displayname'
        ]);
        $this->db->from('bookings AS b');
        $this->db->join('periods p', 'b.period_id = p.period_id', 'INNER');
        $this->db->join('rooms r', 'b.room_id = r.room_id', 'INNER');
        $this->db->join('users u', 'b.user_id = u.user_id', 'LEFT');
        $this->db->where('b.status', 10);
        $this->db->where('b.date', $today);
        $query = $this->db->get();
        $data['events_today'] = $query ? $query->result_array() : [];

        // Eventi prossimi giorni (es. 7 giorni escluso oggi)
        $next_start = date('Y-m-d', strtotime('+1 day'));
        $next_end = date('Y-m-d', strtotime('+7 day'));
        $this->db->select([
            'b.date',
            'b.notes AS name',
            'p.time_start AS start_time',
            'p.time_end AS end_time',
            'r.name AS room',
            'b.notes AS description',
            'u.displayname AS user__displayname'
        ]);
        $this->db->from('bookings AS b');
        $this->db->join('periods p', 'b.period_id = p.period_id', 'INNER');
        $this->db->join('rooms r', 'b.room_id = r.room_id', 'INNER');
        $this->db->join('users u', 'b.user_id = u.user_id', 'LEFT');
        $this->db->where('b.status', 10);
        $this->db->where('b.date >=', $next_start);
        $this->db->where('b.date <=', $next_end);
        $query_next = $this->db->get();
        $data['events_next_days'] = $query_next ? $query_next->result_array() : [];

        $this->load->view('event_today/event_today', $data);
    }
}