<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
                'full_name' => 'required|string|max:60',
                'age' => 'required|integer|min:12',
                'salary' => 'required|numeric|min:0',
                'date_of_employment' => 'required|date',
                'manager_id' => 'required|integer|exists:employees,id',
                'department_id' => 'required|integer|exists:departments,id',
            ];
        }

        // $method === 'PATCH'
        return [
            'full_name' => 'sometimes|string|max:60',
            'age' => 'sometimes|integer|min:12',
            'salary' => 'sometimes|numeric|min:0',
            'date_of_employment' => 'sometimes|date',
            'manager_id' => 'sometimes|integer|exists:employees,id',
            'department_id' => 'sometimes|integer|exists:departments,id',
        ];
    }

    public function prepareForValidation()
    {
        $data = [];

        if ($this->has('fullName')) {
            $data['full_name'] = $this->fullName;
        }

        if ($this->has('dateOfEmployment')) {
            $data['date_of_employment'] = $this->dateOfEmployment;
        }

        if ($this->has('managerId')) {
            $data['manager_id'] = $this->managerId;
        }

        if ($this->has('departmentId')) {
            $data['department_id'] = $this->departmentId;
        }

        $this->merge($data);
    }
}
