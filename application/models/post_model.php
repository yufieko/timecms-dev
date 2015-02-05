<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        $this->db->insert('tc_post', $data);
    }

    function delete($id) {
        $this->db->where('post_id', $id);
        $this->db->delete('tc_post');
    }

    function select($data,$no) {
        $this->db->select('*');
        $this->db->from('tc_post');
        $this->db->where($data);
        $this->db->limit($no);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query : NULL);
    }

    function update($id, $data) {
        $this->db->where('post_id', $id);
        $this->db->update('tc_post', $data);
    }

    function get_total($tanggal = FALSE) {
        if($tanggal == TRUE){ 
            $tanggal = mdate("%d-%m-%Y", now()); 

            $query = $this->db->query('SELECT count(*) as Total 
                FROM `tc_post` 
                WHERE DATE_FORMAT(`tc_post`.`post_created`,"%d-%m-%Y") = "'. $tanggal .'"');
            return $query->row()->Total;
        }else{
            $query = $this->db->query('SELECT count(*) as Total FROM `tc_post`');
            return $query->row()->Total;
        }
    }

    function get_totals($data) {
        $this->db->select('count(*) AS Total');
        $this->db->from('tc_post');
        $this->db->where($data);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
    }

    function get_like($tanggal = FALSE) {
        if($tanggal == TRUE){ 
            $tanggal = mdate("%d-%m-%Y", now()); 

            $query = $this->db->query('SELECT count(*) as Total 
                FROM `tc_like` 
                WHERE DATE_FORMAT(`tc_like`.`like_date`,"%d-%m-%Y") = "'. $tanggal .'"');
            return $query->row()->Total;
        }else{
            $query = $this->db->query('SELECT count(*) as Total FROM `tc_like`');
            return $query->row()->Total;
        }
    }

    function get_post($id = 0) {
        if($id == 0) {
            $this->db->select('tc_post.*, tc_role.role_name AS rolename');
            $this->db->from('tc_post');
            $this->db->join('tc_role', 'tc_post.user_role = tc_role.role_id');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('tc_post.*, tc_role.role_name AS rolename');
            $this->db->from('tc_post');
            $this->db->join('tc_role', 'tc_post.user_role = tc_role.role_id');
            $this->db->where('post_id',$id);
            $query = $this->db->get();
            return $query->row();
        } 
        
    }
    
    function get_daftarpost($start, $rows, $search) {
        
        $sql = "SELECT 
            `tc_post`.`post_id` AS ID,
            `tc_post`.`post_title` AS Title,
            `tc_post`.`post_created` AS Created,
            `tc_user`.`user_name` AS Author,
            `tc_post`.`post_link` AS Link,
            REPLACE(REPLACE(`tc_post`.`user_status`,'0','OFF'),'1','ON') AS Status
        FROM `tc_post` 
        INNER JOIN `tc_role` ON (`tc_post`.`user_role` = `tc_role`.`role_id`)
        WHERE `tc_post`.`post_id` LIKE '%".$search."%' 
                OR `tc_post`.`user_name` LIKE '%".$search."%' 
                OR `tc_post`.`user_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`tc_post`.`user_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `tc_post`.`user_created` LIKE '%".$search."%'
                OR `tc_role`.`role_name` LIKE '%".$search."%'
        ORDER BY `tc_post`.`post_id` LIMIT ".$start.",".$rows."";
        
        return $this->db->query($sql);
    }
    
    function get_count_daftaruser($search) {
               
        $sql = "SELECT 
            COUNT(*) AS Total
        FROM `tc_post` 
        INNER JOIN `tc_role` ON (`tc_post`.`user_role` = `tc_role`.`role_id`)
        WHERE `tc_post`.`post_id` LIKE '%".$search."%' 
                OR `tc_post`.`user_name` LIKE '%".$search."%' 
                OR `tc_post`.`user_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`tc_post`.`user_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `tc_post`.`user_created` LIKE '%".$search."%'
                OR `tc_role`.`role_name` LIKE '%".$search."%'";
        
        return $this->db->query($sql);
    }

}

?>