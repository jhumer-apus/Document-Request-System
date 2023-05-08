<?php

namespace App\Modules;

use App\Models\User;
use App\Models\UserProfilePicture;
use App\Models\ForgotPassword as ForgotPasswordModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword as ForgotPasswordMail;
use App\Mail\SignUp;
use App\Http\Traits\GenerateCodeTrait;
use App\Http\Resources\UserResource;
use Carbon\Carbon;

class Users
{
    use GenerateCodeTrait;

    public function getUser(){
        $id = Auth::user()->id;
        // $userDetails = new UserResource(User::where('id', $id)->first());
        $userDetails= User::where('id', $id)->first();
        return response()->json($userDetails);
    }

    public function getDetails(){
        $id = Auth::user()->id;
        // $userDetails = new UserResource(User::where('id', $id)->first());
        $userDetails= User::where('id', $id)->first();
        return response()->json($userDetails);
    }

    public function store($payload)
    {
        $rules = array(
            'email' => 'required|max:255|email',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date',
            'sex' => 'required|string',
            'civil_status' => 'required|string',
            'mobile_number' => 'required|string|min:11',
            'mothers_firstname' => 'required|string',
            'mothers_middlename' => 'required|string',
            'mothers_lastname' => 'required|string',
            'password' => 'required|string|min:8',
        );

        $validator = Validator::make($payload->all(), $rules);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors()]);
        }

        $data = array(
            'email' => $payload->email,
            'first_name' => $payload->first_name,
            'middle_name' => $payload->middle_name,
            'last_name' => $payload->last_name,
            'birthdate' => $payload->birthdate,
            'sex' => $payload->sex,
            'civil_status' => $payload->civil_status,
            'mobile_number' => $payload->mobile_number,
            'mothers_firstname' => $payload->mothers_firstname,
            'mothers_middlename' => $payload->mothers_middlename,
            'mothers_lastname' => $payload->mothers_lastname,
            'password' => bcrypt($payload->password),
        );

        DB::beginTransaction();

        $userTransaction = User::create($data);

        //generate code for verification
        $emailCode = $this->generateCode(). $userTransaction->id;
        $storeCodeTransaction = User::where('id', $userTransaction->id)->update(['email_code'=> $emailCode]);


        if(!$userTransaction || !$storeCodeTransaction){
           DB::rollback();
        }
        DB::commit();
        
        //send verification email
        $url = 'http://localhost:3000/verify-account/'.$emailCode;
        Mail::to($payload->email)->send(new SignUp($url));

        return response()->json(["message"=>"user created successfully", 'isAccountCreated' => true]);
    }

    public function verify($payload){
        $token = $payload->token;
        $userTransaction = User::where('email_code', $token)
                                ->where('email_verified_at', null)
                                ->update(['email_verified_at'=>now()]);
        if(!$userTransaction){
            return response()->json(['isVerified'=>false]);
        }
        return response()->json(['isVerified'=>true]);
    }

    public function checkEmail($email){
 
        $isEmailExist = User::where('email', $email)->first();
        if(!$isEmailExist){
            return false;
        }
        return $isEmailExist;
    }

    public function sendCode($payload){
        $email = $payload->email;
        $isEmailExist = $this->checkEmail($email);

        if(!$isEmailExist){
            return response()->json(['isEmailExist'=>false]);
        }
        $code = $this->generateCode();

        $storeCode = array(
            'user_id' => $isEmailExist->id,
            'code' => $code
        );
        ForgotPasswordModel::create($storeCode);
        Mail::to($email)->send(new ForgotPasswordMail($code));
        return response()->json(['isEmailExist'=>true,'user_id'=>$isEmailExist->id]);
    }

    public function verifyCodePassword($payload){
        $code = $payload->code;
        $userId = $payload->userId;

        $checkCode = ForgotPasswordModel::where('user_id', $userId)
                            ->where('code', $code)
                            ->first();
        if(!$checkCode){
            return response()->json(["message"=>"Wrong Code", 'isVerified'=>false]);
        }
        return response()->json(["message"=>"Verified Successfully", 'isVerified'=>true]);
    }
    public function updatePassword($payload){
        $userId = $payload->userId;
        $newPassword = $payload->newPassword;

        $data = array(
            'password'=>bcrypt($newPassword)
        );
        $updateTransaction= User::where('id',$userId)->update($data);
        if(!$updateTransaction){
            return response()->json(['message'=>'Failed to update password',  'isUpdated'=> false]);
        }

        ForgotPasswordModel::where('user_id',$userId)->delete();
        return response()->json(['message'=>'Succesfully updated a password', 'isUpdated'=> true]);
    }
    public function updateInfo($payload){
        $rules = array(
            'email' => 'required|max:255|email',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date',
            'birthplace' => 'nullable|string',
            'sex' => 'nullable|string',
            'civil_status' => 'required|string',
            'religion' => 'nullable|string',
            'purok' => 'nullable|string',
            'baranggay' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'municipality' => 'nullable|string',
            'province' => 'nullable|string',
            'mobile_number' => 'nullable|string|min:11',
            'mothers_firstname' => 'required|string',
            'mothers_middlename' => 'required|string',
            'mothers_lastname' => 'required|string',
            'password' => 'nullable|string|min:8',
        );

        $validator = Validator::make($payload->all(), $rules);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors(),401]);
        }

        $data = array(
            'email' => $payload->email,
            'first_name' => $payload->first_name,
            'middle_name' => $payload->middle_name,
            'last_name' => $payload->last_name,
            'birthdate' => $payload->birthdate,
            'birthplace' => $payload->birthplace,
            'sex' => $payload->sex,
            'civil_status' => $payload->civil_status,
            'religion' => $payload->religion,
            'purok' => $payload->purok,
            'baranggay' => $payload->baranggay,
            'zip_code' => $payload->zip_code,
            'municipality' => $payload->municipality,
            'province' => $payload->province,
            'mobile_number' => $payload->mobile_number,
            'mothers_firstname' => $payload->mothers_firstname,
            'mothers_middlename' => $payload->mothers_middlename,
            'mothers_lastname' => $payload->mothers_lastname,
        );

        if($payload->password){
            $data['password'] = bcrypt($payload->password);
        }
        $id = Auth::guard('users')->user()->id;
        $updateTransaction = User::where('id', $id)->update($data);
        if(!$updateTransaction){
            return response()->json(['message'=>'cannot update data',401]);
        }
        return response()->json(['message'=>'User update successfully']);
    }
    public function uploadPhoto($payload){
        $getUserProfilePic = UserProfilePicture::where('user_id',Auth::guard('users')->user()->id)->first();

        $userProfilePicture = new UserProfilePicture;  
        $file_name = time().'_'.$payload->file->getClientOriginalName();

        $file_path = $payload->file('file')->storeAs('profile_pic', $file_name, 'public');

        if($getUserProfilePic){
            UserProfilePicture::where('user_id',Auth::guard('users')->user()->id)
                                ->update([
                                    'filename'=>$file_name,
                                    'path'=>$file_path
                                ]);
        }else{
            $userProfilePicture->user_id = Auth::guard('users')->user()->id;
            $userProfilePicture->filename = $file_name;
            $userProfilePicture->path = $file_path;
            $userProfilePicture->save();
        }


        return response()->json([
            "message"=>"Updated Profile Pic Successfully",
            "path"=>$file_path,
        ]);
    }
    public function getProfilePic(){
        $getUserProfile = UserProfilePicture::where('user_id', Auth::guard('users')->user()->id)->first();
        return response()->json($getUserProfile);
    }

}
