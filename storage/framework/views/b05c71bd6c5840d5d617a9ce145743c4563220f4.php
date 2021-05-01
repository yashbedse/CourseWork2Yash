<div class="dc-widget dc-onlineoptions">
    <?php if(!empty($ask_query_img)): ?>
        <figure class="dc-onlinuserimg">
            <img src="<?php echo e(asset(Helper::getImage('uploads/settings/general', $ask_query_img))); ?>">
        </figure>
    <?php endif; ?>
    <?php if(!empty($query_title) 
        || !empty($query_subtitle)
        || !empty($query_btn_title)
        || !empty($query_desc) 
        ): ?>
        <div class="dc-onlineoption-content">
            <div class="dc-title">
                <h3><span><?php echo e(html_entity_decode(clean($query_subtitle))); ?></span> <?php echo e(html_entity_decode(clean($query_title))); ?></h3>
            </div>
            <div class="dc-btnarea">
                <a href="<?php echo e(url($query_btn_link)); ?>" class="dc-btn dc-btnactive"><?php echo e(html_entity_decode(clean($query_btn_title))); ?></a>
                <span><?php echo e(html_entity_decode(clean($query_desc))); ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/sidebar/ask-online.blade.php ENDPATH**/ ?>