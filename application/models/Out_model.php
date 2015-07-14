<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Out_model extends CI_Model {

    public $table = 'tbl_out';
    public $id = 'id_out';
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
        $this->db->join('tbl_ijin','tbl_out.id_ijin=tbl_ijin.id_ijin');
        $this->db->join('tbl_perusahaan','tbl_out.id_perusahaan=tbl_perusahaan.id_perusahaan');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->join('tbl_perusahaan','tbl_out.id_perusahaan=tbl_perusahaan.id_perusahaan');
        $this->db->group_by('nomor_permohonan');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->join('tbl_perusahaan','tbl_out.id_perusahaan=tbl_perusahaan.id_perusahaan');
        $this->db->group_by('nomor_permohonan');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_out', $keyword);
        $this->db->or_like('nomor_permohonan', $keyword);
        $this->db->or_like('tanggal_permohonan', $keyword);
        $this->db->or_like('id_ijin', $keyword);
        $this->db->or_like('barang', $keyword);
        $this->db->or_like('jumlah', $keyword);
        $this->db->or_like('satuan', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_out', $keyword);
        $this->db->or_like('nomor_permohonan', $keyword);
        $this->db->or_like('tanggal_permohonan', $keyword);
        $this->db->or_like('id_ijin', $keyword);
        $this->db->or_like('barang', $keyword);
        $this->db->or_like('jumlah', $keyword);
        $this->db->or_like('satuan', $keyword);
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

    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nama_barang' => $dataarray[$i]['nama_barang'],
                'jumlah_barang' => $dataarray[$i]['jumlah_barang'],
                'satuan_barang' => $dataarray[$i]['satuan_barang'],
                'id_ijin' => $this->input->post('id_ijin'),
                'id_out' => $this->input->post('id_out')                
            ); 
            $this->db->insert('tbl_ml_out', $data);
        }
    }

    function dropdown_ijin() {
        // ambil data dari db
        $result = $this->db->get('tbl_ijin');

        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_ijin] = $row->nomor . "/KODE KANTOR/" . $row->id_seksi . "/" . $row->tahun;
            }
        }
        return $dd;
    }

        function dropdown_perusahaan() {
        // ambil data dari db
        $result = $this->db->get('tbl_perusahaan');

        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_perusahaan] = $row->nama_perusahaan;
            }
        }
        return $dd;
    }

}

/* End of file Out_model.php */
    /* Location: ./application/models/Out_model.php */    