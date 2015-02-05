<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notif_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->CI = get_instance();
    }

    function insert($data) {
        $this->db->insert('tc_notif', $data);
    }

    function delete($id) {
        $this->db->where('notif_id', $id);
        $this->db->delete('tc_notif');
    }

    function deleteall() {
        $this->db->empty_table('tc_notif');   
    }

    function updateall($parameter,$data) {
        $this->db->where($parameter);
        $this->db->update('tc_notif', $data);
    }

    function selectone($id) {
        $this->db->select('*');
        $this->db->from('tc_notif');
        $this->db->where('notif_id', $id);
        $query = $this->db->get();
        return $query;
    }

    function update($id, $data) {
        $this->db->where('notif_id', $id);
        $this->db->update('tc_notif', $data);
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('tc_notif');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('tc_notif');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function get_daftartipe($parameter) {
        $this->db->select('*');
        $this->db->from('tipenotif');
        $this->db->where($parameter);
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_notif($parameter,$limit = 0) {
        $this->db->select('tc_notif.*, tc_notiftype.*, tc_user.user_name AS user_name');
        $this->db->from('tc_notif');
        $this->db->join('tc_notiftype', 'tc_notif.notif_type = tc_notiftype.type_id');
        $this->db->join('tc_user', 'tc_notif.notif_to = tc_user.user_id');
        $this->db->where($parameter);
        $this->db->limit($limit);
        $this->db->order_by("notif_date","desc");
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_count($tanggal = null) {
        if($tanggal == null) {
            $this->db->select('count(*) as Total');
            $this->db->from('tc_notif');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('count(*) as Total');
            $this->db->from('tc_notif');
            $this->db->where('notif_time', $tanggal);
            $query = $this->db->get();
            return $query;
        }
    }

}

?>
