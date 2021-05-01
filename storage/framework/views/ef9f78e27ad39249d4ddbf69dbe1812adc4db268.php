<?php if(!(Schema::hasTable('site_management'))): ?> 
    <?php 
        echo trans('lang.table_missing'); 
        die; 
    ?>
<?php else: ?>
    <?php 
    $registration = 'true';
    if (Schema::hasTable('site_management')) {
        $settings = !empty(App\SiteManagement::getMetaValue('general_settings')) ? App\SiteManagement::getMetaValue('general_settings') : array();
        $registration = !empty($settings) && !empty($settings['display_registration']) ? $settings['display_registration'] : 'true';
    }
    ?>
<?php endif; ?>
<?php $__env->startSection('header'); ?>
    <header id="dc-header" class="dc-header dc-haslayout">
        <?php if(Helper::getTopBarSettings('enable_topbar') == 'true'): ?>
            <div class="dc-topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="dc-helpnum">
                                <span><?php echo e(Helper::getTopBarSettings('title')); ?></span>
                                <a href="tel:<?php echo e(clean(Helper::getTopBarSettings('number'))); ?>"><?php echo e(clean(Helper::getTopBarSettings('number'))); ?></a>
                            </div>
                            <?php if(Helper::getTopBarSettings('enable_socials') === 'true'): ?>
                                <div class="dc-rightarea">
                                    <?php Helper::displaySocials('topbar'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="dc-navigationarea">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <strong class="dc-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset(Helper::getGeneralSettings('site_logo'))); ?>" alt="<?php echo e(trans('lang.site_logo')); ?>"></a></strong>
                        <div class="dc-rightarea">
                            <nav id="dc-nav" class="dc-nav navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="lnr lnr-menu"></i>
                                </button>
                                <div class="collapse navbar-collapse dc-navigation" id="navbarNav">
                                    <?php echo $__env->make('includes.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </nav>
                            <?php if(auth()->guard()->check()): ?>
                                <?php echo $__env->make('includes.profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                                <div class="dc-loginarea">
                                    <div class="dc-loginoption">
                                        <a href="javascript:void(0);" id="dc-loginbtn" class="dc-loginbtn"><?php echo e(trans('lang.login')); ?></a>
                                        <div class="dc-loginformhold">
                                            <div class="dc-loginheader">
                                                <span><?php echo e(trans('lang.login')); ?></span>
                                                <a href="javascript:;"><i class="fa fa-times"></i></a>
                                            </div>
                                            <form method="POST" action="<?php echo e(route('login')); ?>" class="dc-formtheme dc-loginform do-login-form">
                                                <?php echo csrf_field(); ?>
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input id="email" type="email" name="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                                            placeholder="<?php echo e(trans('lang.ph_email')); ?>" required autofocus>
                                                        <?php if($errors->has('email')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password" type="password" name="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                            placeholder="<?php echo e(trans('lang.ph_pass')); ?>" required>
                                                        <?php if($errors->has('password')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="dc-logininfo">
                                                        <span class="dc-checkbox">
                                                            <input id="remember" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                            <label for="remember"><?php echo e(trans('lang.remember')); ?></label>
                                                        </span>
                                                        <button type="submit" class="dc-btn do-login-button"><?php echo e(trans('lang.login')); ?></button>
                                                    </div>
                                                </fieldset>
                                                <div class="dc-loginfooterinfo">
                                                    <?php if(Route::has('password.request')): ?>
                                                        <a href="<?php echo e(route('password.request')); ?>" class="dc-forgot-password"><?php echo e(trans('lang.forget_pass')); ?></a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo e(route('register')); ?>"><?php echo e(trans('lang.create_account')); ?></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php if($registration == 'true'): ?>
                                        <a href="<?php echo e(route('register')); ?>" class="dc-btn"><?php echo e(trans('lang.join_now')); ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/includes/header.blade.php ENDPATH**/ ?>