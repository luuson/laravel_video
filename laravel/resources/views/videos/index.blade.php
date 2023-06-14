@extends('layouts.app')

@section('content')
    <h1>Videos</h1>

    <a href="{{ route('videos.create') }}" class="btn btn-primary">Create Video</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->description }}</td>
                    <td>
                        @foreach ($video->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-secondary">Edit</a>
                        <!-- Add delete button if desired -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
