<?php $__env->startSection('content'); ?>
    <div class="text-center">
        <img class="w-75" src="https://cdn.freebiesupply.com/logos/large/2x/laravel-1-logo-png-transparent.png">
        <h2 class="my-4">Featured Posts:</h2>
        <?php if(count($posts) > 0): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card text-center mb-3">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><a href="/posts/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h4>
                        <h5 class="card-text mb-3">Author: <?php echo e($post->user->name); ?></h5>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div>
                <h2>There are no posts to show</h2>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gyanm\Documents\B379\laravel-blog\resources\views/welcome.blade.php ENDPATH**/ ?>