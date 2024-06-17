<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|min:2|max:255|string",
            'description' => "nullable|min:2|max:255|string",
            'image' => "nullable|min:2|string",
            "muscle" => "nullable|min:2|max:255|string",
            "equipment" => "nullable|min:2|max:255|string",
            "difficulty" => "nullable|min:2|max:255|string",
            "duration" => "nullable|min:2|max:255|string",
            "calories" => "nullable|min:2|max:255|string",
            "weight" => "nullable|min:2|max:255|string",
            "repetition" => "nullable|min:1|max:255|string",
        ];
    }
}
