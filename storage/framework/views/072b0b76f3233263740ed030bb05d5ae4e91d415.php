<div class="dc-widget dc-mobileappoptions">
    <?php if(!empty($download_app_img)): ?>
        <figure class="dc-appimgs">
            <img src="<?php echo e(asset(Helper::getImage('uploads/settings/general', $download_app_img))); ?>">
        </figure>
    <?php endif; ?>
    <div class="dc-mobileapp-content">
        <?php if(!empty($download_app_subtitle) 
            || !empty($download_app_title)
            || !empty($download_app_desc)
        ): ?>
            <div class="dc-title">
                <h3><span><?php echo e(html_entity_decode(clean($download_app_subtitle))); ?></span> <?php echo e(html_entity_decode(clean($download_app_title))); ?></h3>
            </div>
            <div class="dc-description">
                <p><?php echo e(html_entity_decode(clean($download_app_desc))); ?></p>
            </div>
        <?php endif; ?>
        <?php echo Form::open(['class' => 'dc-appemail-form', 'id' => 'download-app', '@submit.prevent' => 'sendAppLink']); ?>

            <input type="email" id="email" name="email" v-model="app.email" class="form-control" placeholder="<?php echo e(trans('lang.email_id')); ?>" required="">
            <button type="submit"><i class="fa fa-paper-plane"></i></button>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/sidebar/get-mobile-app.blade.php ENDPATH**/ ?>