<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WorkException;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\Service\WorkService;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    private $service;

    public function __construct(WorkService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->service->index();
        } catch (WorkException $e) {
            throw new WorkException();
        }
    }
    public function store(WorkRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (WorkException $e) {
            throw new WorkException();
        }
    }

    public function update(WorkRequest $request, string $id)
    {
        try {
            return $this->service->update($request->validated(), $id);
        } catch (WorkException $e) {
            throw new WorkException();
        }
    }

    public function show(string $id)
    {
        try {
            return $this->service->show($id);
        } catch (WorkException $e) {
            throw new WorkException();
        }
    }
    public function destroy(string $id)
    {
        try {
            return $this->service->destroy($id);
        } catch (WorkException $e) {
            throw new WorkException();
        }
    }
}
