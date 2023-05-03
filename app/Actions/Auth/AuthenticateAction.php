<?php

namespace App\Actions\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthenticateAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
    
            $auth = auth()->guard('web');
    
            if (!$auth->attempt($credentials)) {
                $auth->logout();
                return response()->json(["message" => "credenciais informada incorretamente"]);
            }
    
            return response()->json($auth->user());

        } catch (Exception $e) {
            return response()->json(["messages" => $e->getMessage()], $e->getCode());
        }
    }
}
