<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"> <!--<![endif]-->
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(Helper::getTextDirection()); ?>">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php if(trim($__env->yieldContent('title'))): ?>
		<title><?php echo $__env->yieldContent('title'); ?></title>
	<?php else: ?> 
		<title><?php echo e(config('app.name')); ?></title>
	<?php endif; ?>
	<meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
	<meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="icon" href="<?php echo e(asset(Helper::getGeneralSettings('site_favicon'))); ?>" type="image/x-icon">
	<?php echo $__env->yieldPushContent('PackageStyle'); ?>
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/normalize.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/fontawesome/fontawesome-all.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/linearicons.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/themify-icons.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/jquery-ui.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/rtl.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/transitions.css')); ?>" rel="stylesheet">
	<?php echo $__env->yieldPushContent('stylesheets'); ?>
	<?php echo $__env->yieldPushContent('inlineStyle'); ?>
	<?php echo \App\Typo::setSiteStyling(); ?>
    <script type="text/javascript">
        var APP_URL = <?php echo json_encode(url('/')); ?>

        var Map_key = <?php echo json_encode(Helper::getGoogleMapApiKey()); ?>

	</script>
	<?php if(Auth::user()): ?>
		<script type="text/javascript">
			var USERID = <?php echo json_encode(Auth::user()->id); ?>

			window.Laravel = <?php echo json_encode([
			'csrfToken'=> csrf_token(),
			'user'=> [
				'authenticated' => auth()->check(),
				'id' => auth()->check() ? auth()->user()->id : null,
				'name' => auth()->check() ? auth()->user()->first_name : null,
				'image' => !empty(auth()->user()->profile->avatar) ? asset('uploads/users/'.auth()->user()->id .'/'.auth()->user()->profile->avatar) : asset('images/user-login.png'),
				'image_name' => !empty(auth()->user()->profile->avatar) ? auth()->user()->profile->avatar : '',
				]
				]); ?>;
		</script>
	<?php endif; ?>
    <script>
            window.trans = <?php
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            echo json_encode($trans);
            ?>;
    </script>
</head>
<body class="<?php echo e('lang-'.str_replace('_', '-', app()->getLocale())); ?> <?php echo e(Helper::getTextDirection()); ?>">
    <?php echo e(\App::setLocale(env('APP_LANG'))); ?>

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!-- Wrapper Start -->
	<div id="dc-wrapper" class="dc-wrapper dc-haslayout">
		<?php echo $__env->yieldContent('header'); ?>

		<?php echo $__env->yieldContent('banner'); ?>

		<?php echo $__env->yieldContent('main'); ?>
		
		<?php echo $__env->yieldContent('footer'); ?>
	</div>
	<script src="<?php echo e(asset('js/vendor/jquery-3.3.1.js')); ?>"></script>
	<?php echo $__env->yieldContent('bootstrap_script'); ?>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/vendor/jquery-library.js')); ?>"></script>
	<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\3\resources\views/master.blade.php ENDPATH**/ ?>