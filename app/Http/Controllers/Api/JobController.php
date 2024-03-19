<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job; 

class JobController extends Controller
{
    public function list()
    {
        $jobs = Job::all();
        $list = [];

        foreach ($jobs as $job) {
            $object = [
                "id" => $job->id,
                "jobs" => $job->jobs, 
                "description" => $job->description
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id)
    {
        $job = Job::where('id','=',$id)->first();

        $object = [
            "id" => $job->id,
            "jobs" => $job->jobs,
            "description" => $job->description
        ];

        return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'jobs' => 'required',
            'description' => 'required',
        ]);

        $job = Job::create([
            'jobs' => $data['jobs'],
            'description' => $data['description'],
        ]);

        if ($job) {
            return response()->json([
                'message' => 'Successful',
                'data' => $job,
            ]);
        } else {
            return response()->json([
                'message' => 'Error!!!',
            ]);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'jobs' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:30',
        ]);

        $job = Job::where('id', '=', $data['id'])->first();

        if ($job) {
            $old = $job;
            $job->jobs = $data['jobs'];

            if ($job->save()) {
                $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $job,
                ];
                return response()->json($object);
            } else {
                $object = [
                    "response" => "Error: algo fue mal, por favor intenta de nuevo.",
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

