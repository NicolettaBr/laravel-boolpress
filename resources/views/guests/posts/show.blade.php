@extends('layouts.app')

@section('content')

    <div class="container">

        @if($post_category)
        <div>Categoria: {{'post_category'->name}}</div>
        @endif
        
        <h2>{{$post->title}}</h2>

        <p>{{$post->content}}</p>
        
    </div>

@endsection