<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginNeedsNotification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
        // validate phone no 
        $request->validate([
            'mobile' => 'required|numeric|min:10',
        ]);

        // find or create a user model 
        $user = User::firstOrCreate([
            'mobile' => $request->mobile,
        ]);

        if(!$user){
            return response()->json(['message'=> 'Could not process a user with that mobile number'], 401);
        }

        // send the user a one-time code
        $user->notify(new LoginNeedsNotification());

        // return back response     
        return response()->json(['message'=> 'message send']);
    }

    public function loginVerify(Request $request)
    {
        // validate the incoming request 
        $request->validate([
            'mobile' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999 '
        ]);

        // find the user
        $user = User::where('login_code', $request->login_code)
            ->where('mobile', $request->mobile)
            ->first();

        // verify code requested & saved same ?


        // if yes return auth token
        if($user){
            $user->update(['login_code' => null]);
            return $user->createToken($request->login_code)->plainTextToken;
        }
        // if no return message 
        return response()->json(['message' => 'Invalid verification code']);
    }
}
