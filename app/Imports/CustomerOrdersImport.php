<?php

namespace App\Imports;

use Throwable;
use App\Models\Order;
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

class CustomerOrdersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        //var_dump($row);

        return new Order([
            'order_service' => 'not created',
            'costumer_code' => $row['no'],
            'costumer_name' => $row['nombre'],
            'pev' => $row['pedido_no'],
            'order_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_pedido']),
            'shipment_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['shipment_date']),
            'product_name' => $row['producto_no'],
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
