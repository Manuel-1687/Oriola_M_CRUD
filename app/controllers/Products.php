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
        try {
            $this->call->model('Product_model', 'product');
            $products = $this->product->all_products();
            $database_error = null;
        } catch (Throwable $exception) {
            $products = [];
            $database_error = 'Database connection failed. Check the Render Aiven environment variables.';
            error_log($exception->getMessage());
        }

        $this->call->view('products/index', [
            'products' => $products,
            'message' => $this->session->flashdata('message'),
            'database_error' => $database_error,
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
        try {
            $this->call->model('Product_model', 'product');
            $product = $this->product->find_product((int) $id);
            if (!$product) {
                show_404('Product not found');
            }
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            $this->session->set_flashdata('message', 'Unable to load this product. Check the database connection.');
            redirect('/products');
        }
        $this->call->view('products/form', ['product' => $product, 'form_action' => '/products/update/' . (int) $id]);
    }

    public function update($id)
    {
        try {
            $this->call->model('Product_model', 'product');
            $updated = $this->product->update((int) $id, $this->product_data());
            $this->session->set_flashdata('message', $updated ? 'Product updated successfully.' : 'No product was updated.');
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            $this->session->set_flashdata('message', 'Product update failed. Check the database connection.');
        }
        redirect('/products');
    }

    public function delete($id)
    {
        try {
            $this->call->model('Product_model', 'product');
            $deleted = $this->product->delete((int) $id);
            $this->session->set_flashdata('message', $deleted ? 'Product deleted successfully.' : 'No product was deleted.');
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            $this->session->set_flashdata('message', 'Product deletion failed. Check the database connection.');
        }
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
