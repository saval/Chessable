<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Transactions_model extends CI_Model
{
    private $table_name = 'transaction';
    private $table_fields = ['customer_id', 'amount'];
    
    public function addNew($data)
    {
        if (!is_array($data)) {
            return false;
        }
        $db_data = array_intersect_key($data, array_fill_keys($this->table_fields, 1));
        if (!$db_data || count($db_data) != count($this->table_fields)) {
            return false;
        }
        $sql = sprintf(
            "INSERT INTO %s (customer_id, amount) VALUES (%d, %.2f)",
            $this->table_name,
            $db_data['customer_id'],
            $db_data['amount']
        );
        $res = $this->db->query($sql);
        if (!$res) {
            return false;
        }
        return $this->db->insert_id();
    }

}
