<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ApiAuthController extends Controller
{

    public $successStatus = 200;

    public function register (Request $request) {
    

       $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|alpha|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'prenom'=> 'required|string|alpha|max:255',
            'password_confirmation' => 'required|same:password', 
        ]);
         if ($validator->fails())
               { 
            return response()->json(['error'=>[$validator->errors()]], 401);            
               }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        return response()->json("register sussces", 200);

     
    }


    public function login (Request $request) {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('justech')->accessToken; 
            $data['id']=$user->id;
            $data['name']=$user->name;
            $data['email']=$user->email;
            $data['role']=$user->role;
            $data['prenom']=$user->prenom;
            $data['token']=$token;
            
            return response()->json($data, $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 

      
    }

    public function logout(Request $request)
    {
        $request->user()->token();
        return response()->json( [$request->user()->AauthAcessToken()->delete(),
            'message' => 'Successfully logged out'
        ]);
    }

    public function test(){
        //return  response()->json( Passport::user() );
    }
    
}
/*registe

 /*  $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response()->json($user, 200);
        return response()->json($request, 200);
login DB::delete(/*  $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }*/


