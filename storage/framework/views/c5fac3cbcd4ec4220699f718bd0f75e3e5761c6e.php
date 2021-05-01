<?php $__env->startSection('title'); ?><?php echo e(clean($search_list_meta_title)); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description', clean($search_list_meta_desc)); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.pre-loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo Helper::displayBreadcrumbs('searchResults'); ?>

    <div class="dc-main-section">
        <div class="container" id="user-profile">
            <div class="dc-preloader-section" v-if="loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            <div class="row">
                <div id="dc-twocolumns" class="dc-twocolumns dc-haslayout">
                    <?php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; ?>
                    <?php if($display_sidebar == 'true'): ?>
                        <?php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9'; ?>
                    <?php endif; ?>
                    <div class="<?php echo e($columns); ?> float-left">
                        <div class="dc-searchresult-holder">
                            <div class="dc-searchresult-head">
                                <div class="dc-title"><h4><?php echo e(clean($total_records)); ?> <?php echo e(trans('lang.matches_found')); ?> </h4></div>
                                <div class="dc-rightarea">
                                    <div class="dc-select">
                                        <select data-placeholder="<?php echo e(trans('lang.sort_by')); ?>" name="sort_by" v-model="sort_by" v-on:change="resultSortBy('sort_by', sort_by)">
                                            <option value="null"><?php echo e(trans('lang.sort_by')); ?></option>
                                            <option value="id"><?php echo e(trans('lang.id')); ?></option>
                                            <option value="name"><?php echo e(trans('lang.name')); ?></option>
                                            <option value="date"><?php echo e(trans('lang.date')); ?></option>
                                        </select>
                                    </div>
                                    <div class="dc-select">
                                        <select name="order" class="order" v-model="order" v-on:change="resultSortBy('order_by', order)">
                                            <option value="asc"><?php echo e(trans('lang.ascending')); ?></option>
                                            <option value="desc"><?php echo e(trans('lang.descending')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="dc-searchresult-grid dc-searchresult-list dc-searchvlistvtwo la-searchvlistvtwo">
                                <?php if(!empty($users) && $users->count() > 0): ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $user_obj = App\User::find($user->id); 
                                            $avg_rating = \App\Feedback::where('user_id', $user_obj->id)->pluck('avg_rating')->first();
                                            $stars  = $avg_rating != 0 ? $avg_rating/5*100 : 0;
                                            $specialities = $user_obj->services->count() > 0 ? DB::table('user_service')->select('speciality')
                                                        ->where('user_id', $user_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray() : '';
                                            $day_list = Helper::getAppointmentDays();
                                            $current_package = Helper::getCurrentPackage($user_obj);
                                            $featured = !empty($current_package) && !empty($current_package['featured']) ? $current_package['featured'] : 'false';
                                        ?>
                                        <div class="dc-docpostholder">
                                            <div class="dc-docpostcontent">
                                                <div class="dc-searchvtwo">
                                                    <figure class="dc-docpostimg">
                                                        <img src="<?php echo e(asset(Helper::getImage('uploads/users/'.$user_obj->id, $user_obj->profile->avatar, 'small-', 'user.jpg'))); ?>" alt="<?php echo e(trans('lang.img_desc')); ?>">
                                                        <?php if($featured == 'true'): ?>
                                                            <figcaption>
                                                                <span class="dc-featuredtag"><i class="fa fa-bolt"></i></span>
                                                            </figcaption>
                                                        <?php endif; ?>
                                                    </figure>
                                                    <div class="dc-title">
                                                        <?php if(!empty($specialities)): ?>
                                                            <?php $__currentLoopData = $specialities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user_speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $speciality = Helper::getSpecialityByID($user_speciality); ?>
                                                                <?php if(!empty($speciality)): ?>
                                                                    <a href="<?php echo e(url('/search-results?speciality='.clean($speciality->slug))); ?>" class="dc-docstatus"><?php echo e(html_entity_decode(clean($speciality->title))); ?></a>  
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        <h3>
                                                            <a href="<?php echo e(route('userProfile', ['slug' => clean($user_obj->slug)])); ?>">
                                                                <?php echo e(!empty($user_obj->profile->gender_title) ? Helper::getDoctorArray(html_entity_decode(clean($user_obj->profile->gender_title))) : ''); ?>

                                                                <?php echo e(Helper::getUsername($user->id)); ?> 
                                                            </a>
                                                            <?php echo e(Helper::verifyUser(clean($user_obj->id))); ?> <?php echo e(Helper::verifyMedical(clean($user_obj->id))); ?>

                                                        </h3>
                                                        <ul class="dc-docinfo">
                                                            <li><em><?php echo e(html_entity_decode(clean($user_obj->profile->sub_heading))); ?></em></li>
                                                            <?php if(Helper::getRoleTypeByUserID($user_obj->id) == 'doctor'): ?>
                                                                <li>
                                                                    <span class="dc-stars">
                                                                        <span style="width: <?php echo e(clean($stars)); ?>%;"></span>
                                                                    </span>
                                                                    <em><?php echo e(html_entity_decode(clean($user_obj->feedbacks->count()))); ?> <?php echo e(trans('lang.feedbacks')); ?></em>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                    <?php if(!empty($user_obj->services)): ?>
                                                        <div class="dc-tags">
                                                            <ul>
                                                                <?php $__currentLoopData = $user_obj->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($key <= 4): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0);"><?php echo e(html_entity_decode(clean($service->title))); ?></a>
                                                                        </li> 
                                                                    <?php else: ?>
                                                                        <li style="display:none">
                                                                            <a href="javascript:void(0);"><?php echo e(html_entity_decode(clean($service->title))); ?></a>
                                                                        </li>    
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($user_obj->services->count() >= 6): ?>
                                                                    <li class="dc-viewall-services">
                                                                        <a href="javascript:;" id="view-service-<?php echo e(clean($user_obj->id)); ?>" class="dc-tagviewall" v-on:click="displayServices('view-service-<?php echo e(clean($user_obj->id)); ?>')"><?php echo e(trans('lang.view_all')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="dc-doclocation dc-doclocationvtwo">
                                                    <?php if(!empty($user_obj->location->title)): ?>
                                                        <span><i class="ti-direction-alt"></i> <?php echo e(html_entity_decode(clean($user_obj->location->title)) ?? ''); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($user_obj->profile->available_days) && !empty($day_list)): ?>
                                                        <?php $last_day = end($day_list); ?>
                                                        <span>
                                                            <i class="ti-calendar"></i>
                                                            <?php $__currentLoopData = $day_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!in_array($key, unserialize($user_obj->profile->available_days))): ?>
                                                                    <em class="dc-dayon"><?php echo e(html_entity_decode(clean($day['title']))); ?></em> 
                                                                    <?php if($day['title'] != $last_day['title']): ?>, <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php echo e(html_entity_decode(clean($day['title']))); ?><?php if($day['title'] != $last_day['title']): ?>, <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if(Helper::getRoleTypeByUserID($user_obj->id) == 'doctor'): ?>
                                                        <span><i class="ti-thumb-up"></i> <?php echo e(empty($user_obj->profile->votes) ? 0 : clean($user_obj->profile->votes)); ?> <?php echo e(trans('lang.votes')); ?></span>
                                                        <span><i class="ti-wallet"></i> <?php echo e(trans('lang.starting_from')); ?> <?php echo e(!empty($symbol['symbol']) ? html_entity_decode(clean($symbol['symbol'])) : '$'); ?><?php echo e(!empty($user_obj->profile->starting_price) ? html_entity_decode(clean($user_obj->profile->starting_price)) : 0); ?></span>
                                                    <?php elseif(Helper::getRoleTypeByUserID($user_obj->id) == 'hospital'): ?>
                                                        <span><i class="ti-thumb-up"></i><?php echo e(trans('lang.doctors_onboard')); ?>: <?php echo e(clean($user_obj->approvedTeams()->count())); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($user_obj->profile->available_days)): ?>
                                                        <span>
                                                            <i class="ti-clipboard"></i>
                                                            <em class="dc-available">
                                                                <?php if(!empty($user_obj->profile->working_time) && $type == 'hospital'): ?>
                                                                   <?php echo e($user_obj->profile->working_time == '24_hours' ? trans('lang.24_hours') : html_entity_decode(clean($user_obj->profile->working_time))); ?>

                                                                <?php else: ?> 
                                                                   <?php echo e(in_array(strtolower(Carbon\Carbon::now()->format('D')), unserialize($user_obj->profile->available_days))
                                                                    ? trans('lang.available_today') : trans('lang.not_available_today')); ?>

                                                                <?php endif; ?>
                                                            </em>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php
                                                        $column = !empty($user_obj->id) && Helper::getRoleTypeByUserID($user_obj->id) == 'doctor' ? 'saved_doctors' : 'saved_hospitals'; 
                                                        $saved_user = Auth::check() && !empty(Auth::user()->profile->$column) ? unserialize(Auth::user()->profile->$column) : array();
                                                    ?> 
                                                    <div class="dc-btnarea">
                                                        <a href="<?php echo e(url('profile/'.clean($user_obj->slug))); ?>" class="dc-btn"><?php echo e(trans('lang.view_more')); ?></a>
                                                        <?php if(!empty($saved_user) && in_array($user_obj->id, $saved_user)): ?>
                                                            <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="javascrip:void(0);" class="dc-like" id="doctor-<?php echo e(clean($user_obj->id)); ?>" @click.prevent="add_wishlist('doctor-<?php echo e(clean($user_obj->id)); ?>', '<?php echo e(clean($user_obj->id)); ?>', '<?php echo e($column); ?>', '')" v-cloak>
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if( method_exists($users,'links') ): ?>
                                        <div class="dc-pagination">
                                            <?php echo e($users->links()); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($display_sidebar == 'true'): ?>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 float-left">
                            <?php echo $__env->make('front-end.sidebar.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/search-results/index.blade.php ENDPATH**/ ?>