<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Out extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('out_model');
        $this->load->model('ijin_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'out/index/';
        $config['total_rows'] = $this->out_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'out.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $out = $this->out_model->index_limit($config['per_page'], $start);

        $data = array(
            'out_data' => $out,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('tbl_out_list', $data);
    }

    public function search() {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'out/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'out/index/';
        }

        $config['total_rows'] = $this->out_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'out/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $out = $this->out_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'out_data' => $out,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_out_list', $data);
    }

    public function read($id) {
        $row = $this->out_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_out' => $row->id_out,
                'nomor_permohonan' => $row->nomor_permohonan,
                'tanggal_permohonan' => $row->tanggal_permohonan,
                'id_ijin' => $row->id_ijin,
                'nama_perusahaan' => $row->nama_perusahaan
            );
            $this->load->view('tbl_out_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('out'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('out/create_action'),
            'id_out' => set_value('id_out'),
            'nomor_permohonan' => set_value('nomor_permohonan'),
            'tanggal_permohonan' => set_value('tanggal_permohonan'),
            'id_ijin' => $this->out_model->dropdown_ijin(),
            'ijin_selected' => $this->input->post('id_ijin') ? $this->input->post('id_ijin') : set_value('id_ijin'),
            'id_perusahaan' => $this->out_model->dropdown_perusahaan(),
            'perusahaan_selected' => $this->input->post('id_perusahaan') ? $this->input->post('id_perusahaan') : set_value('id_perusahaan')
        );
        $this->load->view('tbl_out_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nomor_permohonan' => $this->input->post('nomor_permohonan', TRUE),
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan', TRUE),
                'id_ijin' => $this->input->post('id_ijin', TRUE),
                'id_perusahaan' => $this->input->post('id_perusahaan', TRUE)
            );

            $this->out_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('out'));
        }
    }

    public function update($id) {
        $row = $this->out_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('out/update_action'),
                'id_out' => set_value('id_out', $row->id_out),
                'nomor_permohonan' => set_value('nomor_permohonan', $row->nomor_permohonan),
                'tanggal_permohonan' => set_value('tanggal_permohonan', $row->tanggal_permohonan),
                'id_ijin' => $this->out_model->dropdown_ijin(),
                'ijin_selected' => $this->input->post('id_ijin') ? $this->input->post('id_ijin') : set_value('id_ijin', $row->id_ijin),
                'id_perusahaan' => $this->out_model->dropdown_perusahaan(),
                'perusahaan_selected' => $this->input->post('id_perusahaan') ? $this->input->post('id_perusahaan') : set_value('id_perusahaan', $row->id_perusahaan)
            );
            $this->load->view('tbl_out_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('out'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_out', TRUE));
        } else {
            $data = array(
                'nomor_permohonan' => $this->input->post('nomor_permohonan', TRUE),
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan', TRUE),
                'id_ijin' => $this->input->post('id_ijin', TRUE)
            );

            $this->out_model->update($this->input->post('id_out', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('out'));
        }
    }

    public function delete($id) {
        $row = $this->out_model->get_by_id($id);

        if ($row) {
            $this->out_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('out'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('out'));
        }
    }

    public function upload($id, $error = NULL) {
        $row = $this->out_model->get_by_id($id);

        $data = array(
            'button' => 'UPLOAD MASTER LIST',
            'action' => site_url('Out/upload_proses'),
            'id_out' => set_value('id_out', $row->id_out),
            'nomor_permohonan' => set_value('nomor_permohonan', $row->nomor_permohonan),
            'tanggal_permohonan' => set_value('tanggal_permohonan', $row->tanggal_permohonan),
            'id_ijin' => $this->out_model->dropdown_ijin(),
            'ijin_selected' => $this->input->post('id_ijin') ? $this->input->post('id_ijin') : set_value('id_ijin', $row->id_ijin),
            'error' => $error['error'] // ambil parameter error
        );

        $this->load->view('upload_masterlist_form', $data);
    }

    function upload_proses() {
        $config['upload_path'] = './temp_upload/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = '100000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->upload($this->input->post('id_out'), $error);
        } else {
            $upload_data = $this->upload->data();

            // load library Excell_Reader
            $this->load->library('Excel_reader');

            //tentukan file
            $this->excel_reader->setOutputEncoding('230787');
            $file = $upload_data['full_path'];
            $this->excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // array data
            $data = $this->excel_reader->sheets[0];
            $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                if ($data['cells'][$i][1] == '')
                    break;
                $dataexcel[$i - 1]['nama_barang'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['jumlah_barang'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['satuan_barang'] = $data['cells'][$i][3];
            }

            //load model
            $this->load->model('Out_model');
            $this->Out_model->loaddata($dataexcel);

            //delete file
            $file = $upload_data['file_name'];
            $path = './temp_upload/' . $file;
            unlink($path);
            //redirect ke halaman awal
            redirect(site_url('out'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nomor_permohonan', ' ', 'trim|required');
        $this->form_validation->set_rules('tanggal_permohonan', ' ', 'trim|required');

        $this->form_validation->set_rules('id_out', 'id_out', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

;

/* End of file Out.php */
/* Location: ./application/controllers/Out.php */