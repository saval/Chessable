<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('branches_model');
        $this->load->model('customers_model');
        $this->load->model('transactions_model');
        $this->load->library("unit_test");
        $this->unit->set_test_items(array('test_name', 'result'));
    }
    
    /**
     * Index Page for this controller, shows list of tests with results
     */
    public function index()
    {
        $data['branches_model_tests_res'] = $this->testBranchesModel();
        $this->load->view('tests/index', $data);
    }
    
    /**
     * Run test cases for the Branches_model and return array with results
     */
    public function testBranchesModel()
    {
        $branch = $this->branches_model->getById(0);
        $this->unit->run($branch, [], 'branches_model->getById with 0 as parameter');
    
        $res1 = $this->db->query('SELECT MAX(id) AS id FROM bank_branch')->row_array();
        if (!$res1) {
            $branch = $this->branches_model->getById(1);
            $this->unit->run($branch, [], 'branches_model->getById with ID that missing in the DB');
        } else {
            $branch = $this->branches_model->getById($res1['id'] + 1);
            $this->unit->run($branch, [], 'branches_model->getById with ID that missing in the DB');
        }
        
        // add test record
        $branch1 = array(
            'id' => $res1 ? $res1['id'] + 1 : 1,
            'country_code' => 'UA',
            'address' => 'Test address'
        );
        $this->db->insert('bank_branch', $branch1);
        $branch = $this->branches_model->getById($branch1['id']);
        unset($branch['created_date'], $branch['updated_date']);
        $this->unit->run($branch, $branch1, 'branches_model->getById with existing ID');
        $this->db->query('DELETE FROM bank_branch WHERE id = ' . $branch1['id']);
        
        return $this->unit->result();
    }
}
