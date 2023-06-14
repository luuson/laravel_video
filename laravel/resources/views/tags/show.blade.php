@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tag Details</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $tag->name }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
