<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Usuario;

class AuthController extends Controller
{

    /**
     * Login
     *
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = Usuario::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'Email o Contraseña incorrecto'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $permissions = $user->getPermissionsViaRoles()->pluck('name');

        return new JsonResponse([
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $user,
            'roles' =>  $user->getRoleNames(),
            'permissions' => $permissions,
        ]);
    }

    /**
     * Logout
     *
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return new JsonResponse(null, 200);
    }

    /**
     * Devuelve los permisos del usuario authentificado
     *
     */
    public function ping(Request $request): JsonResponse
    {
        $user = $request->user();
        $permissions = $user->getPermissionsViaRoles()->pluck('name');

        return new JsonResponse([
            'token_type' => 'Bearer',
            'access_token' => $request->bearerToken(),
            'user' => $user,
            'roles' =>  $user->getRoleNames(),
            'permissions' => $permissions,
        ]);
    }
}
