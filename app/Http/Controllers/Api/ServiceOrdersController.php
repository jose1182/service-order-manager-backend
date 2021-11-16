<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Actions\Service\ServiceAction;
use App\Actions\Service\updateServiceDetailsAction;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceOrdersController extends Controller
{
    public function store(ServiceCreateRequest $ServiceCreateRequest, ServiceAction $serviceAction){

        $service = $serviceAction->run($ServiceCreateRequest->all());

        if (!$service) {
            return response()->json(['success' => false, 'message' => 'Service was not created successfully'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Service created successfully']);
    }

    public function show($id){

        if (Gate::allows('view-technical-dashboard')) {
            return new ServiceResource(Service::findOrFail($id));
        }
    }

    public function updateServiceDetails(UpdateServiceRequest $updateServiceRequest, updateServiceDetailsAction $updateServiceDetailsAction){

        $service = $updateServiceDetailsAction->run($updateServiceRequest->all());

        return response()->json(["respuesta" => $updateServiceRequest->all()]);

    }
}
