<?php

namespace App\Service;

use App\Exceptions\TrainingException;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\TrainingTypeResource;
use App\Http\Resources\TrainingWorkOutResource;
use App\Models\TrainingWorkOut;

class TrainingWorkOutService
{
    public function index()
    {
        try {
            $training = auth()->user()->trainingType()->with(['training.workOut'])->get();
            if ($training->isEmpty()) throw new TrainingException("Not found");
            return TrainingTypeResource::collection($training);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }
    public function store(array $request)
    {
        try {
            TrainingWorkOut::create($request);
            return new GeneralResource(["message" => "success"]);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }

    public function update(array $request, string $id)
    {
        try {
            $user  = auth()->user()->idUser;
            $training = TrainingWorkOut::where("idTrainingWorkOut", $id)->first();

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
            $training = TrainingWorkOut::where("idTrainingWorkOut", $id)->with('workOut')->first();

            if (!$training) throw new TrainingException("Not found");

            return new TrainingWorkOutResource($training);
        } catch (\Exception $th) {
            throw new TrainingException("Error" . $th->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $user = auth()->user()->idUser;

            if (!$user) {
                throw new TrainingException("Authenticated user not found");
            }

            $record = TrainingWorkOut::where("idTrainingWorkOut", $id)->whereNull("deleted_at");
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
