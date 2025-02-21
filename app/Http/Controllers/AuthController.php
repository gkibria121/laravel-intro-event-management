<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($validated)) {
            throw   ValidationException::withMessages([
                'email' => ["Invalid credentials"]
            ]);
        }
        $user   =  Auth::user();

        /** @var User $user */
        $user->token =  $user->createToken('login-token')->plainTextToken;
        return new UserResource($user);
    }
    public function logout(Request $request)
    {


        $user = Auth::user();

        /** @var User $user*/
        $currentToken = $user->currentAccessToken();

        /** @var TToken $currentToken*/
        $currentToken->delete();

        return  response()->json([], Response::HTTP_NO_CONTENT);
    }
    public function logoutAll(Request $request)
    {


        $user = Auth::user();

        /** @var User $user*/
        $user->tokens();


        return  response()->json([], Response::HTTP_NO_CONTENT);
    }
}
