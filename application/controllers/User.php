<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'user/index/';
        $config['total_rows'] = $this->user_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'user.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $user = $this->user_model->index_limit($config['per_page'], $start);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('tbl_user_list', $data);
    }

    public function user() {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'user/user/';
        $config['total_rows'] = $this->user_model->total_rows_seksi();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'user.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $user = $this->user_model->index_limit_seksi($config['per_page'], $start);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('tbl_user_list', $data);
    }

    public function search() {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'user/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'user/index/';
        }

        $config['total_rows'] = $this->user_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'user/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $user = $this->user_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'user_data' => $user,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_user_list', $data);
    }

    public function read($id) {
        $row = $this->user_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'username' => $row->username,
                'nama' => $row->nama,
                'password' => $row->password,
            );
            $this->load->view('tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
            'id_user' => set_value('id_user'),
            'username' => set_value('username'),
            'nama' => set_value('nama'),
            'password' => set_value('password'),
        );
        $this->load->view('tbl_user_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'password' => $this->input->post('password', TRUE),
            );

            $this->user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }

    public function update($id) {
        $row = $this->user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
                'id_user' => set_value('id_user', $row->id_user),
                'username' => set_value('username', $row->username),
                'nama' => set_value('nama', $row->nama),
                'password' => set_value('password', $row->password),
            );
            $this->load->view('tbl_user_form', $data);
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
                'nama' => $this->input->post('nama', TRUE),
                'password' => $this->input->post('password', TRUE),
            );

            $this->user_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }

    public function delete($id) {
        $row = $this->user_model->get_by_id($id);

        if ($row) {
            $this->user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    function _rules() {
        $this->form_validation->set_rules('username', ' ', 'trim|required');
        $this->form_validation->set_rules('nama', ' ', 'trim|required');
        $this->form_validation->set_rules('password', ' ', 'trim|required');

        $this->form_validation->set_rules('id_user', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */