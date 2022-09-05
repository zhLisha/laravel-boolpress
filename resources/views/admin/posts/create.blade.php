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
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        </div>
        @error('title')
            <div class="alert alert-danger">Titolo non inserito</div>
        @enderror

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10"> {{ old('content') }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">Contenuto non inserito</div>
        @enderror

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
    
@endsection
