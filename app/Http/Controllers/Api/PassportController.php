<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportResource;
use App\Models\Passport;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    use GeneralTrait;
    public function addPassport(Request $request){
        $validator=Validator::make($request->all(),[
            'applicant_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'passport_quantity'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            $passport=Passport::create([
                'applicant_name'=>$request->applicant_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'country'=>$request->country,
                'passport_quantity'=>$request->passport_quantity,
                'user_id'=>auth()->user()->id
            ]);
            return $this->returnData('data',$passport,'added successfully');
        }

    }


    public function passports(){
        $passport=Passport::all();
        return $this->returnData('data',PassportResource::collection($passport),'Done');

    }


    public function passportRequest(){
        $passport=Passport::where('user_id',auth()->user()->id)->get();
        return $this->returnData('data',PassportResource::collection($passport),'Done');
    }


    public function acceptPassport($passport_id){
        $passport=Passport::find($passport_id);
        // dd($visa);
        if($passport == null){
            return $this->returnError(506,'please check the id');
        }

        $passport->update([
            'status'=>'accepted',
        ]);
        return $this->returnData('data','passport status chaged successfully','Done');
    }


    public function rejectPassport($passport_id){
        $passport=Passport::find($passport_id);
        // dd($visa);
        if($passport == null){
            return $this->returnError(506,'please check the id');
        }

        $passport->update([
            'status'=>'rejected',
        ]);
        return $this->returnData('data','passport status chaged successfully','Done');
    }


    public function changeStatus(Request $request,$passport_id){

        $passport=Passport::find($passport_id);
        if($passport == null){
            return $this->returnError(767,'please check the id');
        }

        $passport->update([
            'status'=>$request->status
        ]);

        return $this->returnData('data','','the status changed successfully');
    }
}
