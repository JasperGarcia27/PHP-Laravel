@extends('layouts.app')

@section('content')

	@if(count($posts) > 0)
	
		@foreach($posts as $post)
			<div class="card text-center">
				<div class="card-body">
					<h4 class="card-title mb-3"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
					<h6 class="card-subtitle mb-3">Author: {{$post->user->name}}</h6>
					<p class="card-subtitle mb-3 text-muted">Created at: {{$post->created_at}}</p>
				</div>

				{{-- checks if there isan authenticated user --}}
				@if(Auth::user())
					{{-- checks if the authenticateed user is tha author of the blog post --}}
					@if(Auth::user()->id == $post->user_id)
						<div class="card-footer">
							<form method="POST" action="/posts/{{$post->id}}">
								@method("DELETE")
								@csrf
								<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit Post</a>
								<button type="submit" class="btn btn-danger">Delete Post</button>
							</form>
						</div>
					@endif
				@endif
			</div>
		@endforeach

	@else 
		<div>
			<h2>There are no posts to show</h2>
			<a href="/posts/create" class="btn btn-info"> Create post</a>
		</div>
	@endif
@endsection