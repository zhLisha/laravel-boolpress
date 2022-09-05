@extends('layouts.dashboard')

@section('page_title')
    Admin | Dettagli Post
@endsection


@section('content')
    <h1> {{ $post->title }} </h1>

    <div class="created-at mt-3">
        <span>Creato il: {{ $post->created_at }}</span>
    </div>

    <div class="updated-at">
        <span>Aggiornato il: {{ $post->updated_at }}</span>
    </div>

    <div class="slug">
        <span>SLUG: {{ $post->slug }}</span>
    </div>

    <div class="content mt-5">
        <h2>Contenuto</h2>
        <span> {{ $post->content }}</span>
    </div>
@endsection