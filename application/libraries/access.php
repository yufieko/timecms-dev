<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access {

    public $user;

    function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->helper('cookie');
        $this->CI->load->model('user_model');

        $this->user_model = & $this->CI->user_model;
    }

    /**
     * proses login
     * 0 = username tak ada
     * 1 = sukses
     * 2 = password salah
     * @param unknown_type $username
     * @param unknown_type $password
     * @return boolean
     */
    function login($username, $password) {
        $result = $this->user_model->get_login_info($username);
        if ($result) {
            $password = sha1($password);
            if ($password == $result->user_pass) {
                    $this->CI->session->set_userdata('time_user_id', $result->user_id);
                    $this->CI->session->set_userdata('time_username', $result->user_name);
                    $this->CI->session->set_userdata('time_role', $result->rolename);
                    $this->CI->session->set_userdata('time_nama', $result->user_data);
                    $this->CI->session->set_userdata('time_role_id', $result->user_role);

                    $this->user_model->update($result->user_id, array('user_status' => "1"));

                    return 1;
            } else {
                return 2;
            }
        }
        return 0;
    }

    /**
     * cek apakah sudah login
     * @return boolean
     */
    function is_login() {
        return (($this->CI->session->userdata('time_user_id')) ? TRUE : FALSE);
    }

    function cek_akses($kode_menu) {
        $role_cookie = $this->CI->session->userdata('time_role_id');
        if ($this->user_model->get_akses($kode_menu, $role_cookie) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cek_akses_level($kode_menu, $role) {
        if ($this->user_model->get_akses($kode_menu, $role) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_username() {
        return $this->CI->session->userdata('time_username');
    }

    function get_nama() {
        return $this->CI->session->userdata('time_nama');
    }

    function get_role() {
        return $this->CI->session->userdata('time_role');
    }

    function get_roleid() {
        return $this->CI->session->userdata('time_role_id');
    }

    function get_userid() {
        return $this->CI->session->userdata('time_user_id');
    }
    
    function string_trim($string, $trimLength = 40) {
        $length = strlen($string);
        if ($length > $trimLength) {
            $count = 0;
            $prevCount = 0;
            $array = explode(" ", $string);
            foreach ($array as $word) {
                $count = $count + strlen($word);
                $count = $count + 1;
                if ($count > ($trimLength - 3)) {
                    return substr($string, 0, $prevCount) . "...";
                }
                $prevCount = $count;
            }
        } else {
            return $string;
        }
    }

    /**
     * logout
     */
    function logout() {
        $this->user_model->update($this->get_userid(), array('user_status' => "0"));
        
        $this->CI->session->unset_userdata('time_user_id');
        $this->CI->session->unset_userdata('time_username');
        $this->CI->session->unset_userdata('time_role');
        $this->CI->session->unset_userdata('time_usermail');
        $this->CI->session->unset_userdata('time_role_id');
        $this->CI->session->unset_userdata('time_urlke');
        $this->CI->session->unset_userdata('time_pesan');
    }

}