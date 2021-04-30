@extends('layout')


@section('content')
    
    @foreach ($posts as $post )
     
    <article>
        <h1><a href="/posts/{{$post->slog }}">{{ $post->title}}</a></h1>
        <div>{{ $post->excerpt}}</div>
    </article>
@endforeach

@endsection

