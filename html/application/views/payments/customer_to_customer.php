<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
<?php
$from_customer_name = '';
$to_customer_options = [];
$transfer_allowed = false;
foreach ($customers as $customer) {
    if ($from_customer_id == $customer['id']) {
        $from_customer_name = get_full_name($customer);
        $transfer_allowed = !empty(floatval($customer['balance']));

    } else {
        $to_customer_options[] = $customer;
    }
}
?>
<p class="h6 pt-5 pb-2">Transfer money between 2 customers</p>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <?php if (!$transfer_allowed) : ?>
            <div class="text-danger">Selected customer has empty balance and payment impossible!</div>
            <?php endif; ?>
            <?php if (!empty($error_msg)) : ?>
                <div class="text-danger"><?=$error_msg;?></div>
            <?php endif; ?>
            <div class="text-danger"><?php echo validation_errors(); ?></div>
            <?php if (!empty($success_msg)) : ?>
                <p class="text-success"><?=$success_msg;?> Check it <a href="<?=site_url('customers');?>">here</a></p>
            <?php endif; ?>
            <?php if (isset($success) && false === $success) : ?>
            <p class="text-danger">Sorry, data has not been saved, please check form below and try again</p>
            <?php endif; ?>
            <?php echo form_open(''); ?>
            <?php echo form_hidden('from_customer_id', $from_customer_id); ?>
            <div class="mb-3">
                <label for="from_customer" class="form-label">From</label>
                <input type="text" class="form-control" id="from_customer" name="from_customer" value="<?=$from_customer_name;?>" size="50" disabled />
            </div>
            <div class="mb-3">
                <label for="to_customer_id" class="form-label">To</label>
                <select class="form-select" id="to_customer_id" name="to_customer_id" aria-label="Bank branch selection" required <?=($transfer_allowed ? '' : 'disabled');?> />
                    <option value="0"></option>
                    <?php $preselected_option = set_value('to_customer_id'); ?>
                    <?php foreach ($to_customer_options as $customer) :
                        $selected = !empty($preselected_option) && $preselected_option == $customer['id'] ? 'selected' : '';
                        $option_title = get_full_name($customer);
                        ?>
                    <option value="<?=$customer['id'];?>" <?=$selected;?>><?=$option_title;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount to transfer</label>
                <input type="text" class="form-control" id="amount" name="amount" value="<?=set_value('amount'); ?>" size="10" required <?=($transfer_allowed ? '' : 'disabled');?> />
            </div>
            <button type="submit" class="btn btn-primary" <?=($transfer_allowed ?: 'disabled');?>>Submit</button>
            </form>
        </div>
        <div class="col-sm">&nbsp;</div>
        <div class="col-sm">&nbsp;</div>
    </div>
</div>
<?php include(VIEWPATH . 'footer.php'); ?>
