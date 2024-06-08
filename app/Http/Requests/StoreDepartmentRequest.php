<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required|string|min:1',
            'manager_id' => 'nullable|integer|exists:employees,id',
            'created_at' => 'required|date'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name,
            'description' => $this->description,
            'manager_id' => $this->managerId,
            'created_at' => $this->createdAt,
        ]);
    }
}
