<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\MediaResource;
use App\Models\Album;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => MediaResource::collection(Media::all())
        ]);
    }
    public  function mediaByAlbum(string $album){
        $user = Auth::user();
        $media = MediaResource::collection(Media::all()->where('album_id',$album));
        return response()->json([
            'status' => true,
            'data' => $media,
        ]);
    }
    public function media()
    {
        $user = Auth::user();
        $albumIds = Album::all()->where('user_id', $user->id)->pluck('id');
        $media = MediaResource::collection(Media::all());
        $matchingResources = $media->whereIn('album_id', $albumIds->toArray());
        return response()->json([
            'status' => true,
            'data' => $matchingResources,
        ]);

    }

    public function store(MediaRequest $request)
    {
        try {
            $mediaPath = $request->file('path')->store($request->folder, 'public');
            $album = $request->album_id ?? Album::where('user_id', Auth::id())
            ->where('title', 'Общий альбом')
            ->first()->id;
            $media = Media::create([
                    'path' => $mediaPath,
                    'album_id' => $album
                ] + $request->all());
            return response()->json([
                'status' => true,
                'data' => $media,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(Media $media)
    {
        $findmedia = new MediaResource($media);
        return response()->json([
            'status' => true,
            'data' => $findmedia
        ]);
    }

    public function update(Media $media, MediaRequest $request)
    {
        $media->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Media successfully updated',
            'data' => $media
        ]);
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json([
            'status' => true,
            'message' => 'Media successfully deleted'
        ]);
    }
}
