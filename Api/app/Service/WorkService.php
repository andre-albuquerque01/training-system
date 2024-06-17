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
            $work = WorkOut::whereNull("deleted_at")->get();
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
            WorkOut::where("idWorkOut", $id)->update($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function show(string $id)
    {
        try {
            $work = WorkOut::where("idWorkOut", $id)->first();
            return new WorkResource($work);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }

    public function destroy(string $id): GeneralResource
    {
        try {
            $user = auth()->user()->idUser;

            if (!$user) {
                throw new WorkException("Authenticated user not found");
            }

            $record = WorkOut::where("idWorkOut", $id)->whereNull("deleted_at")->first();
            if (!$record) {
                throw new WorkException("Already delete");
            }

            $record->touch('deleted_at');
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new WorkException();
        }
    }
}
