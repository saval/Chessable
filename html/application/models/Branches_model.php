<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Branches_model extends CI_Model
{
    private $table_name = 'bank_branch';
    private $table_fields = ['country_code', 'address'];
    
    public function getAll($order_field = null, $order = null)
    {
        $order_field = in_array($order_field, $this->table_fields) ? $order_field : null;
        $order = in_array(strtolower($order), ['asc', 'desc']) ? $order : null;
        $sql = sprintf(
            "SELECT * FROM %s %s",
            $this->table_name,
            !empty($order_field) ? 'ORDER BY ' . $order_field : '',
            !empty($order) ? $order : ''
        );
        return $this->db->query($sql)->result_array();
    }
    
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
            "INSERT INTO %s (country_code, address) VALUES (%s, %s)",
            $this->table_name,
            $this->db->escape($db_data['country_code']),
            $this->db->escape($db_data['address'])
        );
        $res = $this->db->query($sql);
        if (!$res) {
            return false;
        }
        return $this->db->insert_id();
    }
    
    public function getById($branch_id)
    {
        if (!$branch_id) {
            return [];
        }
        $sql = sprintf("SELECT * FROM %s WHERE id = %d", $this->table_name, $branch_id);
        return $this->db->query($sql)->row_array();
    }
    
    public function getByManyIds($branch_ids)
    {
        if (!is_array($branch_ids)) {
            return [];
        }
        $branch_ids = array_filter($branch_ids, 'is_numeric');
        if (empty($branch_ids)) {
            return [];
        }
        $sql = sprintf("SELECT * FROM %s WHERE id IN (%s)", $this->table_name, implode(', ', $branch_ids));
        return $this->db->query($sql)->result_array();
    }
    
    public function getSelectOptions($countries)
    {
        $branches = $this->getAll('country_code ASC');
        if (!$branches) {
            return [];
        }
        $options = [];
        foreach ($branches as $branch_id => $branch) {
            $country_name = $countries[$branch['country_code']] ?? 'Unknown';
            $options[$branch_id] = sprintf("%s [%s]", $branch['address'], $country_name);
        }
        return $options;
    }
}
