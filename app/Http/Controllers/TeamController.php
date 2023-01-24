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
            'trainer_id'=>'required|integer'
            ]);

            $user = auth()->user();
            if($user->hasRole('admin')){
                $request->validate([
                    'user_id'=>'required|integer',
                ]);

                Team::create([
                    'name'=>$request->name,
                    'sport_id'=>$request->sport_id,
                    'trainer_id'=>$request->trainer_id
                ]);
                
            }else if($user->hasRole('manager')){
                $team = Team::where('user_id',$user->id)->first();

                if (! $team){
                    Team::create([
                        'name'=>$request->name,
                        'sport_id'=>$request->sport_id,
                        'trainer_id'=>$request->trainer_id,
                        'user_id'=>$user->id
                    ]);
                    
                }else{
                    return response()->json([
                        'message'=>'Manager already has a team'
                    ], 403);
                }
            }
             
            return response()->json([
                'message'=>'Team created successfully'
            ],200);
            
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            // dd(auth()->user()->id);
            $user = auth()->user();
            $team = Team::find($id);

            if(!$team){
                return response()->json([
                    'error'=>'Team not found'
                ],404);
            } 
            
            if($user->id == $team->id || $user->hasRole('admin')){
                $team->update($request->all());
                return response()->json([
                    'message' => 'Team update succesfully',
                ],200);
            } else {
                return response()->json([
                    'message'=>'Manager only can edit his team'
                ],403);
            }
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
