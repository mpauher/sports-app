<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index(){
        try{
            $trainers = Trainer::all();
            if(count($trainers) == 0) {
                return response()->json();
            }
            return response()->json([
                'trainers' => $trainers,          
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
            ]);

            $trainers = Trainer::create([
            'name'=>$request->name,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'age'=>$request->age,
            ]);

            return response()->json([
                'message'=>'Trainer created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $trainer = Trainer::find($id);

            if(!$trainer){
                return response()->json([
                    'error'=>'Trainer not found'
                ],404);
            }

            $trainer->update($request->all());

            return response()->json([
                'message' => 'Trainer update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $trainer = Trainer::find($id);
            if(!$trainer){
                return response()->json([
                    'error' =>'Trainer not found',
                ],404);    
            }

            Trainer::destroy($id);

            return response()->json([
                'message' => 'Trainer deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
