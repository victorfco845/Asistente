<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petition;
class PetitionController extends Controller
{
    public function list(){
        $petitions = Petition::all();
        $list = [];

        foreach($petitions as $petition){

            $object= [
                "id" => $petition->id,
                "petition" =>$petition->petition,
                "friend" =>$petition->friend,
                "created" =>$petition->created_at,
                "updated"=>$petition->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id){
        $petition = Petition::where('id','=',$id)->first();

        $object = [
            "id" => $petition->id,
            "petition" => $petition->petition,
            "friend" =>$petition->friend,
            "created"=> $petition ->created_at,
            "updated" => $petition->updated_at
             
        ];

        return response()->json($object);
    }

    public function create(Request $request ){

        $data = $request->validate([
            'petition' => 'required',
            'friend'=> 'required',
        ]);

        $petition=Petition::create ([
            'petition'=>$data['petition'],
            'friend'=>$data['friend'],
        ]);

        if($petition){
            return respon()->json([

                'message' => 'petitions for search jobs',
                'data'=> $petition,
            ]);
        }else{
            message:'Error!!!';
        }
    }



    public function update(Request $request) {
        $data = $request->validate([
        'id'=>'required|integer|min:1',
        'petition'=>'required|min:3|max:30',
        'friend'=>'required|min:3|max:30',
        ]);
        $petition = Petition::where('id', '=', $data['id'])->first();
        if($petition) {
        $old = $petition;
        $petition->petition = $data['petition'];
        if ($petition->Save()) {
        $object = [
        "response" => "Éxito: registro modificado
        correctamente.",
        "data" => $petition,
        ];
        return response()->json($object);
        } else {
        $object = [
        "response" => "Error: algo fue mal, porfavor intenta de nuevo.",
        ];
        return response()->json($object);
        }
        } else {
        $object = [
        "response" => "Error: registro no encontrado.",
        ];
        return response()->json($object);
        }
    }


}