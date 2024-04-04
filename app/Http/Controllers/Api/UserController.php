<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        try {
         return response()->json(new UserResource(auth()->user()), 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|max:25',
            'bio' => 'sometimes|max:80'
        ]);

        try {
          $user->name = $request->input('name');
          $user->bio = $request->input('bio');
          $user->save();
          return response()->json('USER DETAILS UPDATED', 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
