<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index(){
        try{
            $players = Player::all();
            if(count($players) == 0) {
                return response()->json();
            }
            return response()->json([
                'players' => $players,          
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
            'lastname'=>'required|string',
            'email'=>'required|string',
            'age'=>'required|integer',
            'level'=>'required|integer',
            'position_id'=>'required|integer',
            'team_id'=>'required|integer',
            ]);

            $players = Player::create([
            'name'=>$request->name,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'age'=>$request->age,
            'level'=>$request->level,
            'position_id'=>$request->position_id,
            'team_id'=>$request->team_id,
            ]);

            return response()->json([
                'message'=>'Player created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $player = Player::find($id);

            if(!$player){
                return response()->json([
                    'error'=>'Player not found'
                ],404);
            }

            $player->update($request->all());

            return response()->json([
                'message' => 'Player update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $player = Player::find($id);
            if(!$player){
                return response()->json([
                    'error' =>'Player not found',
                ],404);    
            }

            Player::destroy($id);

            return response()->json([
                'message' => 'Player deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
