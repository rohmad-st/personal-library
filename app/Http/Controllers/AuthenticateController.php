<?php namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthenticateController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['postAuth', 'getAuth']]);
    }

    /**
     * Authenticate Post login
     *
     * @param LoginFormRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAuth(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $message = [
                    'success'  => false,
                    'code'     => 401,
                    'messages' => [
                        'status' => 'invalid_credentials',
                        'msg'    => 'Email atau Password salah. Silahkan register atau ulangi login.',
                    ]
                ];

                return $message;
                //return response()->json($message, 401);
            }

        } catch (JWTException $e) {
            // something went wrong
            $message = [
                'success'  => false,
                'code'     => 500,
                'messages' => [
                    'status' => 'could_not_create_token',
                    'msg'    => 'Terjadi kesalahan. Silahkan ulangi login.',
                ]
            ];

            return $message;
        }

        // set message response
        $message = [
            'success'  => true,
            'messages' => [
                'token' => $token,
                'msg'   => 'Berhasil login.',
            ]
        ];

        return $message;
        //return response()->json($message);
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
                        'msg'    => 'User tidak ditemukan, silahkan Daftar atau Login dengan Akun yang valid.',
                    ]
                ];

                return response()->json($message, 404);
            }

        } catch (TokenExpiredException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_expired',
                    'msg'    => 'Kode Akses sudah habis, silahkan login lagi.',
                ]
            ];

            return response()->json($message, $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_invalid',
                    'msg'    => 'Akses tidak valid, silahkan mengulangi login Anda.'
                ]
            ];

            return response()->json($message, $e->getStatusCode());

        } catch (JWTException $e) {
            $message = [
                'success'  => false,
                'messages' => [
                    'status' => 'token_absent',
                    'msg'    => 'Silahkan masukkan Kode Akses/Token yang valid.',
                ]
            ];

            return response()->json($message, $e->getStatusCode());
        }

        $message = [
            'success' => true,
            'user'    => Auth::user()
        ];

        return response()->json($message);

    }

    /**
     * Logout or delete current JWT
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAuth()
    {
        // Delete token
        JWTAuth::parseToken()->invalidate();

        $result = [
            'success' => true,
            'message' => 'Berhasil logout.'
        ];

        return response()->json($result);
    }
}
