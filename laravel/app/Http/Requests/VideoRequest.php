<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'video_file' => 'required|file|max:100000|mimetypes:video/mp4,video/quicktime', // Example video formats: MP4 and QuickTime
            'title' => 'required|string',
            'description' => 'required|string',
            'tags' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'video_file.required' => 'The video file is required.',
            'video_file.file' => 'Invalid video file.',
            'video_file.max' => 'The video file size must not exceed 100 MB.',
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'tags.array' => 'Invalid tags.',
        ];
    }
}
