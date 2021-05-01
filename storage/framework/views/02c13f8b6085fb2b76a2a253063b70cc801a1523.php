<aside class="dc-sidebar dc-sidebar-grid float-left mt-lg-0 mt-xl-0">
    <?php if(!empty($display_query_section) && $display_query_section == 'true'): ?>
        <?php echo $__env->make('front-end.sidebar.ask-online', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(Route::currentRouteName() == 'userProfile'): ?>
        <?php echo $__env->make('front-end.sidebar.report-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($display_get_app_sec) && $display_get_app_sec == 'true'): ?>
        <?php echo $__env->make('front-end.sidebar.get-mobile-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($display_get_ad_sec) && $display_get_ad_sec == 'true'): ?>
        <?php echo $__env->make('front-end.sidebar.advertisement', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</aside>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/sidebar/index.blade.php ENDPATH**/ ?>