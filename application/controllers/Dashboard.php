<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->model('comment_model', '', true);
        $this->load->model('data_model', '', true);
        $this->load->model('notif_model', '', true);
        $this->load->model('post_model', '', true);
    }

    public function index() {
        $datah['title'] = 'Dashboard';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // memberikan salam ke user yg login
        $datestring = "%H:%i:%s";
        $tglstring = "%d-%m-%Y";
        $waktu = '';
        $jam = mdate($datestring, now());
        $tanggal = mdate($tglstring, now());
        if ($jam < 4) {
            $waktu = "Dini Hari ";
        } else if ($jam < 11) {
            $waktu = "Pagi ";
        } else if ($jam < 15) {
            $waktu = "Siang ";
        } else if ($jam < 18) {
            $waktu = "Sore ";
        } else if ($jam < 24) {
            $waktu = "Malam ";
        }

        $id = $this->access->get_userid();

        $data['welcome_message'] = "Selamat " . $waktu . ucfirst($this->access->get_username()) . ". Hari ini tanggal " . $tanggal;
        $data['dataartikel'] = $this->post_model->select(array("post_status" => "1"),5);
        $data['datakomen'] = $this->comment_model->select(array("comment_status" => "1"),5);
        $data['datapenulis'] = $this->user_model->select(array("user_role" => "41"),8);
        //$data['datanotif'] = $this->notif_model->get_notif(array("notif_to" => $id, "notif_read !=" => 2),5);

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('dashboard_view',$data);
    }

    public function logout() {
        $this->access->logout();
        redirect('login');
    }

    public function notifikasi() {
        $datah['title'] = 'Notifikasi';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        $id = "";
        if($this->access->get_ukmid() == 0) { $id = $this->access->get_userid();
        } else { $id = $this->access->get_ukmid(); }

        $data['datanotif'] = $this->notif_model->get_notif(array("notif_to" => $id, "notif_read !=" => 2));

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('notifikasi_view',$data);
    }

    public function reminder() {
        $datah['title'] = 'Reminder';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        $id = "";
        if($this->access->get_ukmid() == 0) { $id = $this->access->get_userid();
        } else { $id = $this->access->get_ukmid(); }

        $data['datanotif'] = $this->notif_model->get_notif(array("notif_from" => $id));
        $data['dataukm'] = $this->ukm_model->get_ukm(array())->result();
        $data['datatiperem'] = $this->notif_model->get_daftartipe(array());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('reminder_view',$data);
    }

    public function kategori() {
        $datah['title'] = 'Kategori';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('laporan_view');
    }

    public function log() {
        $datah['title'] = 'Log';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datalog'] =  $this->log_model->get_log(array());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('log_view',$data);
    }

    public function user() {
        $datah['title'] = 'User';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datarole'] = $this->user_model->get_role();
        $data['dataukm'] = $this->ukm_model->get_ukm(array())->result();

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('user_view',$data);
    }
    
    public function artikel() {
        $datah['title'] = 'Artikel';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datauser'] = $this->user_model->get_user(array("user_role" => "42"))->result();

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('ukm_view',$data);
    }

    public function penulis() {
        $datah['title'] = 'Penulis';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        //$data['datauser'] = $this->user_model->get_user(array("user_role" => "42"));

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('anggota_view');
    }

    public function agenda() {
        $datah['title'] = 'Agenda';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('agenda_view');
    }

    public function profil() {
        $datah['title'] = 'Profil';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datauser'] = $this->user_model->get_user(array("user.user_id" => $this->access->get_userid() ))->row();
        $data['dataakses'] = $this->user_model->get_userakses(array("user_akses.role_id" => $this->access->get_roleid() ))->result();

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('profil_view',$data);
    }

    public function get_databox() {
        $id = $this->access->get_userid();
 
        $data['boxtotalpost'] = $this->post_model->get_total(FALSE);
        $data['boxtotalcomment'] = $this->comment_model->get_total(FALSE,1);
        $data['boxauthor'] = $this->user_model->get_total(array("user_role" => "41"));
        $data['boxnotif'] = $this->notif_model->get_total(array("notif_to" => $id, "notif_read !=" => 2));

        echo json_encode($data);
    }

}

?>
