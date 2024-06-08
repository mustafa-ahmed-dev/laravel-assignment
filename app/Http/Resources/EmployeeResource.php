<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->full_name,
            'age' => $this->age,
            'salary' => $this->salary,
            'dateOfEmployment' => $this->date_of_employment,
            'managerId' => $this->manager_id,
            'departmentId' => $this->department_id,
        ];
    }
}
