<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index(){
        $user_albums = Album::all()->where('user_id',Auth::id());
        return [
            'status' => true,
            'data' => AlbumResource::collection($user_albums)
        ];
    }
    public function store(AlbumRequest $request){
        try {
            $user = Auth::id();
            $album = Album::create([
                'user_id' => $user,
                'title' => $request->title ?? 'Новый альбом'
            ]);
            return response()->json([
                'status' => true,
                'album' => $album
            ]);
        }catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],400);
        }
    }
    public function show(Album $album){
        $findAlbum = new AlbumResource($album);
        return response()->json([
            'status' => true,
            'data' => $findAlbum
        ]);
    }
    public function update(Album $album, AlbumRequest $request)
    {
        $album->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'album successfully updated',
            'data'=>$album
        ]);
    }
    public function destroy(Album $album)
    {
        $album->delete();
        return response()->json([
            'status' => true,
            'message' => 'album successfully deleted'
        ]);
    }
}
