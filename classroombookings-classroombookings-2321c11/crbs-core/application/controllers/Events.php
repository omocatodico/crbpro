<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Events_model');
    }

    public function index()
    {
        $data['events'] = $this->Events_model->get_all_events();
        $this->load->view('events_index', $data);
    }

    public function today()
    {
        $today = date('Y-m-d');
        $events_today = $this->Events_model->get_events_by_date($today);
        $data['events_today'] = $events_today;
        $this->load->view('events_today', $data);
    }

    // ...other methods...
}