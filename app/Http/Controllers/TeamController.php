<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index(){
        try{
            $teams = Team::all();
            
            foreach ($teams as $team) {
                $team->average = Player::where('team_id',$team->id)->avg('level');
            }

            if(count($teams) == 0) {
                return response()->json();
            }
            return response()->json([
                'teams' => $teams,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try{       
            $request->validate([
            'name'=>'required|string',
            'sport_id'=>'required|integer',
            'trainer_id'=>'required|integer',
            ]);

            $user = auth()->user();
            $teams = Team::all();

            foreach ($teams as $team) {
                if (($user->hasRole('manager')) && ($team->user_id == $user->id)){
                    // dd(auth()->user()->hasRole('manager'));
                    return response()->json([
                        'message'=>'Manager already has a team'
                    ]);
                }
            }  

            $teams = Team::create([
            'name'=>$request->name,
            'sport_id'=>$request->sport_id,
            'trainer_id'=>$request->trainer_id,
            'user_id'=>$user->id,
            ]);

            return response()->json([
                'message'=>'Team created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            // dd(auth()->user()->id);
            $user_id = auth()->user()->id;
            $team = Team::find($id);

            if(!$team){
                return response()->json([
                    'error'=>'Team not found'
                ],404);
            } 
            
            if($user_id == $team->id){
                $team->update($request->all());
            } else {
                return response()->json([
                    'message'=>'Only manager can edit'
                ],404);
            }

            return response()->json([
                'message' => 'Team update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $team = Team::find($id);
            if(!$team){
                return response()->json([
                    'error' =>'Team not found',
                ],404);    
            }

            Team::destroy($id);

            return response()->json([
                'message' => 'Team deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }    
}
