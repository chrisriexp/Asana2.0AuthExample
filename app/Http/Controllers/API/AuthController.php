<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        //Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->save();

        $success['token'] = $user->createToken('token')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Registered Successfully.' 
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('token')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User Registered Successfully.' 
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Incorrect Email or Password.'
            ];

            return response()->json($response, 401);
        }
    }

    public function tokenValidate(Request $request){
        $id = $request->user()->id;

        $tokenExists = DB::table('personal_access_tokens')->where('tokenable_id', $id)->exists();

        if ($tokenExists) {
            $response = [
                'valid' => true,
                'message' => 'Token authenticated successfully.',
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'valid' => false,
                'message' => 'Token is invalid.'
            ];

            return response()->json($response, 401);
        }
    }
}
