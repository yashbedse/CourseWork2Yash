<?php $__env->startSection('footer'); ?>
    <footer id="dc-footer" class="dc-footer dc-haslayout">
        <?php if(Helper::getFooterSettings('show_contact_info_sec') === 'true'): ?>
            <?php if(!empty(Helper::getFooterSettings('contact_info_img_one')) || !empty(Helper::getFooterSettings('contact_info_img_two'))): ?>
                <div class="dc-footertopbar">
                    <div class="container">
                        <div class="row justify-content-center align-self-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                                <div class="dc-footer-call-email">
                                    <div class="dc-callinfoholder">
                                        <?php if(!empty(Helper::getFooterSettings('contact_info_img_one'))): ?>
                                            <figure class="dc-callinfoimg">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_one'), 'small-'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                            </figure>
                                        <?php endif; ?>
                                        <div class="dc-callinfocontent">
                                            <h3>
                                                <span><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_one')))); ?></span> 
                                                <a href="tel:<?php echo e(clean(Helper::getFooterSettings('contact_info_number'))); ?>"><?php echo e(clean(Helper::getFooterSettings('contact_info_number'))); ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="dc-callinfoholder dc-mailinfoholder">
                                        <?php if(!empty(Helper::getFooterSettings('contact_info_img_two'))): ?>
                                            <figure class="dc-callinfoimg">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_two'), 'small-'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                            </figure>
                                        <?php endif; ?>
                                        <div class="dc-callinfocontent">
                                            <h3>
                                                <span><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_two')))); ?></span> 
                                                <a href="mailto:<?php echo e(clean(Helper::getFooterSettings('contact_info_email'))); ?>"><?php echo e(clean(Helper::getFooterSettings('contact_info_email'))); ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                    <span class="dc-or-text">- <?php echo e(trans('lang.or')); ?> -</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="dc-fthreecolumns">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
                        <div class="dc-fcol dc-widgetcontactus">
                            <strong class="dc-logofooter"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset(Helper::getFooterSettings('footer_logo'))); ?>" alt="<?php echo e(trans('lang.site_logo')); ?>"></a></strong>
                            <div class="dc-footercontent">
                                <div class="dc-description">
                                    <?php echo clean(str_limit(Helper::getFooterSettings('footer_about_us_note'), 100)); ?>

                                </div>
                                <?php if(!empty(Helper::getFooterSettings('footer_address'))
                                    || !empty(Helper::getFooterSettings('footer_email'))
                                    || !empty(Helper::getFooterSettings('footer_phone'))): ?>
                                    <ul class="dc-footercontactus">
                                        <li><address><i class="lnr lnr-location"></i> <?php echo e(html_entity_decode(clean(Helper::getFooterSettings('footer_address')))); ?></address></li>
                                        <li><a href="mailto:<?php echo e(clean(Helper::getFooterSettings('footer_email'))); ?>"><i class="lnr lnr-envelope"></i> <?php echo e(clean(Helper::getFooterSettings('footer_email'))); ?></a></li>
                                        <li>
                                            <span>
                                                <i class="lnr lnr-phone-handset"></i> 
                                                <a href="tel:<?php echo e(clean(Helper::getFooterSettings('footer_phone'))); ?>"><?php echo e(clean(Helper::getFooterSettings('footer_phone'))); ?></a>
                                            </span>
                                        </li>
                                    </ul>
                                <?php endif; ?>

                                <?php if(Helper::getFooterSettings('show_footer_socials') === 'true'): ?>
                                    <div class="dc-fsocialicon">
                                        <?php echo e(Helper::displaySocials('footer')); ?>

                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 float-left">
                        <div class="tg-widgettwitter dc-fcol dc-flatestad dc-twitter-live-wgdets">
                            <div class="dc-ftitle"><h3><?php echo e(trans('lang.footer_twitter_title')); ?></h3></div>				
                            <div class="dc-footercontent">
                                <?php echo $__env->make('front-end.includes.twitter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 float-left">
                        <div class="dc-fcol dc-newsletterholder">
                            <div class="dc-footercontent dc-newsletterholder">
                                <?php if( !empty(Helper::getDownloadAppSection('show_app_sec')) && Helper::getDownloadAppSection('show_app_sec') == 'true'): ?>
                                    <div class="dc-footerapps">
                                        <div class="dc-ftitle"><h3><?php echo e(html_entity_decode(clean(Helper::getDownloadAppSection('title')))); ?></h3></div>
                                        <ul class="dc-btnapps">
                                            <li>
                                                <a href="<?php echo e(Helper::getDownloadAppSection('android_url')); ?>">
                                                    <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('android_img'), 'small-', 'default-footer-android.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(Helper::getDownloadAppSection('ios_url')); ?>">
                                                    <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('ios_img'), 'small-', 'default-footer-ios.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dc-footerbottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="dc-copyright"><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('footer_copyright')))); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>

<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/includes/footer.blade.php ENDPATH**/ ?>