<?php

namespace App\Service;

use App\Exceptions\AuthException;
use App\Exceptions\UserException;
use App\Http\Resources\AuthResource;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function auth(array $data)
    {
        try {

            if (Auth::attempt([$data, 'active' => 1])) {
                $user = Auth::user();
                $token = $this->request->user()->createToken('Jesus+' . $user->name, ['*'], now()->addHours(2))->plainTextToken;
                return new AuthResource(['token' => $token]);
            }

            throw new AuthException();
        } catch (AuthException $e) {
            throw new AuthException();
        }
    }

    public function create(array $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            User::create($request);
            return new GeneralResource(['message' => 'success']);
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function update(array $request)
    {
        try {
            $user = auth()->user();
            if (Hash::check($request['password'], $user->password)) {
                $request['password'] = $user->password;
                User::update($request);
                return new GeneralResource(['message' => 'success']);
            }
            throw new UserException();
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function show()
    {
        try {
            return UserResource::collection(auth()->user());
        } catch (UserException $e) {
            throw new UserException();
        }
    }
    public function destroy()
    {
        try {
            User::touch('deleted_at');
        } catch (UserException $e) {
            throw new UserException();
        }
    }
}
