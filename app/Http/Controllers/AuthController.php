<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
Para que funcionen los siguientes metodos   
https://medium.com/@cvallejo/sistema-de-autenticaci%C3%B3n-api-rest-con-laravel-5-6-240be1f3fc7d

composer require laravel/passport
php artisan passport:install


*/

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        $request->validate([

            'nombre'            => 'required|string',
            'apellido'          => 'required|string',
            'tipoDocumento'     => 'required|string',
            'nroDocumento'      => 'required|string',
            'nroCelular'        => 'required|string',
            'fechaNacimiento'   => 'required|date',

            'idReferente'    => 'required|string',

            'nombreFavorito'    => 'string',
            'nroFijo'           => 'string',
            'genero'            => 'required|string',
            'departamento'      => 'required|string',
            'ciudad'            => 'required|string',
            'barrio'            => 'required|string',            
            'direccion'         => 'required|string',
            'tipoVia'           => 'required|string',
            'referencia'        => 'required|string',

            'nombreUsuario'     => 'required|string',
            'email'             => 'required|string|email|unique:users',
            'password'          => 'required|string|confirmed',
        ]);
        
        //Al crear un nuevo modelo accedo a dicha tabla
        $user = new User([
            'nombre'            => $request->nombre,
            'apellido'          => $request->apellido,
            'tipoDocumento'     => $request->tipoDocumento,
            'nroDocumento'      => $request->nroDocumento,
            'nroCelular'        => $request->nroCelular,
            'fechaNacimiento'   => $request->fechaNacimiento,

            'idReferente'    => $request->idReferente,

            'nombreFavorito'    => $request->nombreFavorito,
            'nroFijo'           => $request->nroFijo,
            'genero'            => $request->genero,
            'departamento'      => $request->departamento,
            'ciudad'            => $request->ciudad,
            'barrio'            => $request->barrio,            
            'direccion'         => $request->direccion,
            'tipoVia'           => $request->tipoVia,
            'referencia'        => $request->referencia,
            'nombreUsuario'     => $request->nombreUsuario,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
        ]);

        $user->save();

        return response()->json([
            'message' => 'Usuario creado con éxito!'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
        ]);


        $credentials = request(['email', 'password']);
        
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        
        if (true) {
            $token->expires_at = Carbon::now()->addDays(1);
        }

        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse( $tokenResult->token->expires_at) ->toDateTimeString(),
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 
            'Successfully logged out']);
    }


    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}