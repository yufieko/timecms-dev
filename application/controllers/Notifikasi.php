<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notif_model', '', true);
        $this->load->model('log_model', '', true);
    }

    public function index() {

    }

    function hapusnotif(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('hapus-id', 'Role ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('hapus-id', TRUE));
            if($id == 40) {
                $this->notif_model->updateall(array("notif_to" => $this->access->get_userid()), array("notif_read" => 2));

                $status['status'] = 1;
                $status['pesan'] = 'Semua notifikasi berhasil dihapus';
            } else {
                $status['status'] = 0;
                $status['pesan'] = 'Anda tidak punya hak untuk menghapus Log';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function bacanotif(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bacasatu-id', 'Role ID','required|strip_tags');
        $this->form_validation->set_rules('notifid', 'Notif ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('bacasatu-id', TRUE));
            $notifid = addslashes($this->input->post('notifid', TRUE));
            if($id == 40) {
                $this->notif_model->updateall(array("notif_to" => $this->access->get_userid(), "notif_id" => $notifid), array("notif_read" => 1));

                $status['status'] = 1;
                $status['pesan'] = 'Notifikasi berhasil ditandai telah dibaca';
            } else {
                $status['status'] = 0;
                $status['pesan'] = 'Anda tidak punya hak untuk menandai notifikasi';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function bacasemua(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('baca-id', 'Role ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('baca-id', TRUE));
            if($id == 40) {
                $this->notif_model->updateall(array("notif_to" => $this->access->get_userid(), "notif_read" => 0), array("notif_read" => 1));

                $status['status'] = 1;
                $status['pesan'] = 'Semua notifikasi berhasil ditandai telah dibaca';
            } else {
                $status['status'] = 0;
                $status['pesan'] = 'Anda tidak punya hak untuk menandai notifikasi';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

}

?>
