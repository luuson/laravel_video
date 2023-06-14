<?php

namespace App\Http\Controllers;

use App\Models\Tag as Tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // Retrieve all tags
        $tags = Tags::all();

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
        $tag = Tags::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Record created successfully.');


        // Redirect to the index page or show success message
    }

    public function edit(VideoTag $tag)
    {
        // Return the view to edit the specified tag
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tags $tag)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the tag
        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success', 'Record updated successfully.');

    }

    public function destroy(VideoTag $tag)
    {
        // Delete the tag
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Record deleted successfully.');

        // Redirect to the index page or show success message
    }
}
