<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Customers_model extends CI_Model
{
    private $table_name = 'customer';
    private $trans_table_name = 'transaction';
    private $table_fields = ['first_name', 'last_name', 'branch_id', 'balance'];
    
    public function getAll()
    {
        $sql = sprintf(
            "SELECT c.*,
                          SUM(CASE WHEN t.amount IS NULL THEN 0 ELSE t.amount END) AS balance
                        FROM %s c
                        LEFT JOIN %s t ON c.id = t.customer_id
                        WHERE 1
                        GROUP BY c.id
                        ORDER BY c.id ASC",
            $this->table_name,
            $this->trans_table_name
        );
        return $this->db->query($sql)->result_array();
    }
    
    public function addNew($data, $transactions_model)
    {
        if (!is_array($data)) {
            return false;
        }
        $db_data = array_intersect_key($data, array_fill_keys($this->table_fields, 1));
        if (!$db_data || count($db_data) != count($this->table_fields)) {
            return false;
        }
        
        $this->db->trans_start();
        $sql = sprintf(
            "INSERT INTO %s (first_name, last_name, branch_id) VALUES (%s, %s, %d)",
            $this->table_name,
            $this->db->escape($db_data['first_name']),
            $this->db->escape($db_data['last_name']),
            $db_data['branch_id']
        );
        $res = $this->db->query($sql);
        if (!$res) {
            return false;
        }
        $customer_id = $this->db->insert_id();
        
        if (!empty($db_data['balance'])) {
            $transaction_data = [
                'customer_id' => $customer_id,
                'amount' => $db_data['balance']
            ];
            
            $transactions_model->addNew($transaction_data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return false;
        }
        return true;
    }
    
    public function getById($customer_id)
    {
        if (!$customer_id) {
            return [];
        }
        $sql = sprintf("SELECT * FROM %s WHERE id = %d", $this->table_name, $customer_id);
        return $this->db->query($sql)->row_array();
    }
}
