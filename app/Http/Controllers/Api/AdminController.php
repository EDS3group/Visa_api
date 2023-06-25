<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\PassportResource;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Passport;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\LinesOfCode\Counter;

class AdminController extends Controller
{
    use GeneralTrait;

    public function contactMessage(){
        $contacts=ContactUs::orderBy('created_at','desc')->get();
        return $this->returnData('data',ContactUsResource::collection($contacts),'Done');
    }

    public function message($message_id){
        $contact=ContactUs::find($message_id);
        return $this->returnData('data',new ContactUsResource($contact),'Done');

    }


    public function passport($passport_id){
        $passport=Passport::find($passport_id);
        if($passport == null){
            return $this->returnError(404,'not found');
        }

        return $this->returnData('data',new PassportResource($passport),'Done');
    }


    public function addCountry(Request $request){
        $validator=Validator::make($request->all(),[
            'name_en'=>'require|unique:countries,name_en',
            'name_ar'=>'require|unique:countries,name_ar',
            'value_en'=>'require',
            'value_ar'=>'require',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            if($request->has('country')){

                foreach($request->country as $country)
            // dd($country);
                Country::create([
                    'name_en'=>$country['name_en'],
                    'name_ar'=>$country['name_ar'],
                    'value_en'=>$country['value_en'],
                    'value_ar'=>$country['value_ar'],
                    'code'=>$country['code']
                ]);

                return $this->returnData('data','','Done');
            }

        }
    }
}
