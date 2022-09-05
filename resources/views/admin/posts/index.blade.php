@extends('layouts.dashboard')

@section('content')
    <h1>Lista Post</h1>

    <div class="row row-cols-3">
       @foreach ($posts as $post)
            <div class="col mt-4"> 
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
       @endforeach
    </div>

@endsection

<style>
</style>