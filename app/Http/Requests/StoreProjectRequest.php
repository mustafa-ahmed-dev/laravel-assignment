<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:100',
            'description' => 'required|string|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|string'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name,
            "description" => $this->description,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => $this->status,
        ]);
    }
}
