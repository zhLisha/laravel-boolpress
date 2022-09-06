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

    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger mt-4"  onclick="return confirm('Sicuro di voler cancellare il post? ')">Elimina post</button>
    </form>
@endsection