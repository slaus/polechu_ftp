<?php

namespace App\Services\Employee;

use App\Models\Employee;
use App\Models\User;

class CommandEmployeeService
{
    private readonly Employee $employee;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $employee = Employee::create($data);

        $this->employee = $employee;
    }

    public function update(int $id, array $data): void
    {
        $employee = Employee::findOrFail($id);
        $employee->update($data);

        $this->employee = $employee;
    }

    public function delete(int $id): void
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }

    public function employee(): Employee
    {
        return $this->employee;
    }
}
