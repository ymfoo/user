<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function list()
    {
        $departments = Department::all();

        return $departments;
    }
}