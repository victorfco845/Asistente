<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companie;

class CompanieController extends Controller
{
    public function list(){
        $companies = Companie::all();
        $list = [];

        foreach($companies as $companie){

            $object= [
                
                "id" => $companie->id,
                "companie" =>$companie->companie,
                "description" =>$companie->description
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
        $companie = Companie::where('id','=',$id)->first();

        $object = [
            "id" => $companie->id,
            "companie" => $companie->companie,
            "description" =>$companie->description
             
        ];

        return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'companie' => 'required',
            'description' => 'required',
        ]);

        $companie = Companie::create([
            'companie' => $data['companie'],
            'description' => $data['description'],
        ]);

        if ($companie) {
            return response()->json([
                'message' => 'Successful',
                'data' => $companie,
            ]);
        } else {
            return response()->json([
                'message' => 'Error!!!',
            ]);
        }
    }

    public function update(Request $request) {
        $data = $request->validate([
        'id'=>'required|integer|min:1',
        'companie'=>'required|min:3|max:30',
        'description'=>'required|min:3|max:30',
        ]);
        $companie = Companie::where('id', '=', $data['id'])->first();
        if($companie) {
        $old = $companie;
        $companie->companie = $data['companie'];
        if ($companie->Save()) {
        $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $companie,
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