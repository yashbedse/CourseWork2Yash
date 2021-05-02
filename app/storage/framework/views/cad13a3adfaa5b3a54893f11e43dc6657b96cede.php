<div class="dc-homesliderholder dc-haslayout" style="background:url(<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getHomeSlider('slider_bg_image')))); ?>)">
    <div id="dc-homeslider" class="dc-homeslider">
        <div id="dc-bannerslider" class="dc-bannerslider carousel slide" data-ride="false" data-interval="false">
            <ol class="carousel-indicators dc-bannerdots">
                <li data-target="#dc-bannerslider" data-slide-to="0" class="active"></li>
                <li data-target="#dc-bannerslider" data-slide-to="1"></li>
                <li data-target="#dc-bannerslider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <?php $counter = 1; ?>
                <?php $__currentLoopData = Helper::getHomeSlider('home_slides'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $class = !empty($counter) && $counter === 1 ? 'active' : ''; ?>
                    <div class="carousel-item <?php echo e($class); ?>" id="carousel-item-<?php echo e($counter); ?>">
                        <div class="d-flex justify-content-center dc-craousel-content">
                            <div class="mx-auto">
                                <img class="d-block dc-bannerimg" src="<?php echo e(asset(Helper::getImage('uploads/settings/home', $slide['hidden_slide_inner_image'], '', 'slider-default.png'))); ?>" 
                                    alt="<?php echo e(clean(trans('lang.slide_img'))); ?>">
                                <div class="dc-bannercontent dc-bannercotent-craousel" >
                                    <div class="dc-content-carousel">
                                        <div class="dc-num"><?php echo e(sprintf("%02d.", $counter)); ?></div>
                                        <h1>
                                            <em><?php echo e(html_entity_decode(clean($slide['slide_title_one']))); ?></em> 
                                            <?php echo e(html_entity_decode(clean($slide['slide_title_two']))); ?>

                                            <span> <?php echo e(html_entity_decode(clean($slide['slide_title_three']))); ?></span>
                                        </h1>
                                        <?php if(!empty($slide['slide_btn_title_one']) || $slide['slide_btn_title_two']): ?>
                                            <div class="dc-btnarea">
                                                <?php if(!empty($slide['slide_btn_title_one'])): ?>
                                                    <a href="<?php echo e($slide['slide_btn_url_one']); ?>" class="dc-btn dc-btnactive"><?php echo e(html_entity_decode(clean($slide['slide_btn_title_one']))); ?></a>
                                                <?php endif; ?>
                                                <?php if(!empty($slide['slide_btn_title_two'])): ?>
                                                    <a href="<?php echo e($slide['slide_btn_url_two']); ?>" class="dc-btn"><?php echo e(html_entity_decode(clean($slide['slide_btn_title_two']))); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a class="dc-carousel-control-prev" href="#dc-bannerslider" role="button" data-slide="prev">
                    <span class="dc-carousel-control-prev-icon" aria-hidden="true"><span><?php echo e(clean(trans('lang.pr'))); ?></span><span class="d-block"><?php echo e(clean(trans('lang.ev'))); ?></span></span>
                    <span class="sr-only"><?php echo e(clean(trans('lang.previous'))); ?></span>
                </a>
                <a class="dc-carousel-control-next" href="#dc-bannerslider" role="button" data-slide="next">
                    <span class="dc-carousel-control-next-icon " aria-hidden="true"><span><?php echo e(clean(trans('lang.ne'))); ?></span><span class="d-block"><?php echo e(clean(trans('lang.xt'))); ?></span></span>
                    <span class="sr-only"><?php echo e(clean(trans('lang.next'))); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/slider.blade.php ENDPATH**/ ?>