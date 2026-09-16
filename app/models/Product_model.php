<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];

    public function __construct()
    {
        parent::__construct();
        $this->ensure_table();
    }

    private function ensure_table()
    {
        $lava = lava_instance();
        $lava->call->dbforge();
        if ($lava->dbforge->table_exists($this->table)) {
            return;
        }

        $lava->dbforge
            ->add_field([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE, 'null' => FALSE],
                'product_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE],
                'description' => ['type' => 'TEXT', 'null' => TRUE],
                'price' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => FALSE, 'default' => 0],
                'quantity' => ['type' => 'INT', 'constraint' => 11, 'null' => FALSE, 'default' => 0],
                'created_at' => ['type' => 'TIMESTAMP', 'null' => FALSE, 'default' => 'CURRENT_TIMESTAMP'],
            ])
            ->add_key('id', primary: TRUE)
            ->create_table($this->table);
    }

    public function all_products()
    {
        return $this->db->table($this->table)->order_by('id', 'DESC')->get_all();
    }

    public function find_product($id)
    {
        return $this->db->table($this->table)->where('id', (int) $id)->get();
    }
}
