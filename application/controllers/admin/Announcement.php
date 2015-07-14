<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Announcement extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/announcement_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/announcement/index/';
        $config['total_rows'] = $this->announcement_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/announcement.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $announcement = $this->announcement_model->index_limit($config['per_page'], $start);

        $data = array(
            'announcement_data' => $announcement,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_announcement_list', $data);
    }

    public function search() {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(3) == 'search') {
            $config['base_url'] = base_url() . 'admin/announcement/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/announcement/index/';
        }

        $config['total_rows'] = $this->announcement_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/announcement/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(5, 0);
        $announcement = $this->announcement_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'announcement_data' => $announcement,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/tbl_announcement_list', $data);
    }

    public function read($id) {
        $row = $this->announcement_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_announcement' => $row->id_announcement,
                'content' => $row->content,
                'status' => $row->status,
            );
            $this->load->view('admin/tbl_announcement_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/announcement'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/Announcement/create_action'),
            'id_announcement' => set_value('id_announcement'),
            'content' => set_value('content'),
            'status' => array('0' => 'Unpublised', '1' => 'Published'),
            'status_selected' => $this->input->post('status') ? $this->input->post('status') : set_value('status'),
        );
        $this->load->view('admin/tbl_announcement_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'content' => $this->input->post('content', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->announcement_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/announcement'));
        }
    }

    public function update($id) {
        $row = $this->announcement_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/announcement/update_action'),
                'id_announcement' => set_value('id_announcement', $row->id_announcement),
                'content' => set_value('content', $row->content),
                'status' => array('0' => 'Unpublised', '1' => 'Published'),
                'status_selected' => $this->input->post('status') ? $this->input->post('status') : set_value('status', $row->status),
            );
            $this->load->view('admin/tbl_announcement_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/announcement'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_announcement', TRUE));
        } else {
            $data = array(
                'content' => $this->input->post('content', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->announcement_model->update($this->input->post('id_announcement', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/announcement'));
        }
    }

    public function delete($id) {
        $row = $this->announcement_model->get_by_id($id);

        if ($row) {
            $this->announcement_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('announcement'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/announcement'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('content', ' ', 'trim|required');
        $this->form_validation->set_rules('status', ' ', 'trim|required|numeric');

        $this->form_validation->set_rules('id_announcement', 'id_announcement', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

;

/* End of file Announcement.php */
/* Location: ./application/controllers/Announcement.php */