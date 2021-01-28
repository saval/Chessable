<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
    <p class="h4 pt-5 pb-3">Reports</p>
    <div class="pt-2">
        <ul class="list-unstyled">
            <li><a href="<?=site_url('/reports/highest_balance');?>">The highest balance per branch</a></li>
            <li>
                <a href="<?=site_url('/reports/big_balances');?>">Branches with more than two customers with a balance over 50,000.s</a>
            </li>
        </ul>
    </div>
<?php include(VIEWPATH . 'footer.php'); ?>
