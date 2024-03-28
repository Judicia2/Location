<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Voiture;
class VoitureController extends Controller
{
    //

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'numero_V' => 'required|max:255',
            'marque' => 'required|max:255',
            'modele' => 'required|max:255',
            'prix' => 'required| numeric',
            'photo_Voitures' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required | max:255',
            
        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        else {
            $voiture = new Voiture();

            $voiture->numero_V = $request->input('numero_V');
            $voiture->marque = $request->input('marque');
            $voiture->modele = $request->input('modele');
            $voiture->prix = $request->input('prix');
            $voiture->status = $request->input('status');
            
            if ($request->hasFile('photo_Voitures')) {
                $file = $request->file('photo_Voitures');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/product/', $filename);
                $voiture->photo_Voitures = 'uploads/product/' . $filename;
            }
            
            $voiture->save();

            return response() ->json([
                'status' => 200,
                'message' => 'Voiture est ajouté avec success',
            ]);
        }

    }

    public function show() {
        $voiture = Voiture::all();
        return response()->json($voiture);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'numero_V' => 'required|max:255',
            'marque' => 'required|max:255',
            'modele' => 'required|max:255',
            'prix' => 'required| numeric',
            'photo_Voitures' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required | max:255',
            

        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        try{
            $voiture = Voiture::findorFail($id);
    
            $voiture->numero_V = $request->input('numero_V');
            $voiture->marque = $request->input('marque');
            $voiture->modele = $request->input('modele');
            $voiture->prix = $request->input('prix');
            $voiture->status = $request->input('status');
            if ($request->hasFile('photo_Voitures')) {
                $file = $request->file('photo_Voitures');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/product/', $filename);
                $voiture->photo_Voitures = 'uploads/product/' . $filename;
            }
            
            $voiture->save();

            return response()->json([
                'status' => 200,
                'message' => 'Voiture update successfully',
                'voiture' => $voiture,
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
            $voiture = Voiture::findorFail($id);
            $voiture -> delete();
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
