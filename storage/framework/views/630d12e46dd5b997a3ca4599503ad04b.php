
<?php $__env->startSection('content'); ?>
	<div class="card mb-5">
		<div class="card-body">
			<h2 class="card-title"><?php echo e($post->title); ?></h2>
			<p class="card-subtitle text-muted">Author: <?php echo e($post->user->name); ?></p>
			<p class="card-subtitle text-muted mb-3">Created at: <?php echo e($post->created_at); ?></p>
			<p class="card-text"><?php echo e($post->content); ?></p>


			<?php if(Auth::id() != $post->user_id): ?>
				<form class="d-line" method="POST" action="/posts/<?php echo e($post->id); ?>/like">
					<?php echo method_field('PUT'); ?>
					<?php echo csrf_field(); ?>

					<?php if($post->likes->contains("user_id", Auth::id())): ?>
						<button type="submit" class="btn btn-danger">Unlike</button>
					<?php else: ?>
						<button type="submit" class="btn btn-success">Like</button>
					<?php endif; ?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Comment</button>
				</form>
			<?php else: ?> 
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Comment</button>
			<?php endif; ?>

			<form class="d-line" method="POST" action="/posts/<?php echo e($post->id); ?>/comment">
				<?php echo csrf_field(); ?>
				<!-- Modal -->
				<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="commentModalLabel">Leave a comment</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Content:</label>
									<textarea type="text" name="comment" id="comment" rows="3" class="form-control" style="resize: none"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Comment</button>
							</div>
						</div>
					</div>
				</div>
			</form>

			<div>
				<a href="/posts">View all posts</a>
			</div>
		</div>
	</div>
	<div>
		<h4>Comments:</h4>
		<?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postComment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="card mb-1">
				<div class="card-body">
					<h4 class="card-title d-flex justify-content-center"><?php echo e($postComment->content); ?></h4>
					<h5 class="card-title d-flex justify-content-end">Posted by: <?php echo e($postComment->user->name); ?></h5>
					<p class="card-text text-muted d-flex justify-content-end">posted on: <?php echo e($postComment->created_at); ?></p>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gyanm\Documents\B379\laravel-blog\resources\views/posts/show.blade.php ENDPATH**/ ?>