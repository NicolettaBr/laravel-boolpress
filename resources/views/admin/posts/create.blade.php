@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Crea un nuovo post</h1>

        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            
            <div class="form-group">
                <label for="content">Titolo</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
            </div>

            <input type="submit" value="Salva il post" class="btn btn-primary">
        </form>

        

    </div>

@endsection