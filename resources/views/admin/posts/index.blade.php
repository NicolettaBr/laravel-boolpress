@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Modifica i tuoi post</h1>

        <div class="row">
        
            @foreach($posts as $post)
             <div class=col-4>
                <div class="card" >
        
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Modifica il post</a>
                        <a href="{{ route('admin.posts.create')}}" class="btn btn-primary">Crea un post</a>
                    </div>

                </div>
             
             </div>
            @endforeach
        </div>

    </div>

@endsection