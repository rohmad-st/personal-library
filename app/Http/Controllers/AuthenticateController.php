<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
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
                $message = [
                    'success'  => false,
                    'messages' => [
                        'status' => 'invalid_credentials',
                        'msg'    => 'Gagal login. Silahkan ulangi login.',
                    ]
                ];

                return response()->json($message, 401);
            }

        } catch (JWTException $e) {
            // something went wrong
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'could_not_create_token',
                    'msg'    => 'Gagal login. Silahkan ulangi login.',
                ]
            ];

            return response()->json($message, 500);
        }

        // result token
        // $token = compact('token')['token'];

        // save token to session
        Redis::set('_token', $token);

        // set message response
        $message = [
            'success' => true,
            'token'   => $token
        ];

        return response()->json($message);
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
                $message = [
                    'success'  => false,
                    'messages' => [
                        'status' => 'user_not_found',
                        'msg'    => 'User tidak ditemukan, silahkan daftar atau login dengan akun yang valid.',
                    ]
                ];

                return response()->json($message, 404);
            }

        } catch (TokenExpiredException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_expired',
                    'msg'    => 'Token sudah habis, silahkan login lagi.',
                    'code'   => $e->getStatusCode(),
                ]
            ];

            return response()->json($message);

        } catch (TokenInvalidException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_invalid',
                    'msg'    => 'Token tidak valid, silahkan mengulangi login Anda.',
                    'code'   => $e->getStatusCode(),
                ]
            ];

            return response()->json($message);

        } catch (JWTException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_absent',
                    'msg'    => 'Token kosong, silahkan mengulangi login Anda.',
                    'code'   => $e->getStatusCode(),
                ]
            ];

            return response()->json($message);
        }

        $message = [
            'success' => true,
            'user'    => $user //compact('user')['user'],
        ];

        return response()->json($message);

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

        Session::flush();

        $result = [
            'success' => true,
            'message' => 'Berhasil logout'
        ];

        return response()->json($result);
    }
}
