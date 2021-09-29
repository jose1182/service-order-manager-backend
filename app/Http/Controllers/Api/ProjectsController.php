<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    public function index(){

        if (Gate::allows('view-admin-dashboard')) {
            return Project::all();
        }

    }
}
