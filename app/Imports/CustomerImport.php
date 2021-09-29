<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class CustomerImport implements ToModel, WithHeadingRow, SkipsOnError
{

    use Importable;

    public function model(array $row)
    {
        //var_dump($row);
        return new Customer([
            'code' => $row['code'],
            'name'=> $row['name'],
            'location'=> $row['location'],
            'phone' => $row['phone']
        ]);
    }

    public function onError(Throwable $e)
    {

    }
}
