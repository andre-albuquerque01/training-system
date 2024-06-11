<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TrainingException;
use App\Http\Controllers\Controller;
use App\Service\TrainingTypeService;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{
    private $service;

    public function __construct(TrainingTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->service->index();
        } catch (TrainingException $e) {
            throw new TrainingException();
        }
    }
    public function store(Request $request)
    {
        try {
            return $this->service->store($request->validated());
        } catch (TrainingException $e) {
            throw new TrainingException();
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            return $this->service->update($request->validated(), $id);
        } catch (TrainingException $e) {
            throw new TrainingException();
        }
    }

    public function show(string $id)
    {
        try {
            return $this->service->show($id);
        } catch (TrainingException $e) {
            throw new TrainingException();
        }
    }
    public function destroy(string $id)
    {
        try {
            return $this->service->destroy($id);
        } catch (TrainingException $e) {
            throw new TrainingException();
        }
    }
}
