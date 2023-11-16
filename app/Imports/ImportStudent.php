<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStudent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'first_name'=> $row[0],
            'last_name' => $row[1],
            'language' => $row[2],
            'age' => $row[3],
            'gender' => $row[4],
        ]);
    }
}
