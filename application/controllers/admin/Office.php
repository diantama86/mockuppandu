<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Office extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/office_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/office/index/';
        $config['total_rows'] = $this->office_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/office.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $office = $this->office_model->index_limit($config['per_page'], $start);

        $data = array(
            'office_data' => $office,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/tbl_office_list', $data);
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(3)=='search') {
            $config['base_url'] = base_url() . 'admin/office/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/office/index/';
        }

        $config['total_rows'] = $this->office_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/office/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(5, 0);
        $office = $this->office_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'office_data' => $office,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/tbl_office_list', $data);
    }

    public function read($id) 
    {
        $row = $this->office_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_office' => $row->id_office,
		'branch_name' => $row->branch_name,
		'branch_address' => $row->branch_address,
	    );
            $this->load->view('admin/tbl_office_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/office'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/office/create_action'),
	    'id_office' => set_value('id_office'),
	    'branch_name' => set_value('branch_name'),
	    'branch_address' => set_value('branch_address'),
	);
        $this->load->view('admin/tbl_office_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'branch_name' => $this->input->post('branch_name',TRUE),
		'branch_address' => $this->input->post('branch_address',TRUE),
	    );

            $this->office_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/office'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->office_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/office/update_action'),
		'id_office' => set_value('id_office', $row->id_office),
		'branch_name' => set_value('branch_name', $row->branch_name),
		'branch_address' => set_value('branch_address', $row->branch_address),
	    );
            $this->load->view('admin/tbl_office_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/office'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_office', TRUE));
        } else {
            $data = array(
		'branch_name' => $this->input->post('branch_name',TRUE),
		'branch_address' => $this->input->post('branch_address',TRUE),
	    );

            $this->office_model->update($this->input->post('id_office', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/office'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->office_model->get_by_id($id);

        if ($row) {
            $this->office_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/office'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminoffice'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('branch_name', ' ', 'trim|required');
	$this->form_validation->set_rules('branch_address', ' ', 'trim|required');

	$this->form_validation->set_rules('id_office', 'id_office', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Office.php */
/* Location: ./application/controllers/Office.php */