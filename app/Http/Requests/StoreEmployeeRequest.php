<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'full_name' => 'required|string|max:60',
            'age' => 'required|integer|min:12',
            'salary' => 'required|numeric|min:0',
            'date_of_employment' => 'required|date',
            'manager_id' => 'nullable|integer|exists:employees,id',
            'department_id' => 'nullable|integer|exists:departments,id',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'full_name' => $this->fullName,
            "date_of_employment" => $this->dateOfEmployment,
            'manager_id' => $this->managerId,
            'department_id' => $this->departmentId,
        ]);
    }
}
