<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
<p class="h6 pt-5 pb-2">Add new customer</p>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="text-danger"><?php echo validation_errors(); ?></div>
            <?php if (!empty($success_msg)) : ?>
                <p class="text-success"><?=$success_msg;?> Check it <a href="<?=site_url('customers');?>">here</a></p>
            <?php endif; ?>
            <?php if (isset($success) && false === $success) : ?>
            <p class="text-danger">Sorry, data has not been saved, please check form below and try again</p>
            <?php endif; ?>
            <?php echo form_open(''); ?>
            <div class="mb-3">
                <label for="first_name" class="form-label">First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?=set_value('first_name'); ?>" size="50" required />
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?=set_value('last_name'); ?>" size="50" required />
            </div>
            <div class="mb-3">
                <label for="bank_branch_id" class="form-label">Bank branch</label>
                <select class="form-select" id="branch_id" name="branch_id" aria-label="Bank branch selection" required >
                    <option value="0"></option>
                    <?php $preselected_option = set_value('branch_id'); ?>
                    <?php foreach ($branches as $branch) :
                        $country_name = $countries[$branch['country_code']] ?? 'Unknown';
                        $selected = !empty($preselected_option) && $preselected_option == $branch['id'] ? 'selected' : '';
                        $option_title = sprintf("%s [%s]", $branch['address'], $country_name);
                        ?>
                    <option value="<?=$branch['id'];?>" <?=$selected;?>><?=$option_title;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="balance" class="form-label">Balance</label>
                <input type="text" class="form-control" id="balance" name="balance" value="<?=set_value('balance'); ?>" size="10" required />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm">&nbsp;</div>
        <div class="col-sm">&nbsp;</div>
    </div>
</div>
<?php include(VIEWPATH . 'footer.php'); ?>
