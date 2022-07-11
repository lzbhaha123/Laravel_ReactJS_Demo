@extends('main')

@section('content')

<br/>
<div>
    <h3>{{$post->title}}</h3>
    <br/>
    <div class="post_content">
        {!! $post->content !!}
        
        <div>
            <a href="/" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>
    
@endsection