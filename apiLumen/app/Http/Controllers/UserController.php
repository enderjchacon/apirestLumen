<?php

namespace App\Http\Controllers;

class UserController extends Controller{

    public function index(){

        $users = User::all();
        return response()->json($users,200);
    }

}
