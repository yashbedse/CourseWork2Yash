<?php 
    $user_name = '';
    $number_of_tweets = '';
    if (Schema::hasTable('site_management')) {
        $tweeter = App\SiteManagement::getMetaValue('footer_settings');
        $user_name = !empty($tweeter) && !empty($tweeter['twitter_user_name']) ? $tweeter['twitter_user_name'] : '';
        $number_of_tweets = !empty($tweeter) && !empty($tweeter['number_of_tweets']) ? $tweeter['number_of_tweets'] : '';
    }
    try
    {
        $data = Helper::twitterUserTimeLine($user_name, $number_of_tweets); 
    }
    catch (Exception $e)
    {
        $twitter_error = Twitter::logs();
    }
?>
<?php if(!empty($data)): ?>
    <ul class="dc-livefeeddetails">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $text = !empty( $value['full_text'] ) ? $value['full_text'] : '';
                $text = substr( $text, 0, 75 );
                if (!empty($value['entities'])) {
                    foreach ( $value['entities'] as $type => $entity ) {
                        if ( $type == 'hashtags' ) {
                            foreach ( $entity as $j => $hashtag ) {
                                $update_with_link = '<a href="https://twitter.com/search?q=%23' . $hashtag->text . '&amp;src=hash" target="_blank" title="' . $hashtag->text . '">#' . $hashtag->text . '</a>';
                                $update_with = !empty( $hashtag->text ) ? $hashtag->text : '';
                                $text = str_replace( '#' . $hashtag->text, $update_with, $text );
                            }

                        }
                    }
                }
            ?>
            <li>
                <?php if(!empty($value['extended_entities']['media'])): ?>
                    <?php $__currentLoopData = $value['extended_entities']['media']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <figure class="dc-latestadimg">
                            <img src="<?php echo e($v['media_url_https']); ?>:thumb" width="40">
                        </figure>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="dc-latestadcontent">
                    <p><?php echo e($text); ?></p>
                    <time datetime=<?php echo e(date( 'Y-m-d', strtotime( $value['created_at'] ) )); ?>>
                        <?php echo e(date( 'H:i A - m D, Y', strtotime( $value['created_at'] ) )); ?>

                    </time>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php else: ?>
    <p class="twitter-error"><?php echo e(trans('lang.no_tweet')); ?></p>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\3\resources\views/front-end/includes/twitter.blade.php ENDPATH**/ ?>