<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
          return response()->json(Theme::all(), 200);   
        }catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); 
        }
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(['theme_id' => 'required']);
        try {
          $user = User::findOrFail(auth()->user()->id);
          $user->theme_id =  $request->input('theme_id');
          $user->save();
          return response()->json(['theme_id' => $user->theme_id], 200); 
          }catch(\Exception $e) {
              return response()->json(['error' => $e->getMessage()], 400); 
          }
    }

   
}
