<?php
class Product_model extends CI_Model {
    private $tableName = 'produk';

    public function get_data(){
        $query = $this->db->query("Select *, nama_status, nama_kategori from produk join kategori on id_kategori = kategori_id join status on status_id = id_status where nama_status = 'bisa dijual' limit 1");
        return $query->result_array();
    }
    public function insert_data($data){
        return $data;
    }
}
