<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_full_name($customer)
{
    if (empty($customer)) {
        return '';
    }
    
    $name_parts = [];
    if (!empty($customer['first_name'])) {
        $name_parts[] = $customer['first_name'];
    }
    if (!empty($customer['last_name'])) {
        $name_parts[] = $customer['last_name'];
    }
    return implode(' ', $name_parts);
}
