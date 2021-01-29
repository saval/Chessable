<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    /**
     * Country code validator. Only white-listed values allowed.
     */
    public function valid_country($country_code)
    {
        $this->CI->load->config('locations');
        $data['countries'] = $this->CI->config->item('countries');
    
        if (!array_key_exists($country_code, $data['countries'])) {
            $this->set_message('valid_country', 'Please select the country from the drop-down menu.');
            return false;
        }
        return true;
    }
    
    /**
     * Bank branch validator. Only existing in the DB branches allowed.
     */
    public function valid_bank_branch($branch_id)
    {
        $this->CI->load->model('branches_model');
        $branch = $this->CI->branches_model->getById($branch_id);
        if (!$branch) {
            $this->set_message('valid_bank_branch', 'Please select the bank branch from the drop-down menu.');
            return false;
        }
        return true;
    }
    
    /**
     * Customer ID validator. Only existing in the DB customers allowed.
     */
    public function valid_customer($customer_id)
    {
        $this->CI->load->model('customers_model');
        $customer = $this->CI->customers_model->getById($customer_id);
        if (!$customer) {
            $this->set_message('valid_customer', 'Please select the customer from the drop-down menu.');
            return false;
        }
        return true;
    }
}

/* End of file MY_Form_validation.php */
/* Location: ./application/core/MY_Form_validation.php */
