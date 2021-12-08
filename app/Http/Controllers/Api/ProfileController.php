<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(User $user){
        //All services count
        $serviceCount = Service::all()->count();

        //Services fineshed
        $serviceFinished = Service::where('isFinished', 1)->count();

        //Services finished and incidence
        $serviceWithIncidenceAndFinished = Service::select('*')
                                            ->where([
                                                ['isFinished','=',1],
                                                ['isIncidence','=', 1]
                                            ])
                                            ->count();


        //Value services finished
        $value = $serviceFinished*100/$serviceCount;

        $serviceByTechnician = $this->serviceByTechnician(2);

        //User authenticated with his services
        $services = $user->services;

        //Services with user technician
        $servicesTechnician = Service::where('technician_id', Auth::user()->id)->get();

        //Services with invested hours greater than expected hours
        $serviceFinishedInvestedHoursGreaterThanExpectedHours = $this->serviceFinishedInvestedHoursGreaterThanExpectedHours();

        return(compact('serviceCount', 'serviceFinished','serviceWithIncidenceAndFinished', 'value', 'services', 'servicesTechnician', 'serviceByTechnician','serviceFinishedInvestedHoursGreaterThanExpectedHours'));
    }

    public function serviceByTechnician ($id){

        $serviceByTechnician = Service::select('*')
        ->where([
            ['technician_id','=',$id]
        ])
        ->get();

        return(compact('serviceByTechnician'));
    }

    public function serviceFinishedInvestedHoursGreaterThanExpectedHours(){

        $serviceFinishedInvestedHoursGreaterThanExpectedHours = Service::select('*')
                                                                    ->where([
                                                                        ['isFinished','=',1],
                                                                        ['invested_hours','>','expected_hours']
                                                                    ])->get();

        return $serviceFinishedInvestedHoursGreaterThanExpectedHours;
    }
}
