<?php

namespace App\Service;

use App\Exceptions\TrainingException;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\TrainingTypeResource;
use App\Models\TrainingType;

class TrainingTypeService
{
    public function index()
    {
        try {
            $training = auth()->user()->trainingType();
            if ($training->isEmpty()) throw new TrainingException("Not found");
            return TrainingTypeResource::collection($training);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }
    public function store(array $request)
    {
        try {
            $request['user_id'] = auth()->user()->idUser;
            TrainingType::create($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }

    public function update(array $request, string $id)
    {
        try {
            $user  = auth()->user()->idUser;
            $training = TrainingType::where("idTrainingType", $id)->where("user_id",  $user)->first();

            if (!$training) throw new TrainingException("Not found");

            $training->update($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $user  = auth()->user()->idUser;
            $training = TrainingType::where("idTrainingType", $id)->where("user_id",  $user)->first();

            if (!$training) throw new TrainingException("Not found");

            return TrainingTypeResource::collection($training);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                throw new TrainingException("Authenticated user not found");
            }

            $record = TrainingType::where("idTrainingType", $id)->where("user_id",  $user)->whereNull("deleted_at");
            if ($record) {
                $record->touch('deleted_at');
            } else {
                throw new TrainingException("Already delete");
            }
            return new GeneralResource(["message" => "success"]);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }
}
