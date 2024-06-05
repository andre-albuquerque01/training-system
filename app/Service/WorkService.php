<?php

namespace App\Service;

use App\Exceptions\WorkException;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\WorkResource;
use App\Models\WorkOut;

class WorkService
{

    public function index()
    {
        try {
            $work = WorkOut::get();
            return WorkResource::collection($work);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function create(array $request): GeneralResource
    {
        try {
            WorkOut::create($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function update(array $request, string $id): GeneralResource
    {
        try {
            WorkOut::findOrFail($id)->update($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function show(string $id)
    {
        try {
            $work = WorkOut::findOrFail($id);
            return WorkResource::collection($work);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function destroy(string $id): GeneralResource
    {
        try {
            $user = auth()->user();

            if (!$user) {
                throw new WorkException("Authenticated user not found");
            }

            $record = WorkOut::findOrFail($id)->whereNull("deleted_at");
            if ($record) {
                $record->touch('deleted_at');
            } else {
                throw new WorkException("Already delete");
            }
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }
}
