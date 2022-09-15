@extends('layouts.dashboard')

@section('page_title')
    Admin | Dettagli Post
@endsection


@section('content')
    <h1> {{ $post->title }} </h1>

    {{-- Created at --}}
    <div class="created-at mt-3">
        <span>Creato il: {{ $post->created_at->translatedFormat('j F Y') }}</span>
    </div>

    {{-- Updated at --}}
    <div class="updated-at">
        <span>Aggiornato il: {{ $post->updated_at->translatedFormat('j F Y') }}</span>
    </div>

    {{-- Slug --}}
    <div class="slug">
        <span>SLUG: {{ $post->slug }}</span>
    </div>

    {{-- Category --}}
    <div class="category">
        @if($post->category)
            <span>Categoria: {{ $post->category->title  }}</span>
        @else 
            <span>Categoria: Nessuna</span>
        @endif
    </div>

    {{-- Tags --}}
    <div class="tags">
        @if ($post->tags->isNotEmpty()) 
            <span>Tags: </span>
            @foreach ($post->tags as $tag)
                <span> {{ $tag->name }} {{!$loop->last ? ',' : ''}}</span>
            @endforeach
        @else
            <span>Categoria: Nessuna</span>
        @endif

    </div>

    {{-- Image --}}
    @if ($post->cover)
        <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
    @endif

    {{-- Content --}}
    <div class="content mt-5">
        <h2>Contenuto</h2>
        <span> {{ $post->content }}</span>
    </div>

    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger mt-4"  onclick="return confirm('Sicuro di voler cancellare il post? ')">Elimina post</button>
    </form>
@endsection