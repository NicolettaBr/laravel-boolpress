@extends('layouts.app')

@section('content')

    <div class="container">

        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}" class="btn btn-dark">Modifica il post</a>

        <h2>{{$post->title}}</h2>

        <div><strong>Slug:</strong> {{$post->slug}}</div>

        <p>{{$post->content}}</p>
        
    </div>

@endsection