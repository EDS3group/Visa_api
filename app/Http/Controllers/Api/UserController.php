<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportResource;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\UserVisaResource;
use App\Http\Resources\VisaResource;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Passport;
use App\Models\School;
use App\Models\Visa;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use GeneralTrait;

    public function contactUs(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'company_name'=>'required',
            'message'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            ContactUs::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'company_name'=>$request->company_name,
                'message'=>$request->message,
                // 'user_id'=>auth()->user()->id,
            ]);

            return $this->returnData('data','','your message sent successfully');
        }
    }


    public function addSchool(Request $request){
        $validator=Validator::make($request->all(),[
            'applicant_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'nationality'=>'required',
            'mode_of_finance'=>'required',
            'major_of_study'=>'required',
            'qualification'=>'required',
            'grade'=>'required',
            'call_from'=>'required',
            'call_to'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            School::create([
                'applicant_name'=>$request->applicant_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'country'=>$request->country,
                'nationality'=>$request->nationality,
                'mode_of_finance'=>$request->mode_of_finance,
                'major_of_study'=>$request->major_of_study,
                'qualification'=>$request->qualification,
                'grade'=>$request->grade,
                'call_from'=>$request->call_from,
                'call_to'=>$request->call_to,
                'user_id'=>auth()->user()->id
            ]);

            return $this->returnData('data','','your application sent successfully');
        }
    }


    public function getSchool(){
        $school=School::where('user_id',auth()->user()->id)->get();
        return $this->returnData('data',SchoolResource::collection($school),'Done');
    }


    public function getCountry(Request $request, $country_id){
       $lang= $request->header('lang');

      $country=Country::select('id','name_'.$lang,'value_'.$lang,'code','created_at')->first();

      return $this->returnData('data',$country,'Done');

    }


    public function getCountries(Request $request){
        $lang= $request->header('lang');

        $countries=Country::select('id','name_'.$lang,'value_'.$lang,'code','created_at')->get();

        return $this->returnData('data',$countries,'Done');
    }


    public function allRequests(){
        $passport_requests=Passport::where('user_id',auth()->user()->id)->get();
        $school_requests=School::where('user_id',auth()->user()->id)->get();
        $visa_requests=Visa::where('user_id',auth()->user()->id)->get();

        return $this->returnData('data',['passport_requests'=>PassportResource::collection($passport_requests),
                                         'school_requests'=>SchoolResource::collection($school_requests),
                                         'visa_requests'=>UserVisaResource::collection($visa_requests)
                                        ] ,'Done');
    }

    public function changeStatus(Request $request,$school_id){
        $school=School::find($school_id);
        if($school == null){
            return $this->returnError(767,'please check the id');
        }

        $school->update([
            'status'=>$request->status
        ]);

        return $this->returnData('data','','the status changed successfully');
    }
}
