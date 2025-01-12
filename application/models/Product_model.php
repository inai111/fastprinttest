<?php
class Product_model extends CI_Model {
    private $tableName = 'produk';

    public function get_data($id_product){
        $query = $this->db->where('id_produk',$id_product)->get($this->tableName);
        return $query->row_array();
    }
    
    public function get_all_data(){
        $query = $this->db->query("Select *, nama_status, nama_kategori from {$this->tableName} join kategori on id_kategori = kategori_id join status on status_id = id_status where nama_status = 'bisa dijual'");
        return $query->result_array();
    }

    public function update_product($id,$updateData){
        try{
            // var_dump($updateData,'asdasd');die;
            $this->db->trans_begin();
            // cek apakah id kategori/status ada di database;
            $id_kategori = $this->db->select('id_kategori')->where('id_kategori',$updateData['kategori_id'])->get('kategori')->row_array();
            if(!$id_kategori){
                throw new Exception('Kategori Tidak ada');
            }

            $id_status = $this->db->select('id_status')->where('id_status',$updateData['status_id'])->get('status')->row_array();
            if(!$id_status){
                throw new Exception('Status Tidak ada');
            }

            $this->db->where('id_produk',$id);
            $this->db->update($this->tableName,$updateData);
            $this->db->trans_commit();
        }catch(Exception $e){
            return $e;
        }
    }

    public function insert_data($data){
        return $data;
    }
}
