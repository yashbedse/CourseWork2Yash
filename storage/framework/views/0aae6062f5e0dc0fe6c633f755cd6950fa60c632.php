<?php if(Schema::hasTable('site_management')): ?> 
    <?php 
        $seo_settings = App\SiteManagement::getMetaValue('seo_settings'); //Article Section
        $meta_title = !empty($seo_settings['meta_title']) ? $seo_settings['meta_title'] : '';
        $meta_desc = !empty($seo_settings['meta_desc']) ? $seo_settings['meta_desc'] : '';
    ?>
    <?php $__env->startSection('title'); ?><?php echo e($meta_title); ?> <?php $__env->stopSection(); ?>
    <?php $__env->startSection('description', "$meta_desc"); ?>
<?php endif; ?>
<?php $__env->startSection('banner'); ?>
    <?php if(!empty(Helper::getHomeSlider('home_slides'))): ?>
        <?php echo $__env->make('front-end.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('front_end_stylesheets'); ?>
    <link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.pre-loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="home">
        <?php if(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='10' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak>
                </flash_messages>
            </div>
        <?php endif; ?>
        <section class="dc-searchholder dc-haslayout">
            <?php if(Helper::getSearchBanner('show_banner') === 'true'): ?>
                <?php 
                    $locations = App\Location::all(); 
                    $roles     = Spatie\Permission\Models\Role::all()->toArray();
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="dc-searchform-holder">
                                <div class="dc-advancedsearch">
                                    <div class="dc-title">
                                        <h2><?php echo e(html_entity_decode(clean(Helper::getSearchBanner('form_title')))); ?></h2>
                                        <a href="javascript:void(0);" class="dc-docsearch" v-on:click="displayFilfer">
                                            <span class="dc-advanceicon"><i></i> <i></i> <i></i></span>
                                            <span><?php echo e(trans('lang.advanced')); ?> <br><?php echo e(trans('lang.search')); ?></span>
                                        </a>
                                    </div>
                                    <?php echo Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => 'dc-formtheme dc-form-advancedsearch']); ?>

                                        <fieldset>
                                            <div class="form-group">
                                                <input type="text" name="search" value="" class="form-control" placeholder="<?php echo e(trans('lang.ph.hospitals_clinic_etc')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="dc-select">
                                                    <select class="chosen-select locations" data-placeholder="<?php echo e(clean(trans('lang.select_country'))); ?>" name="locations">
                                                        <option value=""><?php echo e(clean(trans('lang.select_country'))); ?></option>
                                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(clean($location->slug)); ?>"><?php echo e(html_entity_decode(clean($location->title))); ?>*</option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="dc-formbtn">
                                                <?php echo e(Form::button('<i class="ti-arrow-right"></i>', ['type' => 'submit', 'class' => 'btn-sm'] )); ?>

                                            </div>
                                        </fieldset>
                                        <fieldset style="display: none;" class="dc-home-advancedsearch">
                                            <div class="form-group">
                                                <div class="dc-select">
                                                    <select class="chosen-select locations" name="type">
                                                        <?php if(!empty($roles)): ?>
                                                            <option value="both" selected><?php echo e(trans('lang.both')); ?></option>
                                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!in_array($role['role_type'] == 'admin', $roles) && !in_array($role['role_type'] == 'regular', $roles)): ?>
                                                                    <?php $selected = !empty($_GET['type']) && $_GET['type'] == $role['role_type'] ? 'selected' : ''; ?>
                                                                    <option value="<?php echo e(clean($role['role_type'])); ?>" <?php echo e($selected); ?>><?php echo e(html_entity_decode(clean($role['name']))); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <speciality-services 
                                            :specialities="specialities" 
                                            v-if="show_speciality"
                                            :speciality_value_type="'slug'"
                                            :service_value_type="'slug'"
                                            v-cloak >
                                            </speciality-services>
                                        </fieldset>
                                    <?php echo form::close();; ?>

                                </div>
                                <div class="dc-jointeamholder">
                                    <div class="dc-jointeam">
                                        <span class="dc-jointeamnoti"><i class="ti-light-bulb"></i></span>
                                        <figure class="dc-jointeamimg">
                                            <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getSearchBanner('banner_img'), 'small-', 'img-04.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                        </figure>
                                        <div class="dc-jointeamcontent">
                                            <h3><span><?php echo e(html_entity_decode(clean(Helper::getSearchBanner('banner_subheading')))); ?></span><?php echo e(html_entity_decode(clean(Helper::getSearchBanner('banner_heading')))); ?></h3>
                                            <a href="<?php echo e(Helper::getSearchBanner('btn_url')); ?>" class="dc-btn dc-btnactive"><?php echo e(html_entity_decode(clean(Helper::getSearchBanner('btn_title')))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(Helper::getServicesSection('show_services_section') === 'true'): ?>
                <?php if(!empty(Helper::getServicesSection('services_tabs'))): ?>
                    <div class="dc-haslayout">
                        <div class="container-fluid">
                            <div class="row">
                                <div id="dc-doctorslider" class="dc-doctorslider owl-carousel">
                                    <?php $count = 1; ?>
                                    <?php $__currentLoopData = Helper::getServicesSection('services_tabs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service_tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $color = !empty($service_tab['color']) ? html_entity_decode(clean($service_tab['color'])) : ''; 
                                            $hex = $color;
                                            list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                                        ?>
                                        <?php $__env->startPush('inlineStyle'); ?>
                                            <style>
                                                .dc-titlecolor<?php echo e($count); ?> h3 {
                                                    color: <?php echo e($color); ?>;
                                                }
                                                .dc-titlecolor<?php echo e($count); ?> .dc-btn {
                                                    border-color: <?php echo e($color); ?>;
                                                }
                                                .dc-titlecolor<?php echo e($count); ?>.dc-doctordetails-holder:after {
                                                    background: <?php echo e($color); ?>;
                                                }
                                                .dc-titlecolor<?php echo e($count); ?> .dc-btn:hover {
                                                    background: <?php echo e($color); ?>;
                                                    -webkit-box-shadow: 0 9px 20px 0 rgba(<?php echo e($r); ?>,<?php echo e($g); ?>,<?php echo e($b); ?>,0.5);
                                                    box-shadow: 0 9px 20px 0 rgba(<?php echo e($r); ?>,<?php echo e($g); ?>,<?php echo e($b); ?>,0.5);
                                                }
                                            </style>
                                        <?php $__env->stopPush(); ?>
                                        <div class="item dc-doctordetails-holder dc-titlecolor<?php echo e($count); ?>">
                                            <span class="dc-slidercounter"><?php echo e(sprintf("%02d.", $count)); ?></span>
                                            <h3><span><?php echo e(html_entity_decode(clean($service_tab['title']))); ?></span> <?php echo e(html_entity_decode(clean($service_tab['subtitle']))); ?></h3>
                                            <a href="<?php echo e($service_tab['btn_url']); ?>" class="dc-btn"><?php echo e(html_entity_decode(clean($service_tab['btn_title']))); ?></a>
                                        </div>
                                        <?php $count++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <!-- Bring Care Start -->
        <?php if(!empty(Helper::getAboutUsSection('show_about_sec')) && Helper::getAboutUsSection('show_about_sec') === 'true'): ?>
            <section class="dc-haslayout dc-main-section dc-sectionbg">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 align-self-center">
                            <div class="dc-bringcarecontent">
                                <div class="dc-sectionhead dc-sectionheadvtwo">
                                    <div class="dc-sectiontitle">
                                        <h2><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('title')))); ?><span><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('subtitle')))); ?></span></h2>
                                    </div>
                                    <div class="dc-description">
                                        <?php echo clean(Helper::getAboutUsSection('description')); ?>

                                    </div>
                                </div>
                                <?php if(!empty(Helper::getAboutUsSection('btn_one_title')) || !empty(Helper::getAboutUsSection('btn_two_title'))): ?>
                                    <div class="dc-btnarea">
                                        <?php if(!empty(Helper::getAboutUsSection('btn_one_title'))): ?>
                                            <a href="<?php echo e(Helper::getAboutUsSection('btn_one_url')); ?>" class="dc-btn"><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('btn_one_title')))); ?></a>
                                        <?php endif; ?>
                                        <?php if(!empty(Helper::getAboutUsSection('btn_one_title'))): ?>
                                            <a href="<?php echo e(Helper::getAboutUsSection('btn_two_url')); ?>" class="dc-btn dc-btnactive"><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('btn_two_title')))); ?></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="dc-bringimg-holder">
                                <figure class="dc-doccareimg">
                                    <?php if(!empty(Helper::getAboutUsSection('about_us_img'))): ?>
                                        <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getAboutUsSection('about_us_img'), '', 'doc-img.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                    <?php endif; ?>
                                    <?php if(!empty(Helper::getAboutUsSection('img_title')) || !empty(Helper::getAboutUsSection('img_subtitle'))): ?>
                                        <figcaption>
                                            <div class="dc-doccarecontent">
                                                <h3><em><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('img_title')))); ?></em><?php echo e(html_entity_decode(clean(Helper::getAboutUsSection('img_subtitle')))); ?></h3>
                                            </div>
                                        </figcaption>
                                    <?php endif; ?>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Bring Care End -->
        <!-- Works Section Start -->
        <section class="dc-haslayout">
            <div class="dc-haslayout dc-bgcolor dc-main-section dc-workholder">
                <div class="container">
                    <?php if( !empty(Helper::getHowItWorksSection('show_how_work_sec')) && Helper::getHowItWorksSection('show_how_work_sec') == 'true'): ?>
                        <div class="row justify-content-center align-self-center">
                            <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-8 push-lg-2">
                                <div class="dc-sectionhead dc-text-center">
                                    <div class="dc-sectiontitle">
                                        <h2><span><?php echo e(html_entity_decode(clean(Helper::getHowItWorksSection('subtitle')))); ?></span><?php echo e(html_entity_decode(clean(Helper::getHowItWorksSection('title')))); ?></h2>
                                    </div>
                                    <div class="dc-description">
                                        <?php echo clean(Helper::getHowItWorksSection('description')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(!empty(Helper::getHowItWorksSection('show_how_work_tabs')) && Helper::getHowItWorksSection('show_how_work_tabs') == 'true'): ?>
                <?php if(!empty(Helper::getHowItWorksSection('how_works_tabs'))): ?>
                    <div class="dc-haslayout dc-main-section dc-workdetails-holder">
                        <div class="container">
                            <div class="row">
                                <?php $__currentLoopData = Helper::getHowItWorksSection('how_works_tabs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hw_tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class="dc-workdetails">
                                            <div class="dc-workdetail">
                                                <figure>
                                                    <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', $hw_tab['tab_img'], '', 'hw-tab-default.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                </figure>
                                            </div>
                                            <div class="dc-title">
                                                <span><?php echo e(html_entity_decode(clean($hw_tab['subtitle']))); ?></span>
                                                <h3><?php echo e(html_entity_decode(clean($hw_tab['title']))); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <!-- Works Section End -->
        <!-- Our Rated Start -->
        <?php if(Helper::getSpecialitySlider('display') == 'true'): ?>
            <section class="dc-haslayout dc-main-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
                            <div class="row">
                                <div class="dc-ratedecontent dc-bgcolor">
                                    <figure class="dc-neurosurgeons-img">
                                        <img src="<?php echo e(asset(Helper::getSpecialitySlider('speciality')['image'])); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                    </figure>
                                    <div class="dc-sectionhead dc-sectionheadvtwo dc-text-center">
                                        <div class="dc-sectiontitle">
                                            <h2><?php echo e(trans('lang.our_top_rated')); ?><span><?php echo e(html_entity_decode(clean( Helper::getSpecialitySlider('speciality')['title']))); ?></span></h2>
                                        </div>
                                        <div class="dc-description">
                                            <p><?php echo e(clean(Helper::getSpecialitySlider('speciality')['description'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="dc-btnarea">
                                        <a href="<?php echo e(url('search-results?search=&type=doctor&speciality='.Helper::getSpecialitySlider('speciality')['slug'])); ?>" class="dc-btn"><?php echo e(trans('lang.view_all')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty(Helper::getSpecialitySlider('speciality')['doctors']) && count(Helper::getSpecialitySlider('speciality')['doctors']) > 0): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">
                                <div class="row">
                                    <div id="dc-docpostslider" class="dc-docpostslider owl-carousel">
                                        <?php $__currentLoopData = Helper::getSpecialitySlider('speciality')['doctors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $doctor = App\User::find($service_id); 
                                                $user = App\User::findOrFail($doctor->id);
                                                $saved_doctors = Auth::check() && !empty(Auth::user()->profile->saved_doctors) ? unserialize(Auth::user()->profile->saved_doctors) : array();
                                                $avg_rating = App\Feedback::where('user_id', $user->id)->pluck('avg_rating')->first();
                                                $stars  = $avg_rating != 0 ? $avg_rating / 5 * 100 : 0;
                                            ?> 
                                            <div class="item">
                                                <div class="dc-docpostholder">
                                                    <figure class="dc-docpostimg">
                                                        <img src="<?php echo e(asset(Helper::getImage('uploads/users/'.$doctor->id,  $doctor->profile->avatar, 'medium-', 'user.jpg'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                    </figure>
                                                    <div class="dc-docpostcontent">
                                                        <?php if(!empty($saved_doctors) && in_array($user->id, $saved_doctors)): ?>
                                                            <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="javascript:void(0);" class="dc-like"><i class="fa fa-heart"></i></a>
                                                            <a href="javascrip:void(0);" class="dc-like" id="doctor-<?php echo e($user->id); ?>" @click.prevent="add_wishlist('doctor-<?php echo e($user->id); ?>', '<?php echo e($user->id); ?>', 'saved_doctors', '')" v-cloak>
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <div class="dc-title">
                                                            <a href="javascript:void(0)" class="dc-docstatus"><?php echo e(html_entity_decode(clean(Helper::getSpecialitySlider('speciality')['title']))); ?></a>
                                                            <h3>
                                                                <a href="<?php echo e(route('userProfile', clean($doctor->slug))); ?>">
                                                                    <?php echo e(!empty($doctor->profile->gender_title) ? Helper::getDoctorArray(clean($doctor->profile->gender_title)) : ''); ?> 
                                                                    <?php echo e(Helper::getUserName($doctor->id)); ?>

                                                                </a> 
                                                                <?php echo e(Helper::verifyMedical(clean($doctor->id))); ?> <?php echo e(Helper::verifyUser(clean($doctor->id))); ?>

                                                            </h3>
                                                            <ul class="dc-docinfo">
                                                                <li><?php echo e(html_entity_decode(clean($doctor->profile->tagline))); ?></li>
                                                                <li>
                                                                    <span class="dc-stars"><span style="width: <?php echo e($stars); ?>%;"></span></span><em><?php echo e($doctor->feedbacks->count()); ?> <?php echo e(trans('lang.feedbacks')); ?></em>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="dc-doclocation">
                                                            <span><i class="ti-direction-alt"></i> <?php echo e(!empty($doctor->location) ? html_entity_decode(clean($doctor->location->title)) : ''); ?></span>
                                                            <?php if(!empty($doctor->profile->available_days)): ?>
                                                                <span>
                                                                    <i class="ti-calendar"></i>
                                                                    <?php $__currentLoopData = Helper::getAppointmentDays(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if(!in_array($key, unserialize($doctor->profile->available_days))): ?>
                                                                            <em class="dc-dayon"><?php echo e(html_entity_decode(clean($day['title']))); ?></em>
                                                                        <?php else: ?>
                                                                            <?php echo e(html_entity_decode(clean($day['title']))); ?>,
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(route('userProfile', clean($doctor->slug))); ?>" class="dc-btn"><?php echo e(trans('lang.view_more')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Our Rated End -->
        <!-- Mobile App Start -->
        <?php if( !empty(Helper::getDownloadAppSection('show_app_sec')) && Helper::getDownloadAppSection('show_app_sec') == 'true'): ?>
            <section class="dc-haslayout dc-bgcolor">
                <div class="container">
                    <div class="row">
                        <?php if(!empty(Helper::getDownloadAppSection('app_sec_img'))): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="dc-appbgimg">
                                    <figure>
                                        <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('app_sec_img'), '', 'app-default.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                    </figure>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 justify-content-center align-self-center">
                            <div class="dc-appcontent">
                                <div class="dc-sectionhead dc-sectionheadvtwo">
                                    <div class="dc-sectiontitle">
                                        <h2><?php echo e(html_entity_decode(clean(Helper::getDownloadAppSection('title')))); ?><span><?php echo e(html_entity_decode(clean(Helper::getDownloadAppSection('subtitle')))); ?></span></h2>
                                    </div>
                                    <div class="dc-description">
                                        <?php echo clean(Helper::getDownloadAppSection('description')); ?>

                                    </div>
                                </div>
                                <ul class="dc-appicons">
                                    <?php if(!empty(Helper::getDownloadAppSection('android_url'))): ?>
                                        <li>
                                            <a href="<?php echo e(Helper::getDownloadAppSection('android_url')); ?>">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('android_img'), '', 'google-default.png'))); ?>" 
                                                    alt="<?php echo e(trans('lang.img_desc')); ?>">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty(Helper::getDownloadAppSection('ios_url'))): ?>
                                        <li>
                                            <a href="<?php echo e(Helper::getDownloadAppSection('ios_url')); ?>">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('ios_img'), '', 'ios-default.png'))); ?>" 
                                                alt="<?php echo e(trans('lang.img_desc')); ?>">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if(Helper::getArticleSectionSettings('show_article_sec') === 'true'): ?>
            <section class="dc-haslayout dc-main-section">
                <div class="container">
                    <div class="row justify-content-center align-self-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                            <div class="dc-sectionhead dc-text-center">
                                <div class="dc-sectiontitle">
                                    <h2>
                                        <span><?php echo e(html_entity_decode(clean(Helper::getArticleSectionSettings('section_subtitle')))); ?></span>
                                        <?php echo e(html_entity_decode(clean(Helper::getArticleSectionSettings('section_title')))); ?>

                                    </h2>
                                </div>
                                <div class="dc-description">
                                    <p><?php echo e(clean(Helper::getArticleSectionSettings('section_description'))); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty(\App\Article::getArticles(3, true)->count() > 0) ): ?>
                            <div class="dc-articlesholder">
                                <?php $__currentLoopData = \App\Article::getArticles(3, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                                        <div class="dc-article">
                                            <figure class="dc-articleimg">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/users/'.$article->author->id.'/articles/', $article->image, 'featured-', 'featured-article-default.jpg'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                <figcaption>
                                                    <div class="dc-articlesdocinfo">
                                                        <img src="<?php echo e(asset(Helper::getImage('uploads/users/'.$article->author->id, App\User::find($article->author->id)->profile->avatar, 'extra-small-', 'user-login.png'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                        <span><?php echo e(Helper::getUserName($article->author_id)); ?></span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <div class="dc-articlecontent">
                                                <div class="dc-title">
                                                    <div class="dc-articleby-holder">
                                                        <?php if(!empty($article->categories) && $article->categories->count() > 0): ?>
                                                            <?php $__currentLoopData = $article->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <a href="<?php echo e(route('articleListing', clean($category->slug))); ?>" class="dc-articleby"><?php echo e($category->title); ?></a>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <h3><a href="<?php echo e(route('articleDetail', ['slug' => clean($article->slug) ])); ?>"><?php echo e(html_entity_decode(clean($article->title))); ?></a></h3>
                                                    <span class="dc-datetime"><i class="ti-calendar"></i> <?php echo e(Carbon\Carbon::parse($article->created_at)->format('M d, Y')); ?></span>
                                                </div>
                                                <ul class="dc-moreoptions">
                                                    <li><a href="javascript:void(0);"><i class="ti-heart"></i></a> <?php echo e(!empty($article->likes) ? clean($article->likes) : 0); ?> <?php echo e(trans('lang.likes')); ?></li>
                                                    <li><a href="javascript:void(0);"><i class="ti-eye"></i></a><?php echo e(!empty($article->views) ? clean($article->views) : 0); ?> <?php echo e(trans('lang.views')); ?></li>
                                                    <li id="dc-share-<?php echo e(clean($article->id)); ?>" @click="socialPopup('<?php echo e(clean($article->id)); ?>')" class="la-shareicon">
                                                        <a href="javascript:void(0);"><i class="ti-share"></i> <?php echo e(trans('lang.share')); ?></a>
                                                        <ul class="dc-simplesocialicons dc-socialiconsborder">
                                                            <li class="dc-facebook">
                                                                <a href="javascript:void()" @click="socialShare('https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('articleDetail', ['slug' => clean($article->slug)]))); ?>')" class="social-share">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-twitter">
                                                                <a href="javascript:void()" @click="socialShare('https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('articleDetail', ['slug' => clean($article->slug)]))); ?>')" class="social-share">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-linkedin">
                                                                <a href="javascript:void()" @click="socialShare('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode(route('articleDetail', ['slug' => clean($article->slug)]))); ?>')" class="social-share">
                                                                    <i class="fab fa-linkedin-in"></i></a>
                                                            </li>
                                                            <li class="dc-googleplus">
                                                                <a href="javascript:void()" @click="socialShare('https://plus.google.com/share?url=<?php echo e(urlencode(route('articleDetail', ['slug' => clean($article->slug)]))); ?>')" class="social-share">
                                                                    <i class="fab fa-google-plus-g"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Latest Articles End -->
        <section class="dc-haslayaout dc-footeraboutus dc-bgcolor">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('first_menu_title')))); ?></h3>
                            </div>
                            <?php if(!empty(\App\Speciality::count() > 0 )): ?>
                                <ul class="dc-fwidgetcontent">
                                    <?php $__currentLoopData = \App\Speciality::limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(url('search-results?search=&speciality='.clean($speciality->slug))); ?>"><?php echo e(html_entity_decode(clean($speciality->title))); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dc-viewmore"><a href="<?php echo e(url('search-results')); ?>"><?php echo e(trans('lang.view_all')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('second_menu_title')))); ?></h3>
                            </div>
                            <?php if(!empty(\App\Speciality::count() > 0 )): ?>
                                <ul class="dc-fwidgetcontent">
                                    <?php $__currentLoopData = \App\Speciality::limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(url('search-results?search=&speciality='.clean($speciality->slug).'&type=doctor&locations='.Helper::getFooterSettings('second_menu_location'))); ?>">
                                                <?php echo e(html_entity_decode(clean($speciality->title))); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dc-viewmore">
                                        <a href="<?php echo e(url('search-results?type=doctor&locations='.Helper::getFooterSettings('second_menu_location'))); ?>">
                                            <?php echo e(trans('lang.view_all')); ?>

                                        </a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('third_menu_title')))); ?></h3>
                            </div>
                            <?php if(!empty(\App\Speciality::count() > 0 )): ?>
                                <ul class="dc-fwidgetcontent">
                                    <?php $__currentLoopData = \App\Speciality::limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(url('search-results?search=&speciality='.clean($speciality->slug).'&type=doctor&locations='.Helper::getFooterSettings('third_menu_location'))); ?>">
                                                <?php echo e(html_entity_decode(clean($speciality->title))); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dc-viewmore">
                                        <a href="<?php echo e(url('search-results?type=doctor&locations='.Helper::getFooterSettings('third_menu_location'))); ?>">
                                            <?php echo e(trans('lang.view_all')); ?>

                                        </a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-footercol dc-widgetcategories">
                            <div class="dc-fwidgettitle">
                                <h3><?php echo e(html_entity_decode(clean(Helper::getFooterSettings('fourth_menu_title')))); ?></h3>
                            </div>
                            <?php if(!empty(\App\Location::count() > 0 )): ?>
                                <ul class="dc-fwidgetcontent">
                                    <?php $__currentLoopData = \App\Location::limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(url('search-results?search=&locations='.clean($location->slug))); ?>">
                                                <?php echo e(html_entity_decode(clean($location->title))); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dc-viewmore"><a href="<?php echo e(url('search-results')); ?>"><?php echo e(trans('lang.view_all')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('front_end_scripts'); ?>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
        <script type="text/javascript">
            // Services Section Slider
            <?php $loop = !empty(Helper::getServicesSection('services_tabs')) && count(Helper::getServicesSection('services_tabs')) > 5 ? true : false; ?>
            var _dc_doctorslider = jQuery("#dc-doctorslider")
            _dc_doctorslider.owlCarousel({
                loop:<?php echo json_encode($loop); ?>,
                margin:0,
                navSpeed:500,
                nav:false,
                autoplay: false,
                // rtl:true,
                items:5,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:2,
                    },
                    800:{
                        items:3,
                    },
                    1080:{
                        items:4,
                    },
                    1280:{
                        items:5,
                    },
                }
            });
        </script>
        <script>
            /* Our Rated Slider */
            var _dc_docpostslider = jQuery("#dc-docpostslider")
            _dc_docpostslider.owlCarousel({
                loop:false,
                margin:30,
                navSpeed:1000,
                nav:false,
                // rtl:true,
                items:5,
                autoplayHoverPause:true,
                autoplaySpeed:1000,
                autoplay: false,
                mouseDrag:false,
                navClass: ['dc-prev', 'dc-next'],
                navContainerClass: 'dc-docslidernav',
                navText: ['<span class="ti-arrow-left"></span>', '<span class="ti-arrow-right"></span>'],
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    480:{
                        items:2,
                    },
                    800:{
                        items:3,
                    },
                    992:{
                        items:2,
                    },
                    1200:{
                        items:3,
                    },
                    1366:{
                        items:4,
                    },
                    1681:{
                        items:5,
                    }
                }
            });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front-end.master', ['body_class' => 'dc-home dc-userlogin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/index.blade.php ENDPATH**/ ?>