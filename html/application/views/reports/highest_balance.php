<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
<p class="pt-3 pb-3"><a href="<?=site_url('/reports');?>">Back to Reports</a></p>
<p class="h4 pt-0 pb-3">Reports - the highest balance per branch</p>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Country</th>
        <th scope="col">Address</th>
        <th scope="col">Max balance</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($branches)) :
        foreach ($branches as $bank_branch) :
            $country_name = $countries[$bank_branch['country_code']] ?? 'Undefined';
            $max_balance = $branches_max_balance[$bank_branch['id']] ?? 0;
            ?>
            <tr>
                <th scope="row"><?=$bank_branch['id'];?></th>
                <td><?=$country_name;?></td>
                <td><?=html_escape($bank_branch['address']);?></td>
                <td><?=number_format($max_balance, 2);?></td>
            </tr>
            <?php
        endforeach;
    else : ?>
        <tr>
            <td colspan="4" scope="row" class="text-center">You have no branches yet.</td>
        </tr>
        <?php
    endif; ?>
    </tbody>
</table>
<?php include(VIEWPATH . 'footer.php'); ?>
