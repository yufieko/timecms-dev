<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
    }

    public function index() {
        if(!$this->access->is_login()){
            if($this->session->userdata('time_pesan')) {
                $data['error'] = $this->session->userdata('time_pesan');
                $this->session->unset_userdata('time_pesan');
                $this->load->view('login_view',$data);
            } else {
                $this->load->view('login_view');
            }
		}else{
            redirect('dashboard');
		}
    }

    // fungsi untuk login
    public function dologin() {
        $this->load->library('form_validation');
        // mengambil username dan password dari text field yang ada di form login
        $this->form_validation->set_rules('username', 'Username','trim|required|strip_tags');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            $this->form_validation->set_rules('token', 'token', 'callback_check_login');
            if ($this->form_validation->run() == FALSE) {
                //Jika login gagal
                $status['accessGranted'] = 0;
                $status['error'] = validation_errors();
            } else {
                //Jika sukses
                $status['accessGranted'] = 1;
                $status['error'] = "";
            }
        } else {
            //Jika form validasi gagal
            $status['accessGranted'] = 0;
            $status['error'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function check_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $login = $this->access->login($username, $password);
        if ($login == 1) {
            return TRUE;
        } else if ($login == 2) {
            $this->form_validation->set_message('check_login', 'Password yang dimasukkan salah');
            return FALSE;
        } else {
            $this->form_validation->set_message('check_login', 'Username yang dimasukkan tidak dikenal');
            return FALSE;
        }
    }

/*    public function reset() {
        // ambil value dari form
        $uname = $this->input->post('username');
        $pass1 = $this->input->post('password');
        $pass2 = $this->input->post('password2');
        
        $cekuser = $cekpass = FALSE;
        $pesan = "";
        
        $data = array(
            'user_name' => $uname
        );
        $cek = $this->model_user->reset($data);
        if(!is_null($cek)) {
            $cekuser = TRUE;
            if($pass1 == $pass2) {
                $cekpass = TRUE;
                redirect('auth');
            }
        }
        
        if(!$cekuser) $pesan = "Username tidak terdaftar";
        elseif(!$cekpass) $pesan = "Password tidak sama";

        $newdata = array(
            'ukm_pesan' => $pesan
        );
        $this->session->set_userdata($newdata);
        redirect('auth/fals');
    }*/

}