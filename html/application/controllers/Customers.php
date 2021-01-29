<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model');
    }
    
    /**
     * Index Page for this controller, shows list of existing customers
     */
    public function index()
    {
        $this->load->config('locations');
        
        $data['customers'] = $this->customers_model->getAll();
        $this->load->view('customers/index', $data);
    }
    
    /**
     * Show add branch form, validate it on submit and save new branch details to DB
     */
    public function add()
    {
        $this->load->helper(['form']);
        $this->load->library('form_validation');
        
        if ($this->form_validation->run('customer') != false) {
            $form = $this->input->post();
            $form['first_name'] = $this->security->xss_clean($form['first_name']);
            $form['last_name'] = $this->security->xss_clean($form['last_name']);
    
            $this->load->model('transactions_model');
            
            /*
             * CI allows to use global instance for access to all loaded objects (models, libraries etc.)
             *  however it makes hard to test such code, so here we pass transactions model as a parameter and tests
             *  can be run with some mockup object instead.
             */
            $data['success'] = $this->customers_model->addNew($form, $this->transactions_model);
            if ($data['success']) {
                $this->session->set_flashdata('message', 'New Customer has been added!');
                redirect(current_url());
            }
        }
        
        $this->load->config('locations');
        $this->load->model('branches_model');
    
        $data['success_msg'] = $this->session->flashdata('message');
        $data['branches'] = $this->branches_model->getAll('country_code', 'ASC');
        $data['countries'] = $this->config->item('countries');
        $this->load->view('customers/add', $data);
    }
}
