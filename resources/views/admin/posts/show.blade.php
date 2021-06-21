@extends('layouts.app')

@section('content')

    <div class="container">

        <h2>{{$post->title}}</h2>

        <div><strong>Slug:</strong> {{$post->slug}}</div>

        <p>{{$post->content}}</p>
        
    </div>

@endsection