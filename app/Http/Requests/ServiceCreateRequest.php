<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_id'    => 'nullable|numeric',
            'order_service' => 'required|string|max:255',
            'costumer_code' => 'required|string|max:255',
            'costumer_name' => 'required|string|max:255',
            'pev'           => 'required|string|max:10',
            'project_id'    => 'required|numeric',
            'quantity'      => 'required|numeric',
            'description'   => 'required|string|max:255',
            'order_date'    => 'nullable|date',
            'shipment_date' => 'nullable|date'

        ];
    }
}
