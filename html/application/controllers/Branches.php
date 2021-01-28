<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('branches_model');
    }
    
    /**
     * Index Page for this controller, shows list of existing branches
     */
    public function index()
    {
        $this->load->config('locations');
        
        $data['countries'] = $this->config->item('countries');
        $data['branches'] = $this->branches_model->getAll();
        $this->load->view('branches/index', $data);
    }
    
    /**
     * Show add branch form, validate it on submit and save new branch details to DB
     */
    public function add()
    {
        $this->load->helper(['form']);
        $this->load->config('locations');
        $this->load->library('form_validation');
        
        if ($this->form_validation->run('branch') != false) {
            $form = $this->input->post();
            $form['address'] = $this->security->xss_clean($form['address']);
            $data['success'] = $this->branches_model->addNew($form);
            if ($data['success']) {
                $this->session->set_flashdata('message', 'New Branch has been added!');
                redirect(current_url());
            }
        }
        $data['success_msg'] = $this->session->flashdata('message');
        $data['countries'] = $this->config->item('countries');
        $this->load->view('branches/add', $data);
    }
}
