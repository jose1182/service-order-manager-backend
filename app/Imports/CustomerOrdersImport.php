<?php

namespace App\Imports;

use Throwable;
use App\Models\ServiceOrder;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\ValidationException;

class CustomerOrdersImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        //var_dump($row);

        return new ServiceOrder([
            'costumer_id' => $row['no'],
            'pev' => $row['pedido_no'],
            'order_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_pedido']),
            'shipment_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['shipment_date']),
            'name_product' => $row['producto_no'],
            'quantity' => $row['quantity'],
            'description' => $row['description']
        ]);
    }

    public function rules(): array
    {
        return [

            '*.producto_no' => Rule::in(['ATL-R', 'DRC MP'])

        ];
    }

}
