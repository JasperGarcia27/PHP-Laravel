

<?php $__env->startSection('content'); ?>

	<?php if(count($posts) > 0): ?>
	
		<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="card text-center">
				<div class="card-body">
					<h4 class="card-title mb-3"><a href="/posts/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h4>
					<h6 class="card-subtitle mb-3">Author: <?php echo e($post->user->name); ?></h6>
					<p class="card-subtitle mb-3 text-muted">Created at: <?php echo e($post->created_at); ?></p>
				</div>

				
				<?php if(Auth::user()): ?>
					
					<?php if(Auth::user()->id == $post->user_id): ?>
						<div class="card-footer">
							<form method="POST" action="/posts/<?php echo e($post->id); ?>">
								<?php echo method_field("DELETE"); ?>
								<?php echo csrf_field(); ?>
								<a href="/posts/<?php echo e($post->id); ?>/edit" class="btn btn-primary">Edit Post</a>
								<button type="submit" class="btn btn-danger">Delete Post</button>
							</form>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php else: ?> 
		<div>
			<h2>There are no posts to show</h2>
			<a href="/posts/create" class="btn btn-info"> Create post</a>
		</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gyanm\Documents\B379\laravel-blog\resources\views/posts/index.blade.php ENDPATH**/ ?>