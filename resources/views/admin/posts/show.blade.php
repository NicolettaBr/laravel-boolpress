@extends('layouts.app')

@section('content')

    <div class="container">
      
        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}" class="btn btn-dark">Modifica il post</a>

        @if($post_category)
         <div>Categoria: {{$post_category->name}}</div>
        @endif

        <h2>{{$post->title}}</h2>

        <div><strong>Slug:</strong> {{$post->slug}}</div>

        <div>
            <strong>Tags:</strong> 
            @foreach($post_tags as $tags)
                {{ $tags->name }} {{ ($loop->last ? '' : ', ') }}
            @endforeach
        </div>

        <p>{{$post->content}}</p>
        
    </div>

@endsection