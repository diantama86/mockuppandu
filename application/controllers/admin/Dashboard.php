<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/announcement_model');
    }

    public function index() {
        $data = array(
            'announcement' =>  $this->announcement_model->data_active()
        );
        $this->load->view('admin/dashboard', $data);
    }

}
