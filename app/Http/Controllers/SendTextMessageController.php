<?php

namespace App\Http\Controllers;

use App\Models\SendTextMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SendTextMessageController extends Controller
{
    public function login(Request $request){
        Log::info('Ingreso al Login');
        $response = ["status"=> 0, "msg"=> ""];
        $data = json_decode($request->getContent());
        $user = User::where('email',$data->email)->first();
        if ($user) {
            if (Hash::check($data->password,$user->password)) {
                $token = $user->createToken("admin");
                $response["status"] = 1;
                $response["msg"] = $token->plainTextToken;
            } else {
                $response["msg"] = "Credenciales incorrectas.";
            }

        } else {
            $response["msg"] = "Usuario no encontrado.";
        }
        return response()->json($response,200);

    }
    public function index(Request $request){
        $response = ["status"=> 0, "message"=> "", "data"=>""];

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            $response["message"] = 'Credenciales inválidas, favor de validar';
            return response()->json($response, 401);
        }

        $data = SendTextMessage::get();
        $response["status"] = 1;
        $response["message"] = "Informacion Encontrada";
        $response["data"] = $data;
        return response()->json($response,200);

    }

    public function create(){

    }

    public function store(Request $request){
        $response = ["status"=> 0,"transactionID"=>"", "message"=> "", "data"=>""];

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            $response["message"] = 'Credenciales inválidas, favor de validar';
            return response()->json($response, 401);
        }
        try {
            $sms = new SendTextMessage();
            $sms->phone = $request->celular;
            $sms->message = $request->mensaje;
            $sms->save();

            $response["status"] = 1;
            $response["transactionID"] = encryptar($sms->id);
            $response["message"] = "Registro Grabado";
            $response["data"] = $sms;
            return response()->json($response,200);

        } catch (\Throwable $th) {
            Log::debug('Error al crear el registro ' . $th);
            $response["message"] = "Error al crear el registro";
            return response()->json($response,200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SendTextMessage $sendTextMessage)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SendTextMessage $sendTextMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SendTextMessage $sendTextMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SendTextMessage $sendTextMessage)
    {
        //
    }
}
