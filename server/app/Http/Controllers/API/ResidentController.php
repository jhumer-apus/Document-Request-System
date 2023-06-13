<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Residents;

class ResidentController extends Controller
{
    public function index(Residents $residents, Request $request){
        return $residents->getAllResidents($request);
    }
    public function getResidentDetails(Residents $resident, Request $request){
        return $resident->getResidentDetails($request);
    }
}
