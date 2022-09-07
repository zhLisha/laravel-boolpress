@extends('layouts.dashboard')

@section('page_title')
    Admin | Modifica Post
@endsection

@section('content')

    <h1>Modifica post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')

        {{-- Inserisci titolo --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        @error('title')
            <div class="alert alert-danger">Titolo non inserito</div>
        @enderror

        {{-- Selezione categoria post --}}
        <div class="mb-3">
            <label for="category_id"></label>
            <select class="form-select form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" aria-label="Default select example">\
                <option value="">Nessuna</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category->id) == $category->id ? 'selected' : '' }}> {{ $category->title }} </option>
                @endforeach
            </select>
        </div>

        {{-- Inserisci Contenuto  --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10"> {{ old('content', $post->content) }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">Contenuto non inserito</div>
        @enderror

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
    
@endsection