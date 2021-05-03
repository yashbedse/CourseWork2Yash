<ul class="navbar-nav">
    <li class="nav-item">
        <a href="<?php echo e(route('forumQuestions')); ?>"><?php echo e(trans('lang.health_forum')); ?></a>
    </li>
    <li class="menu-item-has-children page_item_has_children">
        <a href="javascript:void(0);"><?php echo e(trans('lang.search_results')); ?></a>
        <ul class="sub-menu menu-item-moved">
            <li>
                <a href="<?php echo e(url('search-results?type=doctor')); ?>"><?php echo e(trans('lang.search_doctors')); ?></a>
            </li>
            <li>
                <a href="<?php echo e(url('search-results?type=hospital')); ?>"><?php echo e(trans('lang.search_hospitals')); ?></a>
            </li>
        </ul>
    </li>
    <li class="menu-item-has-children page_item_has_children">
        <a href="javascript:void(0);"><?php echo e(trans('lang.pages')); ?></a>
        <ul class="sub-menu">
            <li class="nav-item">
                <a href="<?php echo e(route('articleListing')); ?>"><?php echo e(trans('lang.articles')); ?></a>
            </li>
            <?php if(Schema::hasTable('pages')): ?>
                <?php $pages = App\Page::all(); ?>
                <?php if(!empty($pages) && $pages->count() > 0): ?>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $page_has_child = App\Page::pageHasChild($page->id); 
                            $pageID = Request::segment(2);
                            $meta = !empty($page->meta) ? Helper::getUnserializeData($page->meta) : '';
                            $has_parent = App\Page::pageHasParent($page->id);
                        ?>
                        <?php if(!empty($meta['show_page']) && $meta['show_page'] == 'true' && $has_parent == 0): ?>
                            <?php if(!empty($page_has_child)): ?>
                                <li class="menu-item-has-children page_item_has_children dc-notificationicon">
                            <?php else: ?>
                                <li>    
                            <?php endif; ?>
                                <a href="<?php echo e(url('page/'.$page->slug)); ?>"><?php echo e(html_entity_decode(clean($page->title))); ?></a>
                                <ul class="sub-menu">
                                    <?php $__currentLoopData = $page_has_child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $child = App\Page::getChildPages($parent->child_id);?>
                                        <li><a href="<?php echo e(url('page/'.$child->slug.'/')); ?>"><?php echo e(html_entity_decode(clean($child->title))); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        
    </li>
</ul><?php /**PATH C:\xampp\htdocs\3\resources\views/includes/navigation.blade.php ENDPATH**/ ?>