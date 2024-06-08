<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
        $method = $this->method();


        if ($method === 'PUT') {
            return [
                'name' => 'required|string|min:1|max:100',
                'description' => 'required|string|min:1',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|string'
            ];
        }

        // $method === 'PATCH'
        return [
            'name' => 'sometimes|string|min:1|max:100',
            'description' => 'sometimes|string|min:1',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'status' => 'sometimes|string'
        ];
    }

    public function prepareForValidation()
    {
        $data = [];

        if ($this->has('name')) {
            $data['name'] = $this->name;
        }

        if ($this->has('description')) {
            $data['description'] = $this->description;
        }

        if ($this->has('startDate')) {
            $data['start_date'] = $this->startDate;
        }

        if ($this->has('endDate')) {
            $data['end_date'] = $this->endDate;
        }

        if ($this->has('status')) {
            $data['status'] = $this->status;
        }

        $this->merge($data);
    }
}
