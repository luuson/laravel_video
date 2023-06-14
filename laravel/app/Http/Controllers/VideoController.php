<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Video;
use App\Models\VideoTag;
use App\Http\Requests\VideoRequest;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all videos from the database
        $videos = Video::all();

        // Pass the videos to the view
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('videos.create', compact('tags'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {

        // Handle and save the video
        $this->handleVideo($request);

        // Redirect to a success page or do other actions
        return redirect()->route('videos.create')->with('success', 'Video uploaded successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::with('tags')->findOrFail($id);
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $tags = Tag::all();

        return view('videos.edit', compact('video', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        $video = Video::findOrFail($id);

        // Handle and update the video file if a new file is provided
        if ($request->hasFile('video_file')) {
            $this->handleEditVideo($request, $video);
        }

        // Update other video details
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->save();

        // Sync the video tags
        $video->tags()->sync($request->input('tags', []));

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function handleVideo( $request)
    {
        // Get the uploaded video file
        $videoFile = $request->file('video_file');

        // Generate a unique file name
        $fileName = uniqid('video_') . '.' . $videoFile->getClientOriginalExtension();

        // Store the video file in the local storage
        $videoPath = $videoFile->storeAs('videos', $fileName);

        // Create a new Video instance
        $video = new Video();
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->path = $videoPath;
        // Set other properties as needed
        $video->save();

        // Check if tags are provided
        if ($request->has('tags') && is_array($request->input('tags'))) {
            $tags = $request->input('tags');
            foreach ($tags as $tagId) {
                $videoTag = new VideoTag();
                $videoTag->video_id = $video->id;
                $videoTag->tag_id = $tagId;
                $videoTag->save();
            }
        }
    }


    private function handleEditVideo(VideoRequest $request, Video $video)
    {
        // Get the uploaded video file
        $videoFile = $request->file('video_file');

        // Generate a unique file name
        $fileName = uniqid('video_') . '.' . $videoFile->getClientOriginalExtension();

        // Store the video file in the local storage
        $videoPath = $videoFile->storeAs('videos', $fileName);

        // Delete the previous video file
        Storage::delete($video->path);

        // Update the video path
        $video->path = $videoPath;

        // Save the changes
        $video->save();
    }


}
