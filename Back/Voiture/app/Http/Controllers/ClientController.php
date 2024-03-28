<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    //
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'adresse' => 'required|max:255',
            'phone' => 'required| numeric',
            'email' => 'required | max:255',
            
        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        else {
            $client = new Client();

            $client->nom = $request->input('nom');
            $client->prenom = $request->input('prenom');
            $client->adresse = $request->input('adresse');
            $client->email = $request->input('email');
            $client->phone= $request->input('phone');
           
            
            $client->save();

            return response() ->json([
                'status' => 200,
                'message' => 'Voiture est ajouté avec success',
            ]);
        }

    }

  public function show() {
        $client = Client::all();
        return response()->json($client);
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'adresse' => 'required|max:255',
            'phone' => 'required| numeric',
            'email' => 'required | max:255',
            

        ]);
        if ($validator->fails()) {
            \Log::error($validator->messages());
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ]);
        }
        try{
            $client = Client::findorFail($id);
    
            $client->nom = $request->input('nom');
            $client->prenom = $request->input('prenom');
            $client->adresse = $request->input('adresse');
            $client->email = $request->input('email');
            $client->phone= $request->input('phone');
            
            $client->save();

            return response()->json([
                'status' => 200,
                'message' => 'Voiture update successfully',
                'voiture' => $client,
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
            $client = Client::findorFail($id);
            $client-> delete();
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
