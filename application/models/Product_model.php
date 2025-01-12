<?php
class Product_model extends CI_Model
{
    private $tableName = 'produk';

    public function get_data($id_product)
    {
        $query = $this->db->where('id_produk', $id_product)->get($this->tableName);
        return $query->row_array();
    }

    public function get_all_data($where = [])
    {
        // $query = $this->db->query("Select *, nama_status, nama_kategori from {$this->tableName} join kategori on id_kategori = kategori_id join status on status_id = id_status where nama_status = 'bisa dijual' order by id_produk desc");
        $query = $this->db
            ->select("*, nama_status, nama_kategori")
            ->from($this->tableName)
            ->join('kategori', 'kategori_id = id_kategori')
            ->join('status', 'status_id = id_status')
            ->where($where)
            ->order_by('id_produk', "desc")
            ->get();
        return $query->result_array();
    }

    public function delete_product($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

    public function update_product($id, $updateData)
    {
        try {
            // var_dump($updateData,'asdasd');die;
            $this->db->trans_begin();
            // cek apakah id kategori/status ada di database;
            $id_kategori = $this->db->select('id_kategori')->where('id_kategori', $updateData['kategori_id'])->get('kategori')->row_array();
            if (!$id_kategori) {
                throw new Exception('Kategori Tidak ada');
            }

            $id_status = $this->db->select('id_status')->where('id_status', $updateData['status_id'])->get('status')->row_array();
            if (!$id_status) {
                throw new Exception('Status Tidak ada');
            }

            $this->db->where('id_produk', $id);
            $this->db->update($this->tableName, $updateData);
            $this->db->trans_commit();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insert_product($insertData)
    {
        try {
            $this->db->trans_begin();
            // cek apakah id kategori/status ada di database;
            $id_kategori = $this->db->select('id_kategori')->where('id_kategori', $insertData['kategori_id'])->get('kategori')->row_array();
            if (!$id_kategori) {
                throw new Exception('Kategori Tidak ada');
            }

            $id_status = $this->db->select('id_status')->where('id_status', $insertData['status_id'])->get('status')->row_array();
            if (!$id_status) {
                throw new Exception('Status Tidak ada');
            }

            $this->db->insert($this->tableName, $insertData);
            $this->db->trans_commit();
        } catch (Exception $e) {
            return $e;
        }
    }
}
