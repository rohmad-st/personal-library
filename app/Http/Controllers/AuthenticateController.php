<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['postAuth']]);
    }

    /**
     * Authenticate Post login
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // result token
        $result = compact('token')['token'];

        // save token to session
        Redis::set('_token', $token);

        return response()->json($result);
    }

    /**
     * Get Info authenticate - detail user login
     *
     * @return array
     */
    public function getAuth()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user')['user']);

    }

    /**
     * Logout or delete JWT
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAuth()
    {
        // Delete token
        JWTAuth::parseToken()->invalidate();

        $result = [
            'success' => true,
            'message' => 'Berhasil logout'
        ];

        return response()->json($result);
    }
}
