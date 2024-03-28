<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:255',
          
            
        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        else {
            $model = new Marque();

            $model->libelle= $request->input('libelle');
            $model->save();

            return response() ->json([
                'status' => 200,
                'message' => 'Voiture est ajouté avec success',
            ]);
        }

    }

    public function show() {
        $model = Marque::all();
        return response()->json($model);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:255',
         
            

        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        try{
            $model = Marque::findorFail($id);
    
            $model->libelle= $request->input('libelle');
          
            
            $model->save();

            return response()->json([
                'status' => 200,
                'message' => 'Voiture update successfully',
                'voiture' => $model,
            ]);
        } catch (\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'status' =>404,
                'message' =>'Fournis not find'
            ]);
        }

    }
    public function destroy($id) {
        try {
            $model = Marque::findorFail($id);
            $model -> delete();
            return response() -> json([
                'status' => 200, 
                'message' => 'voiture est suprimé avec succès'
            ]);
        } catch (\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong while deleting the Fournis',
            ]);
        }
    } 
}
