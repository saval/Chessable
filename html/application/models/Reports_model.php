<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Reports_model extends CI_Model
{
    private $customer_table_name = 'customer';
    private $trans_table_name = 'transaction';
    
    public function getBranchBalances()
    {
        $sql = sprintf(
            "SELECT branch_id, MAX(balance) AS max_balance
                    FROM
                    (
                     SELECT c.*,
                        SUM(IFNULL(t.amount, 0)) AS balance
                     FROM %s c
                     LEFT JOIN %s t ON c.id = t.customer_id
                     WHERE 1
                     GROUP BY c.id
                    ) AS c2
                    GROUP BY c2.branch_id",
            $this->customer_table_name,
            $this->trans_table_name
        );
        $res_ar = [];
        $res = $this->db->query($sql);
        foreach ($res->result_array() as $row) {
            $res_ar[$row['branch_id']] = $row['max_balance'];
        }
        return $res_ar;
    }
    
    public function getBranchesWithRichCustomers($min_balance_amount, $min_customers_num)
    {
        $sql = sprintf(
            "SELECT branch_id, COUNT(c2.id) AS users_num
                    FROM (
                     SELECT c.*,
                      SUM(IFNULL(t.amount, 0)) AS balance
                     FROM %s c
                     LEFT JOIN %s t ON c.id = t.customer_id
                     GROUP BY c.id
                     HAVING balance > %d
                    ) AS c2
                    GROUP BY branch_id
                    HAVING users_num >= %d",
            $this->customer_table_name,
            $this->trans_table_name,
            $min_balance_amount,
            $min_customers_num
        );
        $res_ar = [];
        $res = $this->db->query($sql);
        foreach ($res->result_array() as $row) {
            $res_ar[$row['branch_id']] = $row['users_num'];
        }
        return $res_ar;
    }
}
