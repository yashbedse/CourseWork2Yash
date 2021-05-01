<?php $__env->startSection('content'); ?>
    <div class="dc-breadcrumbarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ol class="dc-breadcrumb">
                        <li><a href="<?php echo e(url('/')); ?>"><?php echo e(trans('lang.home')); ?></a></li>
                        <li><?php echo e(trans('lang.page_not_found')); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="dc-haslayout dc-main-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dc-errorpage">
                        <figure>
                            <img src="<?php echo e(asset('images/doc-error/img-01.jpg')); ?>">
                        </figure>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="dc-errorcontent">
                        <div class="dc-title">
                            <h4><?php echo e(trans('lang.something_went_wrong')); ?></h4>
                            <h3><?php echo e(trans('lang.oop_page_not_found')); ?></h3>
                        </div>
                        <div class="dc-description">
                            <p><?php echo e(trans('lang.404_note')); ?></p>
                        </div>
                        <?php echo Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'error_search_form', 'class' => 'dc-formtheme dc-formnewsletter']); ?>

                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="<?php echo e(trans('lang.ph.hospitals_clinic_etc')); ?>">
                                </div>
                            </fieldset>
                            <div class="dc-btnarea">
                                <?php echo Form::submit(trans('lang.search'), ['class' => 'dc-btn']); ?>

                                <span><?php echo e(trans('lang.go_back_to')); ?> <a href="<?php echo e(url('/')); ?>"> <?php echo e(trans('lang.homepage')); ?></a> <?php echo e(trans('lang.start_again')); ?></span>
                            </div>
                        <?php echo form::close();; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\3\resources\views/errors/404.blade.php ENDPATH**/ ?>