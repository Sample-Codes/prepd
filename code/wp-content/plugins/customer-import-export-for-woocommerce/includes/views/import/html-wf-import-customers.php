<div class="tool-box">
    <h3 class="title"><?php _e('Import Users in CSV Format:', 'wf_customer_import_export'); ?></h3>
    <p><?php _e('Import Users in CSV format from different sources (  from your computer OR from another server via FTP )', 'wf_customer_import_export'); ?></p>
    <p class="submit">
        <?php
        $merge_url = admin_url('admin.php?import=wordpress_hf_user_csv&merge=1');
        $import_url = admin_url('admin.php?import=wordpress_hf_user_csv');
        ?>
        <a class="button button-primary" id="mylink" href="<?php echo admin_url('admin.php?import=wordpress_hf_user_csv'); ?>"><?php _e('Import Users', 'wf_customer_import_export'); ?></a>
        &nbsp;
        <input type="checkbox" id="merge" value="0"><?php _e('Update User if exists', 'wf_customer_import_export'); ?> <br>
    </p>
</div>
<script type="text/javascript">
    jQuery('#merge').click(function () {
        if (this.checked) {
            jQuery("#mylink").attr("href", '<?php echo $merge_url ?>');
        } else {
            jQuery("#mylink").attr("href", '<?php echo $import_url ?>');
        }
    });
</script>