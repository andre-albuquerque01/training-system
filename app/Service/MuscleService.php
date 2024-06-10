<?php

namespace App\Service;

use App\Exceptions\MuscleException;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\MuscleResource;
use App\Models\Muscle;

class MuscleService
{

    public function index()
    {
        try {
            $muscle = Muscle::where('user_id', auth()->user()->idUser)->with(["workOut" => function ($query) {
                $query->whereNull("deleted_at");
            }])->get();
            if ($muscle->isEmpty()) throw new MuscleException("Not found");
            return MuscleResource::collection($muscle);
        } catch (\Exception $th) {
            throw new MuscleException("Error" . $th->getMessage());
        }
    }

    public function create(array $request)
    {
        try {
            $request['user_id'] = auth()->user()->idUser;
            Muscle::create($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new MuscleException();
        }
    }

    public function show(string $id)
    {
        try {
            $muscle = Muscle::find($id)->where("user_id", auth()->user()->idUser)->with(["workOut" => function ($query) {
                $query->whereNull("deleted_at");
            }])->get();
            if (!$muscle) throw new MuscleException("Not found");
            return MuscleResource::collection($muscle);
        } catch (\Throwable $th) {
            throw new MuscleException();
        }
    }

    public function update(array $request, string $id)
    {
        try {
            $user  = auth()->user()->idUser;
            $muscle = Muscle::where("idMuscle", $id)->where("user_id",  $user)->first();

            if (!$muscle) throw new MuscleException("Not found");

            $muscle->update($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new MuscleException();
        }
    }

    public function destroy(string $id): GeneralResource
    {
        try {
            $user = auth()->user();

            if (!$user) {
                throw new MuscleException("Authenticated user not found");
            }

            $record = Muscle::where("idMuscle", $id)->where("user_id",  $user)->whereNull("deleted_at");
            if ($record) {
                $record->touch('deleted_at');
            } else {
                throw new MuscleException("Already delete");
            }
            return new GeneralResource(["message" => "success"]);
        } catch (\Throwable $th) {
            throw new MuscleException();
        }
    }
}
