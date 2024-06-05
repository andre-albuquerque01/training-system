<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MuscleException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MuscleRequest;
use App\Service\MuscleService;
use Illuminate\Http\Request;

class MuscleController extends Controller
{
    private $service;

    public function __construct(MuscleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->service->index();
        } catch (MuscleException $e) {
            throw new MuscleException();
        }
    }
    public function create(MuscleRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (MuscleException $e) {
            throw new MuscleException();
        }
    }

    public function update(MuscleRequest $request, string $id)
    {
        try {
            return $this->service->update($request->validated(), $id);
        } catch (MuscleException $e) {
            throw new MuscleException();
        }
    }

    public function show(string $id)
    {
        try {
            return $this->service->show($id);
        } catch (MuscleException $e) {
            throw new MuscleException();
        }
    }
    public function destroy(string $id)
    {
        try {
            return $this->service->destroy($id);
        } catch (MuscleException $e) {
            throw new MuscleException();
        }
    }
}
