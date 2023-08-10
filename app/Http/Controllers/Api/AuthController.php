<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Obter Token.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Suas credenciais estão incorretas, por favor, tente novamente.',
                'errors' => null
            ]);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Informações do usuário logado.
     * @authenticated
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = Auth::user();
        try {
            $userRepository = new userRepository();
            return response()->json($userRepository->show($user->id));
        } catch (\Exception $e) {
            return $this->checkStatusCodeError($e);
        }
    }

    /**
     * Atualizar token.
     * @authenticated
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        $user = Auth::user();

        $headers = [
            'Access-Control-Expose-Headers' => 'Authorization',
            'Authorization' => "Bearer $token"
        ];

        $userRepository = new UserRepository;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 43200,
            'user_logged' => $userRepository->show($user->id),
        ], Response::HTTP_OK, $headers);
    }
}
