@extends('layouts.app')

@section('content')
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
    <h3>Tags:</h3>
    <ul>
        @foreach ($video->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
    <video controls>
        <source src="{{ Storage::url($video->path) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <a href="{{ route('videos.edit', $video->id) }}">Edit</a>
@endsection
