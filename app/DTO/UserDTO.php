<?php
namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $department_id;

    public function __construct(string $name, string $department_id)
    {
        $this->name = $name;
        $this->department_id = $department_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDepartmentId()
    {
        return $this->department_id;
    }
}