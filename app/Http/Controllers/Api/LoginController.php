<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentBaby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login(Request $request)
    {

        $parent= ParentBaby::where('id',$request->id)->where('name',$request->name)->First();
        if ($parent != null) {

            return $parent->createToken('token-name', ['server:update'])->plainTextToken;
        }else
        {
           return response()->json(['message'=>'Wrong in id or name' ],404);
        }
    }




/**
 * Get the guard to be used during authentication.
 *
 * @return \Illuminate\Contracts\Auth\Guard
 */
        public function guard()
        {
            return Auth::guard();
        }
}
