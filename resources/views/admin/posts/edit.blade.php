@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Modifica il post: {{$post->title}}</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
            </div>
            
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{old('content', $post->content)}}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id" class="form-control" >
                    <option value="">Nessuna</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="check-container">

                <h6>Tags:</h6>

                {{-- for e id hanno bisogno di un valore univoco, perciò diamo l' id --}}
                {{-- name non avendo colonna prende il nome "tags[]"" =array perchè potenzialmente può avere molti elementi --}}
                {{-- per checkare di default =checked {{ $post->tags->contains($tag->id) ? 'checked' : ''}} --}}

                @foreach($tags as $tag)
                    <div class="form-check">
                        <input name="tags[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{ $post->tags->contains($tag->id) ? 'checked' : ''}} >
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach

            </div>

            <input type="submit" value="Salva le modifiche" class="btn btn-primary">

        </form>

        

    </div>

@endsection