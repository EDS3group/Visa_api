<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\VisaInformationResource;
use App\Http\Resources\VisaResource;
use App\Models\User;
use App\Models\Visa;
use App\Models\VisaInformation;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VisaController extends Controller
{
    use GeneralTrait;

    public function getUser(){
        $user=User::find(auth()->user()->id);
        return $this->returnData('data',new UserResource($user),'Done');
    }

    public function addVisa(Request $request){
        $validator=Validator::make($request->all(),[
            'center_apply'=>'required',
            'date'=>'required',
            'country'=>'required',
            // 'relation'=>'required',
            'total_price'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{

            DB::beginTransaction();
            $visa=Visa::create([
                'center_apply'=>$request->center_apply,
                'date'=>$request->date,
                'country'=>$request->country,
                'travelers_number'=>$request->travelers_number,
                'relation'=>$request->relation,
                'coupon'=>$request->coupon,
                'total_price'=>$request->total_price,
                'user_id'=>auth()->user()->id
            ]);
            return $this->returnData('data',$visa,'added successfully');
        }
    }


    public function addVisaInformation(Request $request){
        $validator=Validator::make($request->all(),[
            'center_apply'=>'required',
            'date'=>'required',
            'country'=>'required',
            'sponsor_name'=>'required',
            // 'relation'=>'required',
            'total_price'=>'required',
            'visa'=>'required',
            'visa.*.first_name'=>'required',
            'visa.*.last_name'=>'required',
            'visa.*.passport_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'visa.*.national_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            // 'visa.*.shengen_visa_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'visa.*.social_status'=>'required',
            // 'visa.*.bank_statment_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            // 'visa.*.job_letter_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',


        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
              DB::beginTransaction();
                $visaa=Visa::create([
                    'center_apply'=>$request->center_apply,
                    'date'=>$request->date,
                    'country'=>$request->country,
                    'travelers_number'=>$request->travelers_number,
                    'relation'=>$request->relation,
                    'coupon'=>$request->coupon,
                    'total_price'=>$request->total_price,
                    'user_id'=>auth()->user()->id
                ]);

            if($request->has('visa')){

                foreach($request->visa as $visa){
                // dd(array_key_exists('shengen_visa_image',$visa));
                if(array_key_exists('shengen_visa_image',$visa)){

                    if(array_key_exists('family_id_image',$visa)){
                        VisaInformation::create([
                            'first_name'=>$visa['first_name'],
                            'last_name'=>$visa['last_name'],
                            'passport_image'=>$this->saveImage($visa['passport_image'], 'visa'),
                            'national_image'=>$this->saveImage($visa['national_image'], 'visa'),
                            'social_status'=>$visa['social_status'],
                            'shengen_visa_image'=>$this->saveImage($visa['shengen_visa_image'], 'visa')  ?? null,
                            // 'bank_statment_image'=>$this->saveImage($visa['bank_statment_image'], 'visa'),
                            // 'job_letter_image'=>$this->saveImage($visa['job_letter_image'], 'visa'),
                            'family_id_image'=>$this->saveImage($visa['family_id_image'], 'visa') ?? null,
                            'visa_id'=>$visaa->id,
                        ]);
                    }else{
                        VisaInformation::create([
                            'first_name'=>$visa['first_name'],
                            'last_name'=>$visa['last_name'],
                            'passport_image'=>$this->saveImage($visa['passport_image'], 'visa'),
                            'national_image'=>$this->saveImage($visa['national_image'], 'visa'),
                            'social_status'=>$visa['social_status'],
                            'shengen_visa_image'=>$this->saveImage($visa['shengen_visa_image'], 'visa')  ?? null,
                            // 'bank_statment_image'=>$this->saveImage($visa['bank_statment_image'], 'visa'),
                            // 'job_letter_image'=>$this->saveImage($visa['job_letter_image'], 'visa'),
                            // 'family_id_image'=>$this->saveImage($visa['family_id_image'], 'visa') ?? null,
                            'visa_id'=>$visaa->id,
                        ]);
                    }

                }else{
                    if(array_key_exists('family_id_image',$visa)){
                        VisaInformation::create([
                            'first_name'=>$visa['first_name'],
                            'last_name'=>$visa['last_name'],
                            'passport_image'=>$this->saveImage($visa['passport_image'], 'visa'),
                            'national_image'=>$this->saveImage($visa['national_image'], 'visa'),
                            'social_status'=>$visa['social_status'],
                            // 'bank_statment_image'=>$this->saveImage($visa['bank_statment_image'], 'visa'),
                            // 'job_letter_image'=>$this->saveImage($visa['job_letter_image'], 'visa'),
                            'family_id_image'=>$this->saveImage($visa['family_id_image'], 'visa') ?? null,
                            'visa_id'=>$visaa->id,
                        ]);
                    }else{
                        VisaInformation::create([
                            'first_name'=>$visa['first_name'],
                            'last_name'=>$visa['last_name'],
                            'passport_image'=>$this->saveImage($visa['passport_image'], 'visa'),
                            'national_image'=>$this->saveImage($visa['national_image'], 'visa'),
                            'social_status'=>$visa['social_status'],
                            // 'bank_statment_image'=>$this->saveImage($visa['bank_statment_image'], 'visa'),
                            // 'job_letter_image'=>$this->saveImage($visa['job_letter_image'], 'visa'),
                            // 'family_id_image'=>$this->saveImage($visa['family_id_image'], 'visa') ?? null,
                            'visa_id'=>$visaa->id,
                        ]);
                    }
                }
                }
            }

            if($request->hasFile('bank_statment_image')){

                if($request->hasFile('job_letter_image')){
                    $visaa->update([
                        'sponsor_name'=>$request->sponsor_name,
                        'bank_statment_image'=>$this->saveImage($request->bank_statment_image, 'visa'),
                        'job_letter_image'=>$this->saveImage($request->job_letter_image, 'visa'),

                    ]);
                }else{
                    $visaa->update([
                        'sponsor_name'=>$request->sponsor_name,
                        'bank_statment_image'=>$this->saveImage($request->bank_statment_image, 'visa'),
                        // 'job_letter_image'=>$this->saveImage($request->job_letter_image, 'visa'),

                    ]);
                }

            }

            if($request->hasFile('job_letter_image')){

                if($request->hasFile('bank_statment_image')){
                    $visaa->update([
                        'sponsor_name'=>$request->sponsor_name,
                        'bank_statment_image'=>$this->saveImage($request->bank_statment_image, 'visa'),
                        'job_letter_image'=>$this->saveImage($request->job_letter_image, 'visa'),

                    ]);
                }else{
                    $visaa->update([
                        'sponsor_name'=>$request->sponsor_name,
                        // 'bank_statment_image'=>$this->saveImage($request->bank_statment_image, 'visa'),
                        'job_letter_image'=>$this->saveImage($request->job_letter_image, 'visa'),

                    ]);
                }

            }

            if(!$request->hasFile('bank_statment_image') && !$request->hasFile('job_letter_image')){
                $visaa->update([
                    'sponsor_name'=>$request->sponsor_name,
                ]);
            }

            DB::commit();
            DB::rollBack();

            return $this->returnData('data','','success');
        }
    }



    public function visas(){
        // $visa_information=VisaInformation::all();
        // return $this->returnData('data',VisaInformationResource::collection($visa_information),'Done');


        $visa_information=VisaInformation::paginate(15);
        // return $this->returnData('data',$visa_information,'Done');
        return VisaInformationResource::collection($visa_information)->additional([ 'status' => true,
            'errNum' => "S000",
            'msg' => 'Done']);

    }



    public function visa($visa_information_id){

        $visa=VisaInformation::find($visa_information_id);
        if($visa == null){
            return $this->returnError(788,'please check id');
        }
        return $this->returnData('data',new VisaInformationResource($visa),'Done');
    }


    public function visaRequests(){
        $visa=visa::where('user_id',auth()->user()->id)->get();
        // $visa_information=VisaInformation::where('visa_id',$visa->id)->get();

        return $this->returnData('data',VisaResource::collection($visa),'Done');
    }

    public function visaInformation($visa_id){
        $visa_information=VisaInformation::where('visa_id',$visa_id)->first();
        return $this->returnData('data',new VisaInformationResource($visa_information),'Done');

    }

    public function acceptVisa($visa_id){

        $visa=Visa::find($visa_id);
        // dd($visa);
        if($visa == null){
            return $this->returnError(506,'please check the id');
        }

        $visa->update([
            'status'=>'accepted',
        ]);
        return $this->returnData('data','visa status chaged successfully','Done');
    }


    public function rejectVisa($visa_id){

        $visa=Visa::find($visa_id);
        // dd($visa);
        if($visa == null){
            return $this->returnError(506,'please check the id');
        }

        $visa->update([
            'status'=>'rejected',
        ]);
        return $this->returnData('data','visa status chaged successfully','Done');
    }

    public function changeStatus(Request $request,$visa_id){

        $visa=Visa::find($visa_id);
        if($visa == null){
            return $this->returnError(767,'please check the id');
        }

        $visa->update([
            'status'=>$request->status
        ]);

        return $this->returnData('data','','the status changed successfully');
    }

}
