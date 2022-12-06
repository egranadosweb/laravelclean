<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Cookie;

class UserAuthController extends Controller
{
    //

    public function getCookie($token){
        return [
            "name" => "_token" ,
            "value" => $token ,
            "minutes" => 1440,
            "path" => null,
            "domain" => null,
            "secure" => null,
            "httponly" => true,
            "samesite" => true
        ];
    }

    public function register(Request $r){

        $validator = Validator::make($r->all() , [
            "name" => "required | string | min:5",
            "email" => "required | email | unique:App\Models\User,email | min:6",
            "password" => "required | string | min:6"
        ]);

        if($validator->fails()){
            return response()->json([
                "msg" => "Error en la validación de los campos",
                "errors" => $validator->errors()
            ],403);
        }

        $r["password"] = bcrypt($r["password"]);

        $user = User::create($r->all());
        $token = $user->createToken("API Token")->accessToken;
        
        return response()->json([
            "msg" => "Usuario creado con exito",
            "token" => $token,
            "user" => $user
        ],200);

    }

    public function login(Request $r){
        $validator = Validator::make($r->all(), [
            "email" => "required | email | min:6",
            "password" => "required |string | min:6 "
        ]);


        if($validator->fails()){
            return response()->json([
                "msg" => "Error en la validacion de los campos",
                "errors" => $validator->errors()
            ],403);
        }

        if(!Auth::attempt(["email" => $r->email , "password" => $r->password])){
            return response()->json([
                "msg" => "Credenciales incorrectas",
            ],401);
        }

        $user = Auth::user();
        $token = $user->createToken("API Token")->accessToken;
        $cookie = $this->getCookie($token);

        return response()->json([
            "msg" => "Autenticacion exitosa",
            "user" => $user,
            "token" => $token
        ],200)
        ->cookie(
            $cookie["name"],
            $cookie["value"],
            $cookie["minutes"],
            $cookie["path"],
            $cookie["domain"],
            $cookie["secure"],
            $cookie["httponly"],
            $cookie["samesite"]
        );
    }


    public function logout(){
        if(!Auth::check()){
            return response()->json([
                "msg" => "No autorizado"
            ],401);
        }

        $cookie = Cookie::forget("_token");

        Auth::user()->tokens->each(function($token){
            $token->delete();
        });

        return response()->json([
            "msg" => "Log out exitoso",
            "user" => Auth::user(),
        ],200)
        ->withCookie($cookie);
    }



    
    public function user_info(){
        $user = Auth::user();
        return response()->json([
            "msg" => "user_info exitosa",
            "user" => $user
        ],200);
    }
}
