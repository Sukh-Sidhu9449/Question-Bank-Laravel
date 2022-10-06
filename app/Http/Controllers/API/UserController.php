<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){
        //validater
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cPassword' => 'required | same:password'
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,409);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['password'] = $user->password;
        $success['cPassword'] = $user->password;

        $response = [
            'data' => $success,
            'message' => 'User register successfully'
        ];

        return response()->json($response,200);
    }

    Public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::User();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['password'] = $user->password;

            $response = [
                'data' => $success,
                'message' => 'User Login successfully'
            ];

            return response()->json($response,200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'unauthorised'
            ];
            return response()->json($response,401);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout successfully',
            'status' => 'success',
        ],200);
    }

    public function update(Request $request)
    {
        $user=User::find($id);
        $user->update($request->all());
            return $user();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required | same:password'
        ]);

        return response()->json([
            'status' => true,
            'message' => "Updated successfully!",
            
        ], 200);
    }


     Public function destroy($id){
         return User::destroy($id);
     }
}
