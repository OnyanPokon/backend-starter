<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthService
{

    protected $model;
    protected $layananMandiriService;

    public function login($request)
    {
        DB::beginTransaction();
        try {
            $validate = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $credentials = filter_var($request->email, FILTER_VALIDATE_EMAIL)
                ? ['email' => $request->email, 'password' => $request->password]
                : ['name' => $request->email, 'password' => $request->password];

            if (!Auth::attempt($credentials)) {
                throw new Exception('Email atau password salah');
            }

            $user = User::where('name', $request->email)->orWhere('email', $request->email)->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                'token_type' => 'Bearer',
                'token' => $token,
            ];

            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getUser($request)
    {
        try {
            
            if ($request->user()->roles->first()->name == 'konseli' || $request->user()->roles->first()->name == 'admin' || $request->user()->roles->first()->name == 'konselor') {
                $responseData = [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'role' => [
                        'id' => $request->user()->roles->first()->id,
                        'name' => $request->user()->roles->first()->name,
                        'permissions' => $request->user()->roles->first()->permissions->pluck('name')
                    ],
                    'permissions' => $request->user()->permissions->pluck('name') ?? '-'
                ];
            }

            return $responseData;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function logout($request)
    {
        $data = $request->user()->tokens()->delete();

        return $data;
    }
}
