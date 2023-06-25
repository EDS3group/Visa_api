<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProblemTicketResource;
use App\Models\ProblemTicket;
use App\Models\TicketReply;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProblemTicketController extends Controller
{
    use GeneralTrait;
    public function makeTicket(Request $request){
        $validator=Validator::make($request->all(),[
            'message'=>'required',
            'topic'=>'required',
            'subject'=>'required'
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{

            ProblemTicket::create([
                'message'=>$request->message,
                'topic'=>$request->topic,
                'subject'=>$request->subject,
                'user_id'=>auth()->user()->id
            ]);

            return $this->returnData('data','the suport will reply to your message soon');
        }
    }


    public function userReply(Request $request,$problem_ticket_id){
        $validator=Validator::make($request->all(),[
            'message'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            $problem_ticket=ProblemTicket::find($problem_ticket_id);
            if($problem_ticket == null){
                return $this->returnError(909,'please check the ticket id');
            }
            TicketReply::create([
                'message'=>$request->message,
                'problem_ticket_id'=>$problem_ticket_id,
                'sender_type'=>'User',
                'sender_id'=>auth()->user()->id
            ]);

            return $this->returnData('data','','reply sent successfully');
        }
    }


    public function adminReply(Request $request,$problem_ticket_id){
        $validator=Validator::make($request->all(),[
            'message'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            $problem_ticket=ProblemTicket::find($problem_ticket_id);
            if($problem_ticket == null){
                return $this->returnError(909,'please check the ticket id');
            }
            TicketReply::create([
                'message'=>$request->message,
                'problem_ticket_id'=>$problem_ticket_id,
                'sender_type'=>'Admin',
                'sender_id'=>auth()->user()->id
            ]);

            return $this->returnData('data','','reply sent successfully');
        }
    }

    public function getProbemTickets(){
        $problem_tickets=ProblemTicket::where('status','open')->get();
        return $this->returnData('data',ProblemTicketResource::collection($problem_tickets),'Done');
    }

    public function closeTicket($problem_ticket_id){
        $problem_ticket=ProblemTicket::find($problem_ticket_id);
        if($problem_ticket == null){
            return $this->returnError(909,'please check the ticket id');
        }
        $problem_ticket->update([
            'status'=>'closed',
        ]);

        return $this->returnData('data','','the ticket closed successfully');
    }
}
