<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller
{
    public function before_action()
    {
        if ($this->session->userdata('authenticated') !== true) {
            redirect('/login');
        }
    }

    public function index()
    {
        $this->call->model('Product_model', 'product');
        $this->call->view('products/index', [
            'products' => $this->product->all_products(),
            'message' => $this->session->flashdata('message'),
        ]);
    }

    public function create()
    {
        $this->call->view('products/form', ['product' => null, 'form_action' => '/products/store']);
    }

    public function store()
    {
        $this->call->model('Product_model', 'product');
        $this->product->insert($this->product_data());
        $this->session->set_flashdata('message', 'Product added successfully.');
        redirect('/products');
    }

    public function edit($id)
    {
        $this->call->model('Product_model', 'product');
        $product = $this->product->find_product($id);
        if (!$product) {
            show_404('Product not found');
        }
        $this->call->view('products/form', ['product' => $product, 'form_action' => '/products/update/' . (int) $id]);
    }

    public function update($id)
    {
        $this->call->model('Product_model', 'product');
        $this->product->update((int) $id, $this->product_data());
        $this->session->set_flashdata('message', 'Product updated successfully.');
        redirect('/products');
    }

    public function delete($id)
    {
        $this->call->model('Product_model', 'product');
        $this->product->delete((int) $id);
        $this->session->set_flashdata('message', 'Product deleted successfully.');
        redirect('/products');
    }

    private function product_data()
    {
        return [
            'product_name' => trim((string) $this->request->post('product_name')),
            'description' => trim((string) $this->request->post('description')),
            'price' => (float) $this->request->post('price'),
            'quantity' => (int) $this->request->post('quantity'),
        ];
    }
}
