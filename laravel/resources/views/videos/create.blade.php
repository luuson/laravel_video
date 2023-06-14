<!-- resources/views/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Video</h1>

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="path">Video File</label>
            <input type="file" name="video_file" id="video_file" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" class="form-control select2" multiple required>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
