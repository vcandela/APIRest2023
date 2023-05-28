<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function users(Request $request){
        $response = ["status"=> 0, "message"=> "", "data"=>""];

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            $response["message"] = 'Credenciales inválidas, favor de validar';
            return response()->json($response, 401);
        }

        $data = User::select('name', 'email', 'password','recuperar')->get();
        $response["status"] = 1;
        $response["message"] = "Informacion Encontrada";
        $response["data"] = $data;
        return response()->json($response,200);
    }
    //
}
