<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
    <p class="h4 pt-5 pb-3">Tests</p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Test name</th>
            <th scope="col">Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $test_num = 1;
            $total_res = ['total' => 0, 'passed' => 0];
        ?>
        <?php
        foreach ($branches_model_tests_res as $test) :
            if ('Failed' == $test['Result']) :
                $res_class = 'text-danger';
            else :
                $res_class = 'text-success';
                $total_res['passed']++;
            endif;
            $total_res['total']++;
            ?>
        <tr>
            <th scope="row"><?=$test_num++;?></th>
            <td><?=$test['Test Name'];?></td>
            <td class="<?=$res_class;?>"><?=$test['Result'];?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <th>Result</th>
            <th><?=sprintf("%d / %d", $total_res['passed'], $total_res['total']);?></th>
        </tr>
        </tfoot>
    </table>
<?php include(VIEWPATH . 'footer.php'); ?>
