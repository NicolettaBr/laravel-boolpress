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

                        <a href="{{route('admin.posts.show', ['post'=>$post->id])}}" class="btn btn-primary">Vai al post</a>

                        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}" class="btn btn-dark">Modifica il post</a>

                        <a href="{{ route('admin.posts.create')}}" class="btn btn-success">Crea un post</a>

                        <form action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            
                            <input type="submit" class="btn btn-danger" value="Elimina il post">
                        </form>
                       
                    </div>

                </div>
             
             </div>
            @endforeach
        </div>

    </div>

@endsection