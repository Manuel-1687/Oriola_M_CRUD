<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];

    public function all_products()
    {
        return $this->db->table($this->table)->order_by('id', 'DESC')->get_all();
    }

    public function find_product($id)
    {
        return $this->db->table($this->table)->where('id', (int) $id)->get()->row_array();
    }
}
