@extends('layouts.app')
@section('content')
	<div class="card mb-5">
		<div class="card-body">
			<h2 class="card-title">{{$post->title}}</h2>
			<p class="card-subtitle text-muted">Author: {{$post->user->name}}</p>
			<p class="card-subtitle text-muted mb-3">Created at: {{$post->created_at}}</p>
			<p class="card-text">{{$post->content}}</p>


			@if(Auth::id() != $post->user_id)
				<form class="d-line" method="POST" action="/posts/{{$post->id}}/like">
					@method('PUT')
					@csrf

					@if($post->likes->contains("user_id", Auth::id()))
						<button type="submit" class="btn btn-danger">Unlike</button>
					@else
						<button type="submit" class="btn btn-success">Like</button>
					@endif
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Comment</button>
				</form>
			@else 
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Comment</button>
			@endif

			<form class="d-line" method="POST" action="/posts/{{$post->id}}/comment">
				@csrf
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
		@foreach($post->comments as $postComment)
			<div class="card mb-1">
				<div class="card-body">
					<h4 class="card-title d-flex justify-content-center">{{$postComment->content}}</h4>
					<h5 class="card-title d-flex justify-content-end">Posted by: {{$postComment->user->name}}</h5>
					<p class="card-text text-muted d-flex justify-content-end">posted on: {{$postComment->created_at}}</p>
				</div>
			</div>
		@endforeach
	</div>
@endsection