<?php
$config = array(
    'branch' => array(
        array(
            'field' => 'country_code',
            'label' => 'Country',
            'rules' => 'required|valid_country'
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'required|max_length[255]'
        )
    ),
    'customer' => array(
        array(
            'field' => 'first_name',
            'label' => 'First name',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last name',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'branch_id',
            'label' => 'Bank branch',
            'rules' => 'required|numeric|valid_bank_branch'
        )
    ),
    'c2c_payment' => array(
        array(
            'field' => 'from_customer_id',
            'label' => 'From',
            'rules' => 'required|numeric|valid_customer'
        ),
        array(
            'field' => 'to_customer_id',
            'label' => 'To',
            'rules' => 'required|numeric|valid_customer'
        ),
        array(
            'field' => 'amount',
            'label' => 'Amount to transfer',
            'rules' => 'required|regex_match[/([\d]+)([.]?)([\d]?)/]'
        )
    )
);
