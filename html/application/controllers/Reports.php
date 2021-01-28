<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->config('locations');
        $this->load->model('reports_model');
        $this->load->model('branches_model');
    }
    
    public function index()
    {
        $this->load->view('reports/index');
    }
    
    public function manager($report_type)
    {
        if (empty($report_type)) {
            show_404();
        }
        switch ($report_type) {
            case 'highest_balance':
                $this->highestBalance();
                break;
            case 'big_balances':
                $this->bigBalances();
                break;
            default:
                show_404();
        }
        return;
    }
    
    /**
     * Shows all branches along with the highest balance at each branch. A branch with no
     * customers shown with 0 as the highest balance.
     */
    public function highestBalance()
    {
        $data['branches_max_balance'] = $this->reports_model->getBranchBalances();
        $data['countries'] = $this->config->item('countries');
        $data['branches'] = $this->branches_model->getAll();
        $this->load->view('reports/highest_balance', $data);
    }
    
    /**
     * Shows only branches that have more than two customers with a balance over 50,000.
     */
    public function bigBalances()
    {
        $min_balance_amount = 50000;
        $min_customers_num = 2;
        $data['branches_rich_customers'] = $this->reports_model->getBranchesWithRichCustomers($min_balance_amount, $min_customers_num);
        $data['branches'] = $this->branches_model->getByManyIds(array_keys($data['branches_rich_customers']));
        $data['countries'] = $this->config->item('countries');
        $this->load->view('reports/big_balances', $data);
    }
}
