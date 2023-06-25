<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookMatch;
use App\Models\Team;
use App\Models\TeamMatch;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    use GeneralTrait;

    public function bookMatch(Request $request){
        $validator=Validator::make($request->all(),[
            'applicant_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'match_id'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{

            $match=TeamMatch::find($request->match_id);
            // dd($team);
            if($match == null){
                return $this->returnError(878,'please check the match id');
            }

            BookMatch::create([
                'applicant_name'=>$request->applicant_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'match_id'=>$request->match_id,
            ]);

            return $this->returnData('data','','success');

        }
    }

    public function matchTicketsBooked($match_id){
        $match=TeamMatch::find($match_id);
        // dd($team);
        if($match == null){
            return $this->returnError(878,'please check the match id');
        }

        $tickets=BookMatch::where('match_id',$match_id)->with('match')->get();
        // dd($tickets);

        return $this->returnData('data',['tickets'=>$tickets,'tickets_count'=>$tickets->count()],'done');

    }
}
