<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;

class SportController extends Controller
{
    public function index(){
        try{
            $sports = Sport::all();
            if(count($sports) == 0) {
                return response()->json();
            }
            return response()->json([
                'sports' => $sports,          
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

            $sports = Sport::create([
            'name'=>$request->name,
            'description'=>$request->description,
            ]);

            return response()->json([
                'message'=>'Sport created successfully'
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $sport = Sport::find($id);

            if(!$sport){
                return response()->json([
                    'error'=>'Sport not found'
                ],404);
            }

            $sport->update($request->all());

            return response()->json([
                'message' => 'Sport update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $sport = Sport::find($id);
            if(!$sport){
                return response()->json([
                    'error' =>'Sport not found',
                ],404);    
            }

            Sport::destroy($id);

            return response()->json([
                'message' => 'Sport deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
