<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\PhotoResource;
use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => PhotoResource::collection(Photo::all())
        ]);
    }
    public  function imagesByAlbum(string $album){
        $user = Auth::user();
        $images = PhotoResource::collection(Photo::all()->where('album_id',$album));
        return response()->json([
            'status' => true,
            'data' => $images,
        ]);
    }
    public function images()
    {
        $user = Auth::user();
        $albumIds = Album::all()->where('user_id', $user->id)->pluck('id');
        $images = PhotoResource::collection(Photo::all());
        $matchingResources = $images->whereIn('album_id', $albumIds->toArray());
        return response()->json([
            'status' => true,
            'data' => $matchingResources,
        ]);

    }

    public function store(PhotoRequest $request)
    {
        try {
            $photoPath = $request->file('path')->store($request->folder, 'public');
            $album = $request->album_id ?? Album::where('user_id', Auth::id())
            ->where('title', 'Общий альбом')
            ->first()->id;
            $photo = Photo::create([
                    'path' => $photoPath,
                    'album_id' => $album
                ] + $request->all());
            return response()->json([
                'status' => true,
                'data' => $photo,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(Photo $photo)
    {
        $findPhoto = new PhotoResource($photo);
        return response()->json([
            'status' => true,
            'data' => $findPhoto
        ]);
    }

    public function update(Photo $photo, PhotoRequest $request)
    {
        $photo->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Photo successfully updated',
            'data' => $photo
        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return response()->json([
            'status' => true,
            'message' => 'Photo successfully deleted'
        ]);
    }
}
