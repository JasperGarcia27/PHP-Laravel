

<?php $__env->startSection('content'); ?>

	<form method="POST" action="/posts">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Title:</label>
			<input type="text" name="title" id="title" class="form-control">
		</div>

		<div class="form-group">
			<label>Content:</label>
			<textarea type="text" name="content" id="content" rows="3" class="form-control" style="resize: none"></textarea>
		</div>

		<div class="mt-2">
			<button type="submit" class="btn btn-primary">Create Post</button>
		</div>

	</form>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gyanm\Documents\B379\laravel-blog\resources\views/posts/create.blade.php ENDPATH**/ ?>