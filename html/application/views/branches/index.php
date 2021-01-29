<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
    <p class="h4 pt-5 pb-3">Bank branches <a href="<?=site_url('branches/add');?>" class="btn btn-primary pl-5">Add branch</a></p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Country</th>
            <th scope="col">Address</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($branches)) :
            foreach ($branches as $bank_branch) :
                $country_name = $countries[$bank_branch['country_code']] ?? 'Undefined';
                ?>
        <tr>
            <th scope="row"><?=$bank_branch['id'];?></th>
            <td><?=$country_name;?></td>
            <td><?=html_escape($bank_branch['address']);?></td>
            <td></td>
        </tr>
                <?php
            endforeach;
        else : ?>
        <tr>
            <td colspan="4" scope="row" class="text-center">You have no branches yet. Let's add first!</td>
        </tr>
                <?php
        endif; ?>
        </tbody>
    </table>
<?php include(VIEWPATH . 'footer.php'); ?>
