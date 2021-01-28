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
    )
);
