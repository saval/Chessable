<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include(VIEWPATH . 'header.php'); ?>
<p class="h6 pt-5 pb-2">Add new Bank branch</p>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="text-danger"><?php echo validation_errors(); ?></div>
            <?php if (!empty($success_msg)) : ?>
                <p class="text-success"><?=$success_msg;?> Check it <a href="<?=site_url('branches');?>">here</a></p>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
            <p class="text-danger">Sorry, data has not been saved, please check form below and try again</p>
            <?php endif; ?>
            <?php echo form_open(''); ?>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <?=form_dropdown(
                    'country_code',
                    $countries,
                    set_value('country_code'),
                    ['id' => 'country_code', 'class' => 'form-select']
                );?>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address'); ?>" size="255" required />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm">&nbsp;</div>
        <div class="col-sm">&nbsp;</div>
    </div>
</div>
<?php include(VIEWPATH . 'footer.php'); ?>
