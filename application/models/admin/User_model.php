<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public $table = 'tbl_user';
    public $id = 'id_user';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->join('tbl_department', 'tbl_user.id_department = tbl_department.id_department');
        $this->db->join('tbl_jabatan', 'tbl_user.id_jabatan = tbl_jabatan.id_jabatan');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->join('tbl_department', 'tbl_user.id_department = tbl_department.id_department');
        $this->db->join('tbl_jabatan', 'tbl_user.id_jabatan = tbl_jabatan.id_jabatan');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

// get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_user', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('nama_user', $keyword);
        $this->db->or_like('password', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->join('tbl_department', 'tbl_user.id_department = tbl_department.id_department');
        $this->db->join('tbl_jabatan', 'tbl_user.id_jabatan = tbl_jabatan.id_jabatan');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_user', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('nama_user', $keyword);
        $this->db->or_like('password', $keyword);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function dropdown_jabatan() {
        // ambil data dari db
        $result = $this->db->get('tbl_jabatan');

        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_jabatan] = $row->nama_jabatan;
            }
        }
        return $dd;
    }

    function dropdown_department() {
        // ambil data dari db
        $result = $this->db->get('tbl_department');

        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_department] = $row->nama_department;
            }
        }
        return $dd;
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */