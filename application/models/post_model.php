<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        $this->db->insert('49_tc_post', $data);
    }

    function delete($id) {
        $this->db->where('post_id', $id);
        $this->db->delete('49_tc_post');
    }

    function select($data,$no) {
        $this->db->select('*');
        $this->db->from('49_tc_post');
        $this->db->where($data);
        $this->db->limit($no);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query : NULL);
    }

    function update($id, $data) {
        $this->db->where('post_id', $id);
        $this->db->update('49_tc_post', $data);
    }

    function get_total($tanggal = FALSE) {
        if($tanggal == TRUE){ 
            $tanggal = mdate("%d-%m-%Y", now()); 

            $query = $this->db->query('SELECT count(*) as Total 
                FROM `49_tc_post` 
                WHERE DATE_FORMAT(`49_tc_post`.`post_created`,"%d-%m-%Y") = "'. $tanggal .'"');
            return $query->row()->Total;
        }else{
            $query = $this->db->query('SELECT count(*) as Total FROM `49_tc_post`');
            return $query->row()->Total;
        }
    }

    function get_totals($data) {
        $this->db->select('count(*) AS Total');
        $this->db->from('49_tc_post');
        $this->db->where($data);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
    }

    function get_like($tanggal = FALSE) {
        if($tanggal == TRUE){ 
            $tanggal = mdate("%d-%m-%Y", now()); 

            $query = $this->db->query('SELECT count(*) as Total 
                FROM `49_tc_like` 
                WHERE DATE_FORMAT(`49_tc_like`.`like_date`,"%d-%m-%Y") = "'. $tanggal .'"');
            return $query->row()->Total;
        }else{
            $query = $this->db->query('SELECT count(*) as Total FROM `49_tc_like`');
            return $query->row()->Total;
        }
    }

    function get_post($id = 0) {
        if($id == 0) {
            $this->db->select('49_tc_post.*, 49_tc_role.role_name AS rolename');
            $this->db->from('49_tc_post');
            $this->db->join('49_tc_role', '49_tc_post.user_role = 49_tc_role.role_id');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('49_tc_post.*, 49_tc_role.role_name AS rolename');
            $this->db->from('49_tc_post');
            $this->db->join('49_tc_role', '49_tc_post.user_role = 49_tc_role.role_id');
            $this->db->where('post_id',$id);
            $query = $this->db->get();
            return $query->row();
        } 
        
    }
    
    function get_daftarpost($start, $rows, $search) {
        
        $sql = "SELECT 
            `49_tc_post`.`post_id` AS ID,
            `49_tc_post`.`post_title` AS Title,
            `49_tc_post`.`post_created` AS Created,
            `49_tc_user`.`user_name` AS Author,
            `49_tc_post`.`post_content` AS Content,
            `49_tc_post`.`post_tag` AS Tag,
            `49_tc_post`.`post_link` AS Link,
            `49_tc_post`.`post_status` AS StatusID,
            REPLACE(REPLACE(`49_tc_post`.`post_status`,'0','Draft'),'1','Publish') AS Status
        FROM `49_tc_post` 
        INNER JOIN `49_tc_user` ON (`49_tc_post`.`post_author` = `49_tc_user`.`user_id`)
        WHERE `49_tc_post`.`post_status` != '2' AND (`49_tc_post`.`post_id` LIKE '%".$search."%' 
                OR `49_tc_post`.`post_title` LIKE '%".$search."%' 
                OR `49_tc_post`.`post_created` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`49_tc_post`.`post_status`,'0','Draft'),'1','Publish') LIKE '%".$search."%'
                OR `49_tc_user`.`user_name` LIKE '%".$search."%')
        ORDER BY `49_tc_post`.`post_id` DESC LIMIT ".$start.",".$rows."";
        
        return $this->db->query($sql);
    }
    
    function get_count_daftarpost($search) {
               
        $sql = "SELECT 
            COUNT(*) AS Total
        FROM `49_tc_post` 
        INNER JOIN `49_tc_user` ON (`49_tc_post`.`post_author` = `49_tc_user`.`user_id`)
        WHERE `49_tc_post`.`post_status` != '2' AND (`49_tc_post`.`post_id` LIKE '%".$search."%' 
                OR `49_tc_post`.`post_title` LIKE '%".$search."%' 
                OR `49_tc_post`.`post_created` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`49_tc_post`.`post_status`,'0','Draft'),'1','Publish') LIKE '%".$search."%'
                OR `49_tc_user`.`user_name` LIKE '%".$search."%')";
        
        return $this->db->query($sql);
    }

}

?>