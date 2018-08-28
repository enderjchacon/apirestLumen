<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function index(Request $request){
        
        if ($request->isJson()){
            //Eloquent
            $users = User::all();
            return response()->json($users,200);
        }

        return response()->json(['error'=>'No Autorizado'],401);
    }

    public function createUser(Request $request){

        if ($request->isJson()){
            $data = $request->json()->all();
            $user = User::create([
                'name'      => $data['name'],
                'usename'   => $data['usename'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'api_token'  => str_random(25)
            ]);

            return response()->json($user,201);
        }

        return response()->json(['error'=>'No Autorizado'],401);
    }

    public function getToken(Request $request)
    {
        if ($request->isJson()){
            try{
                $data = $request->json()->all();
                $user = User::where('usename', $data['usename'])->first();
                if($user && Hash::check($data['password'],$user->password)){
                    return response()->json($user,200);
                }else{
                    return response()->json(['Error'=>'No Content'],406);
                }
                
            } catch(ModelNotFoundException $exception) {
                return response()->json(['Error'=>'No Content'],406);
            }
        }
    }
}
