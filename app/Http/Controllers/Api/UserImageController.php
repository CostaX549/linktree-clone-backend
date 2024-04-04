<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;

class UserImageController extends Controller
{
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate(['image' => 'required|mimes:png,jpg,jpeg,webp']);
       try {
        $user =  User::findOrFail(auth()->user()->id);
        $user  = (new FileService)->updateImage($user, $request);
        $user->save();
        return response()->json('USER IMAGE UPDATED', 200);
       } catch(\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
       }
    }

   
}
