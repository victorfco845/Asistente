<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function getElements()
    {
        $elements = Profile::all(['id']);
        return response()->json($elements);
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('search');
    
    $results = DB::table('asistents as a')
        ->select(
            'a.id',
            'a.asistent',
            'c.companie AS companie_name',
            'p.petition AS petition_name',
            'j.jobs AS job_name',
            'r.review AS review_name',
            'pr.name AS profile_name',
            'u.name AS user_name',
            'a.created_at',
            'a.updated_at'
        )
        ->leftJoin('companies as c', 'a.companie_id', '=', 'c.id')
        ->leftJoin('petitions as p', 'a.petition_id', '=', 'p.id')
        ->leftJoin('jobs as j', 'a.job_id', '=', 'j.id')
        ->leftJoin('reviews as r', 'a.review_id', '=', 'r.id')
        ->leftJoin('profiles as pr', 'a.profile_id', '=', 'pr.id')
        ->leftJoin('users as u', 'a.user_id', '=', 'u.id')
        ->where('pr.name', 'like', "%$searchTerm%")
        ->get();

    return response()->json($results);
}


public function viewProfile($id)
{
    $profile = DB::table('asistents as a')
        ->select(
            'a.id',
            'a.asistent',
            'c.companie AS companie_name',
            'p.petition AS petition_name',
            'j.jobs AS job_name',
            'r.review AS review_name',
            'pr.name AS profile_name',
            'u.name AS user_name',
            'a.created_at',
            'a.updated_at'
        )
        ->leftJoin('companies as c', 'a.companie_id', '=', 'c.id')
        ->leftJoin('petitions as p', 'a.petition_id', '=', 'p.id')
        ->leftJoin('jobs as j', 'a.job_id', '=', 'j.id')
        ->leftJoin('reviews as r', 'a.review_id', '=', 'r.id')
        ->leftJoin('profiles as pr', 'a.profile_id', '=', 'pr.id')
        ->leftJoin('users as u', 'a.user_id', '=', 'u.id')
        ->where('a.id', $id)
        ->first();

    return response()->json($profile);
}


    public function list()
    {
        $profiles = Profile::all();
        $list = [];

        foreach ($profiles as $profile) {
            $object = [
                "id" => $profile->id,
                "name" => $profile->name,
                "exp_job" => $profile->exp_job,
                "created" => $profile->created_at,
                "updated" => $profile->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id)
    {
        $profile = Profile::findOrFail($id);

        $object = [
            "id" => $profile->id,
            "name" => $profile->name,
            "exp_job" => $profile->exp_job,
            "created" => $profile->created_at,
            "updated" => $profile->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'exp_job' => 'required'
        ]);

        $profile = Profile::create([
            'name' => $data['name'],
            'exp_job' => $data['exp_job']
        ]);

        if ($profile) {
            return response()->json([
                'message' => 'Profile created successfully',
                'data' => $profile,
            ]);
        } else {
            return response()->json(['message' => 'Error creating profile'], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|min:3|max:30',
            'exp_job' => 'required|min:3|max:30',
        ]);

        $profile = Profile::find($data['id']);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $profile->name = $data['name'];
        $profile->exp_job = $data['exp_job'];

        if ($profile->save()) {
            return response()->json(['message' => 'Profile updated successfully', 'data' => $profile]);
        } else {
            return response()->json(['message' => 'Error updating profile'], 500);
        }
    }
}
