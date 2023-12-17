@extends('layouts.app')

@section('content')
	<form method="POST" action="/updatePosts/{{$post->id}}">
		@csrf
		@method("PUT")

		<div class="form-group">
			<label>Title:</label>
			<input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control">
		</div>

		<div class="form-group">
			<label>Content:</label>
			<textarea type="text" name="content" id="content" rows="3" class="form-control" style="resize: none">{{ $post->content }}</textarea>
		</div>

		<div class="mt-2">
			<button type="submit" class="btn btn-primary">Update Post</button>
		</div>

	</form>
@endsection

