<?php

namespace App\Http\Controllers;

use App\Models\Tag as VideoTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // Retrieve all tags
        $tags = VideoTag::all();

        // Return the view with the tags
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        // Return the view to create a new tag
        return view('tags.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new tag
        $tag = VideoTag::create($request->all());

        // Redirect to the index page or show success message
    }

    public function edit(VideoTag $tag)
    {
        // Return the view to edit the specified tag
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, VideoTag $tag)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the tag
        $tag->update($request->all());

        // Redirect to the index page or show success message
    }

    public function destroy(VideoTag $tag)
    {
        // Delete the tag
        $tag->delete();

        // Redirect to the index page or show success message
    }
}
