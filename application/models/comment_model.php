<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        $this->db->insert('tc_comment', $data);
    }

    function delete($id) {
        $this->db->where('comment_id', $id);
        $this->db->delete('tc_comment');
    }

    function select($data,$no) {
        $this->db->select('tc_comment.*, tc_post.post_title AS title, tc_post.post_tag AS post_tag, tc_post.post_link AS post_link');
        $this->db->from('tc_comment');
        $this->db->join('tc_post', 'tc_comment.comment_post = tc_post.post_id');
        $this->db->where($data);
        $this->db->limit($no);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query : NULL);
    }

    function update($id, $data) {
        $this->db->where('comment_id', $id);
        $this->db->update('tc_comment', $data);
    }

    function get_total($tanggal = FALSE, $parameter) {
        if($tanggal == TRUE){ 
            $tanggal = mdate("%d-%m-%Y", now()); 

            $query = $this->db->query('SELECT count(*) as Total 
                FROM `tc_comment` 
                WHERE `tc_comment`.`comment_status` = "'. $parameter .'"
                AND DATE_FORMAT(`tc_comment`.`comment_date`,"%d-%m-%Y") = "'. $tanggal .'"');
            return $query->row()->Total;
        }else{
            $query = $this->db->query('SELECT count(*) as Total
                FROM `tc_comment`
                WHERE `tc_comment`.`comment_status` = "'. $parameter .'"');
            return $query->row()->Total;
        }
    }

    function get_user($id = 0) {
        if($id == 0) {
            $this->db->select('tc_comment.*, tc_role.role_name AS rolename');
            $this->db->from('tc_comment');
            $this->db->join('tc_role', 'tc_comment.user_role = tc_role.role_id');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('tc_comment.*, tc_role.role_name AS rolename');
            $this->db->from('tc_comment');
            $this->db->join('tc_role', 'tc_comment.user_role = tc_role.role_id');
            $this->db->where('comment_id',$id);
            $query = $this->db->get();
            return $query->row();
        } 
        
    }
    
    function get_daftarpost($start, $rows, $search) {
        
        $sql = "SELECT 
            `tc_comment`.`comment_id` AS ID,
            `tc_comment`.`post_title` AS Title,
            `tc_comment`.`post_created` AS Created,
            `tc_user`.`user_name` AS Author,
            `tc_comment`.`post_link` AS Link,
            REPLACE(REPLACE(`tc_comment`.`user_status`,'0','OFF'),'1','ON') AS Status
        FROM `tc_comment` 
        INNER JOIN `tc_role` ON (`tc_comment`.`user_role` = `tc_role`.`role_id`)
        WHERE `tc_comment`.`comment_id` LIKE '%".$search."%' 
                OR `tc_comment`.`user_name` LIKE '%".$search."%' 
                OR `tc_comment`.`user_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`tc_comment`.`user_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `tc_comment`.`user_created` LIKE '%".$search."%'
                OR `tc_role`.`role_name` LIKE '%".$search."%'
        ORDER BY `tc_comment`.`comment_id` LIMIT ".$start.",".$rows."";
        
        return $this->db->query($sql);
    }
    
    function get_count_daftaruser($search) {
               
        $sql = "SELECT 
            COUNT(*) AS Total
        FROM `tc_comment` 
        INNER JOIN `tc_role` ON (`tc_comment`.`user_role` = `tc_role`.`role_id`)
        WHERE `tc_comment`.`comment_id` LIKE '%".$search."%' 
                OR `tc_comment`.`user_name` LIKE '%".$search."%' 
                OR `tc_comment`.`user_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`tc_comment`.`user_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `tc_comment`.`user_created` LIKE '%".$search."%'
                OR `tc_role`.`role_name` LIKE '%".$search."%'";
        
        return $this->db->query($sql);
    }

}

?>