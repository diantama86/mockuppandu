<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/department_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/department/index/';
        $config['total_rows'] = $this->department_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/department.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $department = $this->department_model->index_limit($config['per_page'], $start);

        $data = array(
            'department_data' => $department,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_department_list', $data);
    }

    public function search() {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(3) == 'search') {
            $config['base_url'] = base_url() . 'admin/department/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/department/index/';
        }

        $config['total_rows'] = $this->department_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/department/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(5, 0);
        $department = $this->department_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'department_data' => $department,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/tbl_department_list', $data);
    }

    public function read($id) {
        $row = $this->department_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_department' => $row->id_department,
                'nama_department' => $row->nama_department,
            );
            $this->load->view('admin/tbl_department_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/department'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/department/create_action'),
            'id_department' => set_value('id_department'),
            'nama_department' => set_value('nama_department'),
        );
        $this->load->view('admin/tbl_department_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_department' => $this->input->post('nama_department', TRUE),
            );

            if ($this->department_model->cek($this->input->post('nama_department', TRUE)) > 0) {
                $this->session->set_flashdata('message', 'Data Sudah Ada');
                redirect(site_url('admin/department'));
            } else {
                $this->department_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin/department'));
            }
        }
    }

    public function update($id) {
        $row = $this->department_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/department/update_action'),
                'id_department' => set_value('id_department', $row->id_department),
                'nama_department' => set_value('nama_department', $row->nama_department),
            );
            $this->load->view('admin/tbl_department_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/department'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_department', TRUE));
        } else {
            $data = array(
                'nama_department' => $this->input->post('nama_department', TRUE),
            );

            if ($this->department_model->cek($this->input->post('nama_department', TRUE)) > 0) {
                $this->session->set_flashdata('message', 'Data Sudah Ada');
                redirect(site_url('admin/department'));
            } else {
                $this->department_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin/department'));
            }
        }
    }

    public function delete($id) {
        $row = $this->department_model->get_by_id($id);

        if ($row) {
            $this->department_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/department'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/department'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nama_department', ' ', 'trim|required');

        $this->form_validation->set_rules('id_department', 'id_department', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

;

/* End of file Department.php */
/* Location: ./application/controllers/Department.php */