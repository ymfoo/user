<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;

class UserController extends Controller
{
    public function getDepartmentList()
    {
        $dep = Department::all();
        return response()->json($dep);
    }
}
