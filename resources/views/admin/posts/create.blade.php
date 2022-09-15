@extends('layouts.dashboard')

@section('page_title')
    Admin | Crea nuovo post
@endsection

@section('content')

    <h1>Crea un nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Post title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        </div>
        @error('title')
            <div class="alert alert-danger">Titolo non inserito</div>
        @enderror

        {{-- Category select --}}
        <div class="category">
            <span>Scegli una categoria</span>
            <div class="mb-3">
                <label for="category_id"></label>
                <select class="form-select form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" aria-label="Default select example">\
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->title }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        @error('category_id')
            <div class="alert alert-danger">Categoria non trovata, riprova</div>
        @enderror

        {{-- Checkbox for Tags --}}
        <div class="tags-form">
            <span>Scegli tags</span>
            
            @foreach ($tags as $tag)
            {{-- {{dd($tag->id)}} --}}
                <div class="form-check mb-3">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    value="{{ $tag->id }}" 
                    id="tag-{{ $tag->id }}" 
                    name="tags[]" 
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
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

        {{-- Post Content --}}
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
