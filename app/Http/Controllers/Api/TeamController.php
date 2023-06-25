<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Models\TeamMatch;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;


class TeamController extends Controller
{

    use GeneralTrait;
    public function addTeam(Request $request){
        $validator=Validator::make($request->all(),[
            'image'=>'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,mp4,ogx,oga,ogv,ogg,webm',
            'name_ar'=>'required',
            'name_en'=>'required',
            'type'=>'required',
            'coach'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{

            if($request->hasFile('image')){
                Team::create([
                    'image'=>$this->saveImage($request->image, 'teams'),
                    'name_ar'=>$request->name_ar,
                    'name_en'=>$request->name_en,
                    'type'=>$request->type,
                    'coach'=>$request->coach,
                    'description_ar'=>$request->description_ar,
                    'description_en'=>$request->description_en,
                ]);

                return $this->returnData('data','','team added successfully');
            }else{
                return $this->returnError('499','please add image');
            }
        }
    }


    public function getTeams(Request $request){
        $lang= $request->header('lang');

        $teams=team::select('id','image','name_'.$lang,'description_'.$lang,'type','coach','created_at')->get();
        return $this->returnData('data',$teams,'Done');
    }

    // public function getTeamsPaginated(Request $request){
    //     $lang= $request->header('lang');

    //     $teams=team::select('id','image','name_'.$lang,'description_'.$lang,'type','coach','created_at')->paginate(5);
    //     return $this->returnData('data',$teams,'Done');
    // }
    public function getTeamsPaginated(Request $request){
        $lang= $request->header('lang');

        // $teams=team::select('id','image','name_'.$lang,'description_'.$lang,'type','coach','created_at')->paginate(5);
         $teams=team::select('id','image','name_ar','description_ar','name_en','description_en','type','coach','created_at')->paginate(5);
        return $this->returnData('data',$teams,'Done');
    }


    public function getTeamById(Request $request,$team_id){
        $team=Team::find($team_id);
        if($team == null){
            return $this->returnError(404,'not found');
        }
        $lang= $request->header('lang');

        $team=Team::select('id','image','name_'.$lang,'description_'.$lang,'type','coach','created_at')->get();
        return $this->returnData('data',$team,'Done');
    }

    public function deleteTeam($team_id){
        Team::destroy($team_id);

        return $this->returnData('data','','team deleted successfully');
    }


    public function updateTeam(Request $request,$team_id){
        $team=Team::find($team_id);
        if($team == null){
            return $this->returnError(404,'not found');
        }
        if($request->hasFile('image')){
            $team->update([
                'image'=>$this->saveImage($request->image, 'teams'),
                'name_ar'=>$request->name_ar ?? $team->name_ar,
                'name_en'=>$request->name_en ?? $team->name_en,
                'type'=>$request->type ?? $team->type,
                'coach'=>$request->coach ?? $team->coach,
                'description_ar'=>$request->description_ar ?? $team->description_ar,
                'description_en'=>$request->description_en ?? $team->description_en,
            ]);

            return $this->returnData('data','','team updated successfully');
        }else{
            $team->update([
                // 'image'=>$this->saveImage($request->image, 'teams'),
                'name_ar'=>$request->name_ar ?? $team->name_ar,
                'name_en'=>$request->name_en ?? $team->name_en,
                'type'=>$request->type ?? $team->type,
                'coach'=>$request->coach ?? $team->coach,
                'description_ar'=>$request->description_ar ?? $team->description_ar,
                'description_en'=>$request->description_en ?? $team->description_en,
            ]);
            return $this->returnData('data','','team updated successfully');

        }
    }


    public function makeMatch(Request $request,$first_team,$second_team){
        $validator=Validator::make($request->all(),[
            'champion_name_ar'=>'required',
            'stadum_name_ar'=>'required',
            'champion_name_en'=>'required',
            'stadum_name_en'=>'required',
            'date'=>'required',
            'time'=>'required',
            // 'number_of_tickets',
            // 'ticket_price',
        ]);
        if($validator->fails()){
            return $this->returnError(400,$validator->messages());
        }else{
            TeamMatch::create([
                'champion_name_ar'=>$request->champion_name_ar,
                'champion_name_en'=>$request->champion_name_en,
                'first_team'=>$first_team,
                'second_team'=>$second_team,
                'stadum_name_ar'=>$request->stadum_name_ar,
                'stadum_name_en'=>$request->stadum_name_en,
                'date'=>$request->date,
                'time'=>$request->time,
                'number_of_tickets'=>$request->number_of_tickets,
                'ticket_price'=>$request->ticket_price,
            ]);

            return $this->returnData('data','','match added successfully');

        }
    }


    public function getAllMatches(Request $request){
        $lang= $request->header('lang');
        $collection = new Collection();
        $matches=TeamMatch::select('id','champion_name_'.$lang,'stadum_name_'.$lang,'first_team','second_team','date','time','number_of_tickets','ticket_price','created_at')->get();
        // dd();

        foreach($matches as $match){
            $collection->push((object)[
                'id'=>$match['id'],
                'champion_name'=>$match['champion_name_'.$lang],
                'stadum_name'=>$match['stadum_name_'.$lang],
                'first_team'=>new TeamResource(Team::find($match['first_team'])),
                'second_team'=>new TeamResource(Team::find($match['second_team'])),
                'date'=>$match['date'],
                'time'=>$match['time'],
                'number_of_tickets'=>$match['number_of_tickets'],
                'ticket_price'=>$match['ticket_price'],
                'created_at'=>$match['created_at']

              ]);
        }


        return $this->returnData('data',$collection,'Done');

    }

    public function allMatchesPaginated(Request $request){
        $lang= $request->header('lang');
        $collection = new Collection();
        $matches=TeamMatch::select('id','champion_name_'.$lang,'stadum_name_'.$lang,'first_team','second_team','date','time','number_of_tickets','ticket_price','created_at')->paginate(15);
        // dd($matches['id']);


        foreach($matches as $match){
            $collection->push((object)[
                'id'=>$match['id'],
                'champion_name'=>$match['champion_name_'.$lang],
                'stadum_name'=>$match['stadum_name_'.$lang],
                'first_team'=>new TeamResource(Team::find($match['first_team'])),
                'second_team'=>new TeamResource(Team::find($match['second_team'])),
                'date'=>$match['date'],
                'time'=>$match['time'],
                'number_of_tickets'=>$match['number_of_tickets'],
                'ticket_price'=>$match['ticket_price'],
                'created_at'=>$match['created_at']

              ]);
        }

        return $this->returnData('data',$collection,'Done');
    }



    public function getMatchById($match_id){

        $match=teamMatch::find($match_id);
        if($match == null){
            return $this->returnError(404,'not found');
        }

        return $this->returnData('data',$match,'Done');
    }

}
