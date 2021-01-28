<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
    <p class="h4 pt-5 pb-3">Customers <a href="<?=site_url('customers/add');?>" class="btn btn-primary pl-5">Add customer</a></p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Balance</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($customers)) :
            foreach ($customers as $customer) : ?>
        <tr>
            <th scope="row"><?=$customer['id'];?></th>
            <td><?=html_escape($customer['first_name']);?></td>
            <td><?=html_escape($customer['last_name']);?></td>
            <td><?=$customer['balance'];?></td>
            <td>
                <?php if (!empty(floatval($customer['balance']))) :?>
                <a href="<?=site_url('/payments/c2c/' . $customer['id']);?>">Transfer</a>
                <?php endif;?>
            </td>
        </tr>
                <?php
            endforeach;
        else : ?>
        <tr>
            <td colspan="4" scope="row" class="text-center">You have no customers yet. Let's add first!</td>
        </tr>
                <?php
        endif; ?>
        </tbody>
    </table>
<?php include(VIEWPATH . 'footer.php'); ?>
