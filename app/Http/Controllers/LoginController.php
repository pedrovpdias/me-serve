<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;


class LoginController extends Controller
{
    public function verifyEmail(Request $request) {
        $email = $request->input('email');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'denied', 'message' => 'Informe um e-mail valido.']);
        }

        else {
            // Verifica se o e-mail existe no banco de dados
            if (!User::where('email', $email)->exists()) {
                return response()->json(['status' => 'denied', 'message' => 'Usuário nao cadastrado.']);
            }

            // Verifica se o e-mail foi verificado
            //if (User::where('email', $email)->where('email_verified_at', null)->exists()) {
            //    return response()->json(['status' => 'error', 'message' => 'E-mail ainda não verificado.']);
            //}

            else return response()->json(['status' => 'success']);
        }

        
    }
}
