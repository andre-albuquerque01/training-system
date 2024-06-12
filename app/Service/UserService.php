<?php

namespace App\Service;

use App\Exceptions\AuthException;
use App\Exceptions\UserException;
use App\Http\Resources\AuthResource;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\UserResource;
use App\Jobs\RecoverPasswordSend;
use App\Jobs\SendVerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
            if (Auth::attempt($data)) {
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
            $request['remember_token'] = Str::random(60);
            $user = User::create($request);
            $token = Crypt::encrypt($user->remember_token);
            SendVerifyEmail::dispatch($request['email'], $user->idUser, $token);
            return new GeneralResource(['message' => 'success']);
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function update(array $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                throw new UserException("Authenticated user not found");
            }

            if (!Hash::check($request['password'], $user->password)) {
                throw new UserException("Password incorret");
            }

            $request['password'] = $user->password;
            User::where("email", $user->email)->update($request);
            return new GeneralResource(['message' => 'success']);
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
            $user = auth()->user()->idUser;
            if ($user) {
                $record = User::where("idUser", $user)->whereNull("deleted_at")->first();
                if (!$record) {
                    throw new UserException("Already delete");
                }
                $record->touch('deleted_at');
                return new GeneralResource(["message" => "success"]);
            } else {
                throw new UserException("Authenticated user not found");
            }
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function verifyEmail(string $id, string $token)
    {
        try {
            $user = User::findOrFail($id);
            if (Crypt::decrypt($token) == $user->remember_token) {
                $user->touch("email_verified_at");
                return new GeneralResource(['message' => 'success']);
            }
            throw new UserException("Token invalid");
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function resendEmail(array $request)
    {
        try {
            $user = User::where("email", $request["email"])->first();
            if (!$user) throw new UserException("User not found");
            $token = Crypt::encrypt($user->remember_token);
            SendVerifyEmail::dispatch($request['email'], $user->idUser, $token);
            return new GeneralResource(['message' => 'success']);
        } catch (UserException $e) {
            throw new UserException();
        }
    }
    public function recoverPassword(array $request)
    {
        try {
            $user = User::where("email", $request["email"])->first();
            if (!$user) throw new UserException("User not found");

            $token = Str::random(60);

            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $request['email'])->first();

            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $request['email'])->update([
                    'token' => $token,
                    'created_at' => now(),
                ]);
            } else {
                DB::table('password_reset_tokens')->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => now(),
                ]);
            }

            RecoverPasswordSend::dispatch($request['email'], $token);
            return new GeneralResource(['message' => 'success']);
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function updateRecoverPassword(array $request)
    {
        try {
            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $request['email'])->first();

            if (!$passwordResetToken) throw new UserException("User not found");
            if ($passwordResetToken->token != $request["token"]) throw new UserException("Token invalid");

            User::where("email", $request['email'])->update([
                'password' => Hash::make($request['password']),
            ]);
            return new GeneralResource(['message' => 'success']);
        } catch (UserException $e) {
            throw new UserException();
        }
    }
}
