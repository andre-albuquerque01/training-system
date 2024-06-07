<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecoverPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function store(UserRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function update(UserRequest $request)
    {
        try {
            return $this->service->update($request->validated());
        } catch (UserException $e) {
            throw new UserException();
        }
    }

    public function show()
    {
        try {
            return $this->service->show();
        } catch (UserException $e) {
            throw new UserException();
        }
    }
    public function destroy()
    {
        try {
            return $this->service->destroy();
        } catch (UserException $e) {
            throw new UserException();
        }
    }
    public function verifyEmail(string $id, string $token)
    {
        try {
            return $this->service->verifyEmail($id, $token);
        } catch (UserException $e) {
            throw new UserException();
        }
    }
    public function resendEmail(Request $request)
    {
        try {
            return $this->service->resendEmail($request->validate(["email" => "required|email|min:5"]));
        } catch (UserException $e) {
            throw new UserException('Failed to resend email', 0, $e);
        }
    }
    public function recoverPassword(Request $request)
    {
        try {
            return $this->service->recoverPassword($request->validate(["email" => "required|email|min:5"]));
        } catch (UserException $e) {
            throw new UserException('Failed to send email', 0, $e);
        }
    }
    public function updateRecoverPassword(RecoverPasswordRequest $request)
    {
        try {
            return $this->service->updateRecoverPassword($request->validated());
        } catch (UserException $e) {
            throw new UserException();
        }
    }
}
