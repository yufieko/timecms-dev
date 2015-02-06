<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notif_model', '', true);
        $this->load->model('post_model', '', true);
    }

    public function index() {

    }

    function tambah(){
        $config['upload_path']          = './public/img/post/';
        $config['allowed_types']        = 'png|jpg|jpeg|gif';
        $config['max_size']             = 1000;
        $config['file_ext_tolower']     = TRUE;

        $this->load->library('upload', $config);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tambah-judul', 'Judul','trim|required|strip_tags|min_length[5]');
        $this->form_validation->set_rules('tambah-teks', 'Isi Artikel','trim|required|strip_tags');
        $this->form_validation->set_rules('tambah-time', 'Waktu','trim|required|strip_tags');
        $this->form_validation->set_rules('tambah-tag', 'Tag','trim|required|strip_tags');
        $this->form_validation->set_rules('tambah-status', 'Status','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $stringURL = str_replace(' ', '-', strtolower(addslashes($this->input->post('tambah-judul', TRUE)))); // Converts spaces to dashes
            if($_FILES['tambah-attachment']['size'] == 0) {
                $data = array(
                    'post_title' => addslashes($this->input->post('tambah-judul', TRUE)),
                    'post_content' => addslashes($this->input->post('tambah-teks', TRUE)),
                    'post_tag' => addslashes($this->input->post('tambah-tag', TRUE)),
                    'post_author' => $this->access->get_userid(),
                    'post_link' => $stringURL,
                    'post_status' => addslashes($this->input->post('tambah-status', TRUE))
                );

                $this->post_model->insert($data);

                $status['status'] = 1;
                $status['pesan'] = 'Artikel baru berhasil ditambahkan';
            } else {
                if (!$this->upload->do_upload('tambah-attachment')) {
                    $status['status'] = 0;
                    $status['pesan'] = $this->upload->display_errors();
                } else {
                    $data = array(
                        'post_title' => addslashes($this->input->post('tambah-judul', TRUE)),
                        'post_content' => addslashes($this->input->post('tambah-teks', TRUE)),
                        'post_tag' => addslashes($this->input->post('tambah-tag', TRUE)),
                        'post_author' => $this->access->get_userid(),
                        'post_pic' => $this->upload->data('file_name'),
                        'post_link' => $stringURL,
                        'post_status' => addslashes($this->input->post('tambah-status', TRUE))
                    );

                    $this->post_model->insert($data);

                    $status['status'] = 1;
                    $status['pesan'] = 'Artikel baru berhasil ditambahkan';
                }
                @unlink($_FILES['tambah-attachment']);
            }

        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function edit(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('edit-judul', 'Judul','trim|required|strip_tags|min_length[5]');
        $this->form_validation->set_rules('edit-status', 'Status','required|strip_tags');
        $this->form_validation->set_rules('edit-teks', 'Isi Artikel','trim|required|strip_tags');
        $this->form_validation->set_rules('edit-tag', 'Tag','trim|required|strip_tags');
        $this->form_validation->set_rules('edit-id', 'Agenda ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $stringURL = str_replace(' ', '-', strtolower(addslashes($this->input->post('edit-judul', TRUE))));
            $postid = addslashes($this->input->post('edit-id', TRUE));
            if($_FILES['edit-attachment']['size'] == 0) {
                $data = array(
                    'post_title' => addslashes($this->input->post('edit-judul', TRUE)),
                    'post_content' => addslashes($this->input->post('edit-teks', TRUE)),
                    'post_tag' => addslashes($this->input->post('edit-tag', TRUE)),
                    'post_link' => $stringURL,
                    'post_status' => addslashes($this->input->post('tambah-status', TRUE))
                );

                $this->post_model->update($postid, $data);

                $status['status'] = 1;
                $status['pesan'] = 'Perubahan pada Agenda berhasil disimpan';
            } else {
                if (!$this->upload->do_upload('edit-attachment')) {
                    $status['status'] = 0;
                    $status['pesan'] = $this->upload->display_errors();
                } else {
                    $data = array(
                        'post_title' => addslashes($this->input->post('edit-judul', TRUE)),
                        'post_content' => addslashes($this->input->post('edit-teks', TRUE)),
                        'post_tag' => addslashes($this->input->post('edit-tag', TRUE)),
                        'post_pic' => $this->upload->data('file_name'),
                        'post_link' => $stringURL,
                        'post_status' => addslashes($this->input->post('edit-status', TRUE))
                    );

                    $this->post_model->update($postid, $data);

                    $status['status'] = 1;
                    $status['pesan'] = 'Perubahan pada Artikel berhasil disimpan';
                }
                @unlink($_FILES['edit-attachment']);
            }

        }else{
          $status['status'] = 0;
          $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function hapus(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('hapus-id', 'User ID','required|strip_tags');

      if($this->form_validation->run() == TRUE){
        $id = addslashes($this->input->post('hapus-id', TRUE));
        $this->post_model->update($id,array("post_status" => 2));

        $status['status'] = 1;
        $status['pesan'] = 'Artikel "' . addslashes($this->input->post('hapus-uname', TRUE)) . '" berhasil dihapus';
      }else{
        $status['status'] = 0;
        $status['pesan'] = validation_errors();
      }

      echo json_encode($status);
    }

    public function getartikel() {
        // variable initialization
        $search = "";
        $start = 0;
        $rows = 6;

        // get search value (if any)
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $search = $_GET['sSearch'];
        }

        // limit
        $start = $this->get_start();
        $rows = $this->get_rows();

        // run query to get user listing
        $query = $this->post_model->get_daftarpost($start, $rows, $search);
        $iFilteredTotal = $query->num_rows();
        $iTotal = $this->post_model->get_count_daftarpost($search)->row()->Total;

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        // get result after running query and put it in array
        $i = $start;
        $counter = $query->result();
        foreach ($counter as $temp) {
            $record = array();
            $record[] = $temp->ID;
            $record[] = $temp->Title;
            $record[] = $temp->Author;
            $record[] = $temp->Created;
            $record[] = $temp->Status;
            $record[] = '<button class="btn btn-xs btn-flat btn-danger" onclick="modalhapus(\''.$temp->ID.'\', \''.addslashes($temp->Title).'\', \''.addslashes($temp->Author).'\')"><i class="fa fa-times"></i> Hapus</button>
                        <button class="btn btn-xs btn-flat btn-primary" onclick="modaledit(\''.$temp->ID.'\',\''.addslashes($temp->Title).'\',\''.addslashes($temp->StatusID).'\',\''.addslashes($temp->Content).'\',\''.addslashes($temp->Tag).'\')"><i class="fa fa-pencil"></i> Edit</button>
                         <button class="btn btn-xs btn-flat btn-success" onclick="window.open(\''.$temp->Link.'\')"><i class="fa fa-eye"></i> Lihat</button>';

            $output['aaData'][] = $record;
        }
        // format it to JSON, this output will be displayed in datatable
        echo json_encode($output);
    }

    /**
     * fungsi tambahan
     *
     *
     */
    function get_start() {
        $start = 0;
        if (isset($_GET['iDisplayStart'])) {
            $start = intval($_GET['iDisplayStart']);

            if ($start < 0)
                $start = 0;
        }

        return $start;
    }

    function get_rows() {
        $rows = 6;
        if (isset($_GET['iDisplayLength'])) {
            $rows = intval($_GET['iDisplayLength']);
            if ($rows < 5 || $rows > 500) {
                $rows = 6;
            }
        }

        return $rows;
    }

    function get_sort_dir() {
        $sort_dir = "ASC";
        $sdir = strip_tags($_GET['sSortDir_0']);
        if (isset($sdir)) {
            if ($sdir != "asc") {
                $sort_dir = "DESC";
            }
        }

        return $sort_dir;
    }

    public function get_databox() {
        // data buat box
        $data['boxartikel'] = $this->post_model->get_totals(array());
        $data['boxdraft'] = $this->post_model->get_totals(array("post_status" => 0));
        $data['boxpublish'] = $this->post_model->get_totals(array("post_status" => 1));
        $data['boxsuka'] = $this->post_model->get_like();

        echo json_encode($data);
    }

}

?>