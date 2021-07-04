<?php

namespace App\Imports;

// use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Employee;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'nama' => $row[1],
            'jeniskelamin' => $row[2],
            'nohp' => $row[3],
            'foto' => $row[4]
        ]);
    }
}
