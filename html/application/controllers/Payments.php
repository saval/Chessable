<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transactions_model');
    }
    
    /**
     * Customer to customer transfer page - show form, validate it on submit
     * and save transaction to DB
     */
    public function c2c($from_customer_id)
    {
        $this->load->helper(['form', 'customer']);
        $this->load->model('customers_model');
        $this->load->library('form_validation');
        
        if ($this->form_validation->run('c2c_payment') != false) {
            $form = $this->input->post();
            $form['amount'] = floatval($form['amount']);
            $current_balance = $this->transactions_model->getBalanceByCustomerId($form['from_customer_id']);
            if ($current_balance < $form['amount']) {
                $data['error_msg'] = 'Current customer\'s balance is less than specified amount';

            } else {
                $data['success'] = $this->transactions_model->customerToCustomerPayment(
                    $form['from_customer_id'],
                    $form['to_customer_id'],
                    $form['amount']
                );
                if ($data['success']) {
                    $this->session->set_flashdata('message', 'Money transfer has been successfully completed!');
                    redirect(current_url());
                }
            }
        }
        $data['success_msg'] = $this->session->flashdata('message');
        $data['from_customer_id'] = $from_customer_id;
        $data['customers'] = $this->customers_model->getAll();
        $this->load->view('payments/customer_to_customer', $data);
    }
}
