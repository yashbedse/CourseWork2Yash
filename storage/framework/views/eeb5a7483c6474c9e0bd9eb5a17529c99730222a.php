<?php $__env->startPush('stylesheets'); ?>
	<link href="<?php echo e(asset('css/tipso.css')); ?>" rel="stylesheet">
	<?php echo $__env->yieldPushContent('front_end_stylesheets'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('front-end.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php 
	$inner_page_settings = !empty(App\SiteManagement::getMetaValue('inner_page_data')) ? App\SiteManagement::getMetaValue('inner_page_data') : array();
?>

<?php if(!empty($inner_page_settings['show_search_form']) && $inner_page_settings['show_search_form'] == 'true'): ?>
	<?php $__env->startSection('banner'); ?>
		<?php echo $__env->make('front-end.includes.inner-banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('main'); ?>
<main id="dc-main" class="dc-main dc-haslayout">
	<?php echo $__env->yieldContent('content'); ?>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('front-end.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/tipso.js')); ?>"></script>
<script>
	jQuery('.dc-tipso').tipso({
    tooltipHover: true
});
</script>
<?php echo $__env->yieldPushContent('front_end_scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/master.blade.php ENDPATH**/ ?>