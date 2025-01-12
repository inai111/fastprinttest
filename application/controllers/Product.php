<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}

	public function index()
	{

		// cek apakah produk kosong atau tidak
		$products = $this->product_model->get_all_data();

		if (count($products) == 0) {
			// function dari helper
			$products = get_data();
		}

		$data = ['products' => $products];
		$this->load->view('welcome_message', $data);
	}

	public function edit($id_product)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('produk_nama', 'Product Name', 'required');
		$this->form_validation->set_rules('produk_harga', 'Product Price', 'required|min_length[3]|numeric');

		if ($this->form_validation->run()) {
			// var_dump($this->product_model);die;
			$this->product_model->update_product($id_product, [
				'nama_produk' => $this->input->post('produk_nama'),
				'harga' => $this->input->post('produk_harga'),
				'kategori_id' => $this->input->post('produk_kategori'),
				'status_id' => $this->input->post('produk_status'),
			]);
			$this->session->set_flashdata('message', 'Product Updated');
			// redirect('/');
		} else {
			$product = $this->product_model->get_data($id_product);
			$kategories = $this->db->get('kategori')->result_array();
			$status = $this->db->get('status')->result_array();
			// var_dump($status);die;
			$data = [
				'product' => $product,
				'kategories' => $kategories,
				'status' => $status
			];
			$this->load->view('edit_product_page', $data);
		}
	}
}
