<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'voiture' => 'required|max:255',
            'client' => 'required|max:255',
            'status' => 'required|max:255',
            'prix' => 'required| numeric',
            'date_fin' => 'required | date',
            'date_debut' => 'required | date',
            
        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        else {
            $reserve = new Reservation();

            $reserve->voiture = $request->input('voiture');
            $reserve->client = $request->input('client');
            $reserve->status = $request->input('status');
            $reserve->prix = $request->input('prix');
            $reserve->date_debut = $request->input('date_debut');
            $reserve->date_fin = $request->input('date_fin');
            
            $reserve->save();

            return response() ->json([
                'status' => 200,
                'message' => 'Voiture est ajouté avec success',
            ]);
        }

    }

    public function show() {
        $reserve = Reservation::all();
        return response()->json($reserve);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'voiture' => 'required|max:255',
            'client' => 'required|max:255',
            'status' => 'required|max:255',
            'prix' => 'required| numeric',
            'date_fin' => 'required | date',
            'date_debut' => 'required | date',

        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        try{
            $reserve = Reservation::findorFail($id);
    
            $reserve->voiture = $request->input('voiture');
            $reserve->client = $request->input('client');
            $reserve->status = $request->input('status');
            $reserve->prix = $request->input('prix');
            $reserve->date_debut = $request->input('date_debut');
            $reserve->date_fin = $request->input('date_fin');
            
            $reserve->save();

            return response()->json([
                'status' => 200,
                'message' => 'Voiture update successfully',
                'voiture' => $reserve,
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
            $reserve = Reservation::findorFail($id);
            $reserve -> delete();
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
