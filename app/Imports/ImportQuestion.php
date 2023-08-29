<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportQuestion implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Question([
            'title' => $row[0],
            'instruction' => $row[1],
            'answered_type' => $row[2],
            'media_type' => $row[3],
        ]);
    }
}
