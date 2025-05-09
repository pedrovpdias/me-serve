<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\User;


class AuthController extends Controller
{
    // Autentica o usuário e retorna o token
    public function login(Request $request)
    {
        // Valida o e-mail e a senha
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = Auth::attempt($request->only('email', 'password')); // Retorna o token
       
        // Se o token for falso
        if (!$token) {
            // Retorna o erro
            $response = [
                'status' => 'denied', // Status de erro denied (negado)
                'message' => 'Usuário ou senha incorretos.' // Mensagem de erro
            ];
        }

        else {
            // Se o token for verdadeiro
            $response = [
                'status' => 'success', // Status de sucesso
                'token' => $token, // Token
                'user' => Auth::user() // Usuário
            ];
        }

        return response()->json($response);
    }
    
    // Verifica se o e-mail existe no banco de dados
    public function verifyEmail(Request $request) {
        $email = $request->input('email');

        if (!$email || empty($email)) {
            return response()->json(['status' => 'denied', 'message' => 'Informe um e-mail.']);
        }

        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'denied', 'message' => 'Informe um e-mail válido.']);
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

    // Desloga o usuário
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
