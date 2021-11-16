<?php

namespace  App\Actions\Service;

use App\Models\Service;

class updateServiceDetailsAction{

    public function run($request){
        $service = Service::findOrFail($request['id']);

        $service->issue_date = $request['issue_date'];
        $service->project_id = $request['project']['id'];
        $service->costumer_id = $request['costumer']['id'];
        $service->contact_id = $request['contact']['id'];
        $service->end_costumer_id = $request['endCostumer']['id'];
        $service->end_contact_id = $request['endContact']['id'];
        $service->service_date = $request['service_date'];
        $service->start_time = $request['start_time'];
        $service->expected_hours = $request['expected_hours'];
        $service->responsible_id = $request['responsible']['id'];
        $service->technician_id = $request['technician']['id'];
        $service->description = $request['description'];
        $service->isIncidence = $request['isIncidence'];
        $service->isFinished = $request['isFinished'];
        $service->invested_hours = $request['invested_hours'];
        $service->end_date = $request['end_date'];
        $service->isCheckedByAccount = $request['isCheckedByAccount'];
        $service->isCheckedByCoordinator = $request['isCheckedByCoordinator'];
        $service->isCheckedByTechnician = $request['isCheckedByTechnician'];
        return $service->save();
/*         'order_service' => $this->order_service, we cannot change
        'issue_date' => $this->issue_date, - ok
        'order_details' => $order, - is not necessary
        'project' => $this->project, - ok
        'costumer'=> $this->customer, - ok
        'contact'=> $this->contact,
        'contacting'=>$this->contacting,
        'user'=>$this->user,
        'technician'=> $this->technician,
        'responsible'=>$this->responsible,
        'address' => $this->address,
        'service_date'=>$this->service_date,
        'start_time'=>$this->start_time,
        'expected_hours'=>$this->expected_hours,
        'description'=>$this->description,
        'isIncidence'=>$this->isIncidence,
        'isFinished'=>$this->isFinished,
        'invested_hours'=>$this->invested_hours,
        'end_date'=>$this->end_date,
        'isCheckedByTechnician'=>$this->isCheckedByTechnician,
        'isCheckedByCoordinator'=>$this->isCheckedByCoordinator,
        'isCheckedByAccount'=>$this->isCheckedByAccount, */

    }

}
