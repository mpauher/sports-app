<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index(){
        try{
            $positions = Position::all();
            if(count($positions) == 0) {
                return response()->json();
            }
            return response()->json([
                'positions' => $positions,          
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
            'description'=>'required|string',
            ]);

            $positions = Position::create([
            'name'=>$request->name,
            'description'=>$request->description,
            ]);

            return response()->json([
                'message'=>'position created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $position = Position::find($id);

            if(!$position){
                return response()->json([
                    'error'=>'Position not found'
                ],404);
            }

            $position->update($request->all());

            return response()->json([
                'message' => 'Position update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $position = Position::find($id);
            if(!$position){
                return response()->json([
                    'error' =>'Position not found',
                ],404);    
            }

            Position::destroy($id);

            return response()->json([
                'message' => 'Position deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
