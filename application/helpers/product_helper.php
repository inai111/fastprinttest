<?php
date_default_timezone_set('Asia/Singapore');

if (! function_exists('get_data_products')) {
    function get_data_products()
    {
        $date = date('d-m-y');
        $date2 = date('dmyCH');
        $password = md5("bisacoding-$date");
        $field = "username=tesprogrammer{$date2}&password=$password";
        // var_dump($field);die;
        $header = [
            'accept' => 'application/json'
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://recruitment.fastprint.co.id/tes/api_tes_programmer');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $field);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response,true);
    }
}

if (! function_exists('get_data')) {
    function get_data()
    {
        try {
            // agar bisa load database
            $ci = get_instance();

            $ci->db->trans_begin();
            $ci->load->model('product_model');

            $products = get_data_products();

            $productsToInsert = [];
            $kategoriesToInsert = [];
            $kategories = [];
            $statusToInsert = [];
            $status = [];

            foreach ($products['data'] as $item) {

                $productsToInsert[] = [
                    'id_produk' => $item['id_produk'],
                    'nama_produk' => $item['nama_produk'],
                    'harga' => $item['harga'],
                    'kategori_id' => $item['kategori'],
                    'status_id' => $item['status'],
                ];

                if (!in_array($item['kategori'], $kategories)) {
                    $kategories[] = $item['kategori'];
                    $kategoriesToInsert[] = [
                        'nama_kategori' => $item['kategori']
                    ];
                }
                if (!in_array($item['status'], $status)) {
                    $status[] = $item['status'];
                    $statusToInsert[] = [
                        'nama_status' => $item['status']
                    ];
                }
            }

            // insert sesuai urutan

            $ci->db->insert_batch('kategori', $kategoriesToInsert);
            $ci->db->insert_batch('status', $statusToInsert);


            $productsToInsert = array_map(function ($product) use ($ci) {
                $id_kategori = $ci->db->select('id_kategori as id')->where('nama_kategori', $product['kategori_id'])->get('kategori')->row('id');
                $product['kategori_id'] = $id_kategori;

                $id_status = $ci->db->select('id_status as id')->where('nama_status', $product['status_id'])->get('status')->row('id');
                $product['status_id'] = $id_status;
                return $product;
            }, $productsToInsert);

            $data = $ci->db->insert_batch('produk', $productsToInsert);

            $ci->db->trans_commit();

            return $ci->db->get('produk')->num_rows();
        } catch (Exception $e) {

            $ci->db->trans_rollback();
            return $e;
        }
    }
}
