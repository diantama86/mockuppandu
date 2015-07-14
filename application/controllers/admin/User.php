<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/user/index/';
        $config['total_rows'] = $this->User_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/user.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $user = $this->User_model->index_limit($config['per_page'], $start);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_user_list', $data);
    }

    public function user() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'user/user/';
        $config['total_rows'] = $this->User_model->total_rows_seksi();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'user.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $user = $this->User_model->index_limit_seksi($config['per_page'], $start);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_user_list', $data);
    }

    public function search() {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(3) == 'search') {
            $config['base_url'] = base_url() . 'admin/user/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/user/index/';
        }

        $config['total_rows'] = $this->User_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/user/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(5, 0);
        $user = $this->User_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/tbl_user_list', $data);
    }

    public function read($id) {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'username' => $row->username,
                'nama' => $row->nama_user,
                'jabatan' => $row->nama_jabatan,
                'department' => $row->nama_department
            );
            $this->load->view('admin/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/user'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/user/create_action'),
            'id_user' => set_value('id_user'),
            'nama' => set_value('nama'),
            'username' => set_value('username'),
            'id_jabatan' => $this->User_model->dropdown_jabatan(),
            'jabatan_selected' => $this->input->post('id_jabatan') ? $this->input->post('id_jabatan') : set_value('id_jabatan'),
            'id_department' => $this->User_model->dropdown_department(),
            'department_selected' => $this->input->post('id_department') ? $this->input->post('id_department') : set_value('id_department'),
        );
        $this->load->view('admin/tbl_user_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'nama_user' => $this->input->post('nama', TRUE),
                'password' => md5($this->input->post('password', TRUE)),
                'id_jabatan' => $this->input->post('id_jabatan', TRUE),
                'id_department' => $this->input->post('id_department', TRUE),
            );
            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/user'));
        }
    }

    public function update($id) {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/user/update_action'),
                'id_user' => set_value('id_user', $row->id_user),
                'username' => set_value('username', $row->username),
                'nama' => set_value('nama_user', $row->nama_user),
                'id_jabatan' => $this->User_model->dropdown_jabatan(),
                'jabatan_selected' => $this->input->post('id_jabatan') ? $this->input->post('id_jabatan') : set_value('id_jabatan', $row->id_jabatan),
                'id_department' => $this->User_model->dropdown_department(),
                'department_selected' => $this->input->post('id_department') ? $this->input->post('id_department') : set_value('id_department', $row->id_department),
            );
            $this->load->view('admin/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'nama_user' => $this->input->post('nama', TRUE),
                'password' => $this->input->post('password', TRUE),
                'id_jabatan' => $this->input->post('id_jabatan', TRUE),
                'id_department' => $this->input->post('id_department', TRUE),
            );

            $this->User_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/user'));
        }
    }

    public function delete($id) {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/user'));
        }
    }

    function _rules() {
        $this->form_validation->set_rules('nama', ' ', 'trim|required');
        $this->form_validation->set_rules('id_jabatan', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('id_department', ' ', 'trim|required|numeric');

        $this->form_validation->set_rules('id_user', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */