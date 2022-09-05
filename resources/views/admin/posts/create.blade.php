@extends('layouts.dashboard')

@section('page_title')
    Admin | Crea nuovo post
@endsection

@section('content')

    <h1>Crea un nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea name="content" id="content" class="form-control" rows="10"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
    
@endsection
