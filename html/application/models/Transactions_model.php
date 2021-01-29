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
    
    public function getBalanceByCustomerId($customer_id)
    {
        $sql = sprintf(
            "SELECT SUM(CASE WHEN amount IS NULL THEN 0 ELSE amount END) AS balance
                        FROM %s
                        WHERE customer_id = %d",
            $this->table_name,
            $customer_id
        );
        $row = $this->db->query($sql)->row_array();
        return $row ? $row['balance'] : 0;
    }
    
    public function customerToCustomerPayment($from_customer_id, $to_customer_id, $amount)
    {
        if (!$from_customer_id || !$to_customer_id || !$amount) {
            return false;
        }
    
        $this->db->trans_begin();
        if (!$this->addNew(['customer_id' => $to_customer_id, 'amount' => $amount])) {
            $this->db->trans_rollback();
            return false;
        }
    
        if (!$this->addNew(['customer_id' => $from_customer_id, 'amount' => -$amount])) {
            $this->db->trans_rollback();
            return false;
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }
}
