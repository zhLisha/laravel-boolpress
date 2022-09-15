@extends('layouts.dashboard')

@section('page_title')
    Admin | Modifica Post
@endsection

@section('content')

    <h1>Modifica post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
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

            {{-- Checkbox for Tags --}}
        <div class="tags-form">
            <span>Scegli tags</span>
            {{-- {{dd($post->tags)}} --}}
            @foreach ($tags as $tag)
            {{-- {{dd($tag->id)}} --}}
                <div class="form-check mb-3">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    value="{{ $tag->id }}" 
                    id="tag-{{ $tag->id }}" 
                    name="tags[]" 
                    {{ $post->tags->contains($tag->id) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{$tag->name}}
                    </label>
                </div>
            @endforeach
        </div>

        {{-- File Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Inserisci immagine copertina</label>
            <input class="form-control form-control-lg" id="image" type="file" name="image">
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