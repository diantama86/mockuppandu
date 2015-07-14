<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absence extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/absence_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/absence/index/';
        $config['total_rows'] = $this->absence_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/absence.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $absence = $this->absence_model->index_limit($config['per_page'], $start);

        $data = array(
            'absence_data' => $absence,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_absence_list', $data);
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(3)=='search') {
            $config['base_url'] = base_url() . 'admin/absence/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/absence/index/';
        }

        $config['total_rows'] = $this->absence_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/absence/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(5, 0);
        $absence = $this->absence_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'absence_data' => $absence,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/tbl_absence_list', $data);
    }

    public function read($id) 
    {
        $row = $this->absence_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_absence' => $row->id_absence,
		'id_user' => $row->id_user,
		'date_absence' => $row->date_absence,
		'time_in' => $row->time_in,
		'time_out' => $row->time_out,
	    );
            $this->load->view('admin/tbl_absence_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/absence'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/absence/create_action'),
	    'id_absence' => set_value('id_absence'),
	    'id_user' => set_value('id_user'),
	    'date_absence' => set_value('date_absence'),
	    'time_in' => set_value('time_in'),
	    'time_out' => set_value('time_out'),
	);
        $this->load->view('admin/tbl_absence_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'date_absence' => $this->input->post('date_absence',TRUE),
		'time_in' => $this->input->post('time_in',TRUE),
		'time_out' => $this->input->post('time_out',TRUE),
	    );

            $this->absence_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/absence'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->absence_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/absence/update_action'),
		'id_absence' => set_value('id_absence', $row->id_absence),
		'id_user' => set_value('id_user', $row->id_user),
		'nama_user' => set_value('nama_user', $row->nama_user),
		'date_absence' => set_value('date_absence', $row->date_absence),
		'time_in' => set_value('time_in', $row->time_in),
		'time_out' => set_value('time_out', $row->time_out),
	    );
            $this->load->view('admin/tbl_absence_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/absence'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absence', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'date_absence' => $this->input->post('date_absence',TRUE),
		'time_in' => $this->input->post('time_in',TRUE),
		'time_out' => $this->input->post('time_out',TRUE),
	    );

            $this->absence_model->update($this->input->post('id_absence', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/absence'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->absence_model->get_by_id($id);

        if ($row) {
            $this->absence_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/absence'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/absence'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_user', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('date_absence', ' ', 'trim|required');
	$this->form_validation->set_rules('time_in', ' ', 'trim|required');
	$this->form_validation->set_rules('time_out', ' ', 'trim|required');

	$this->form_validation->set_rules('id_absence', 'id_absence', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Absence.php */
/* Location: ./application/controllers/Absence.php */