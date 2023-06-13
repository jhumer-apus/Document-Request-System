<?php

namespace App\Modules;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Residents
{
    public function getAllResidents($payload){
        $search = $payload->search;
        $user = User::select(
            'first_name',
            'middle_name',
            'last_name',
            'email_verified_at',
            'sex',
            'mobile_number',
            'email',
            'purok',
            'barangay',
            'municipality',
            'province'
        )->paginate(10);
        // ->when(!empty($search), function ($query) use($search){
        //     return $query->where('user.last_name','LIKE', $search.'%');
        // })->paginate(10);
        return response()->json($user);
    }
    
    public function getResidentDetails($payload){
        $user_id = $payload->user_id;
        $user = User::where('id',$user_id)->first();
        $user = json_decode($user);
        $suffix = $user->suffix?$user->suffix:'';

        $user->full_name = $user->first_name.' '.$user->middle_name.' '.$user->last_name.' '.$suffix;
        if($user->sex == 'male'){
            $user->call_address='Mr.';
        }elseif($user->sex == 'female' && $user->civil_status=='married'){
            $user->call_address == 'Mrs.';
        }else{
            $user->call_address == 'Ms.';
        }
        $user->pronouns = $user->sex =='male'?'he':'she';
        $user->pronouns_second = $user->sex =='male'?'his':'her';



        return response()->json($user);
    }
}