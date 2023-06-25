<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    use GeneralTrait;

    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required',
            'terms'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            $data=$request->all();
            if($data['terms'] == 1){
                $user=User::create([
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'phone'=>$data['phone'],
                    'terms'=>$data['terms'],
                    'email'=>$data['email'],
                    'password'=>Hash::make($data['password']),
                ]);
                $token=$user->createToken('token')->plainTextToken;
                $user->save();

               return $this->returnData('data',['token'=>$token,'user_information'=>new UserResource($user)],'registerd successfully');
            }else{
                return $this->returnError(402,'please check terms');
            }
        }
    }


    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            $data=$request->all();
            $user=User::where('email',$data['email'])->first();

            if(!$user || !Hash::check($data['password'],$user->password)){
                return $this->returnError(401,'invalid credentials');
            }else{
                $token =$user->createToken('token')->plainTextToken;
                return $this->returnData('data',['token'=>$token,'user_information'=>new UserResource($user)],'loged in successfully');
            }
        }
    }

    public function adminLogin(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){

            // return $this->returnData('errors',$validator->messages());
            return $this->returnError(400,$validator->messages());

        }else{
            // $data=$request->all();
            $admin=Admin::where('email',$request->email)->first();

            if(!$admin || !Hash::check($request->password,$admin->password)){
                return response(['message'=>'invalid credentials'],401);
                // return response()->json([
                //     'status'=>401,
                //     'message'=>'invalid credentials'
                //  ]);
            }else{
                $token =$admin->createToken('token')->plainTextToken;
                return $this->returnData('data',['token'=>$token]);

            }
        }
    }

}
