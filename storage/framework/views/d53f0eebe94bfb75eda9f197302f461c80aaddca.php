<?php 
    $locations = App\Location::all(); 
    $roles     = Spatie\Permission\Models\Role::all()->toArray();
?>
<div class="dc-innerbanner-holder dc-haslayout" id="dc_search_bar">
    <?php echo Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => '']); ?>

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dc-innerbanner">
                        <div class="dc-formtheme dc-form-advancedsearch dc-innerbannerform">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="search" value="<?php echo e(!empty(request()->search) ? request()->search : ''); ?>" class="form-control" 
                                        placeholder="<?php echo e(trans('lang.ph.hospitals_clinic_etc')); ?>">
                                </div>
                                <div class="form-group">
                                    <div class="dc-select">
                                        <select class="locations" data-placeholder="<?php echo e(trans('lang.select_country')); ?>" name="locations">
                                            <option value=""><?php echo e(trans('lang.select_country')); ?></option>
                                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(clean($location->slug)); ?>"><?php echo e(html_entity_decode(clean($location->title))); ?>*</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="dc-btnarea">
                                    <?php echo Form::submit(trans('lang.search'), ['class' => 'dc-btn']); ?>

                                </div>
                            </fieldset>
                        </div>
                        <a href="javascript:void(0);" class="dc-docsearch" v-on:click="displayFilfer">
                            <span class="dc-advanceicon"><i></i> <i></i> <i></i></span>
                            <span><?php echo e(trans('lang.advanced')); ?> <br><?php echo e(trans('lang.search')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dc-advancedsearch-holder">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="dc-advancedsearchs">
                            <div class="dc-formtheme dc-form-advancedsearchs">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="dc-select">
                                            <select name="type">
                                                <?php if(!empty($roles)): ?>
                                                    <option value="both" selected><?php echo e(trans('lang.both')); ?></option>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!in_array($role['role_type'] == 'admin', $roles) && !in_array($role['role_type'] == 'regular', $roles)): ?>
                                                            <?php $selected = !empty($_GET['type']) && $_GET['type'] == $role['role_type'] ? 'selected' : ''; ?>
                                                            <option value="<?php echo e($role['role_type']); ?>" <?php echo e($selected); ?>><?php echo e(html_entity_decode(clean($role['name']))); ?></option>
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
                                    <div class="dc-btnarea">
                                        <a href="javascript:void(0);" class="dc-btn dc-resetbtn"><?php echo e(trans('lang.reset_filters')); ?></a>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo form::close();; ?>

</div>
<?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/includes/inner-banner.blade.php ENDPATH**/ ?>