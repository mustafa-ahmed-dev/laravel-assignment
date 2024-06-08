<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
                'name' => 'required|string|max:50',
                'description' => 'required|string|min:1',
                'manager_id' => 'required|integer|exists:employees,id',
                'created_at' => 'required|date'
            ];
        }

        // $method === 'PATCH'
        return [
            'name' => 'sometimes|string|max:50',
            'description' => 'sometimes|string|min:1',
            'manager_id' => 'sometimes|integer|exists:employees,id',
            'created_at' => 'sometimes|date'
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

        if ($this->has('managerId')) {
            $data['manager_id'] = $this->managerId;
        }

        if ($this->has('createdAt')) {
            $data['created_at'] = $this->createdAt;
        }

        $this->merge($data);
    }
}
