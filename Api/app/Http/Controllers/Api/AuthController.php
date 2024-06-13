<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\GeneralResource;
use App\Service\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function auth(AuthRequest $request)
    {
        try {
            return $this->service->auth($request->validated());
        } catch (\Exception $e) {
            throw new AuthException();
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return new GeneralResource(['message' => "success"]);
        } catch (\Exception $e) {
            throw new AuthException("Error logout");
        }
    }
}
