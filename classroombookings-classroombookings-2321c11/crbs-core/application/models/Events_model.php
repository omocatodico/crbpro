public function get_events_by_date($date)
{
    $this->db->where('DATE(start_time)', $date);
    $query = $this->db->get('events');
    return $query->result_array();
}