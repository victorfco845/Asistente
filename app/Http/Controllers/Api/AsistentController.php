<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistent;
use App\Models\User;
use App\Models\Companie;
use App\Models\Petition;
use App\Models\Job;
use App\Models\Review;
use App\Models\Profile;


class AsistentController extends Controller
{
    public function index()
    {
        $asistents = Asistent::with(['user', 'job','profile'])
            ->get();

        $asistentsList = $asistents->map(function ($asistent) {
            return [
                'id' => $asistent->id,
                'user' => [
                    'name' => $asistent->user->name,
                    'email' => $asistent->user->email,
                ],
                'job' => [
                    'jobs' => $asistent->job->jobs,
                    'description' => $asistent->job->description,
                ],
                'profile' => [
                    'exp_job' => $asistent->profile->exp_job,
                ],
            ];
        });

        return response()->json($asistentsList);
    }

    

    public function show($id)
{
    $asistent = Asistent::with(['user', 'job'])->find($id);

    if (!$asistent) {
        return response()->json(['error' => 'Asistent not found'], 404);
    }

    $asistentData = [
        'id' => $asistent->id,
        'user' => [
            'name' => $asistent->user->name,
            'email' => $asistent->user->email,
        ],
        'job' => [
            'jobs' => $asistent->job->jobs,
            'description' => $asistent->job->description,
        ],
        'profile' => [
            'exp_job' => $asistent->profile->exp_job,
        ],
    ];

    return response()->json($asistentData);
}

public function update(Request $request, $id)
{
    $asistent = Asistent::find($id);

    if (!$asistent) {
        return response()->json(['error' => 'Asistent not found'], 404);
    }

$validatedData = $request->validate([
    'user.name' => 'required|string|max:255',
    'user.email' => 'required|email|max:255',
    'job.jobs' => 'required|string|max:255',
    'job.description' => 'required|string|max:255',
    'profile.exp_job' => 'required|string|max:255',
]);


$asistent->user->name = $validatedData['user']['name'];
$asistent->user->email = $validatedData['user']['email'];
$asistent->user->save();

$asistent->job->jobs = $validatedData['job']['jobs'];
$asistent->job->description = $validatedData['job']['description'];
$asistent->job->save();
$asistent->profile->exp_job = $validatedData['profile']['exp_job'];
$asistent->profile->save();

    return response()->json(['message' => 'Asistent updated successfully']);
}

public function updateReview(Request $request, $id)
{
    $asistent = Asistent::find($id);

    if (!$asistent) {
        return response()->json(['error' => 'Asistent not found'], 404);
    }

    // Validar los datos recibidos
    $validatedData = $request->validate([
        'review.review' => 'required|string|max:255',
        'review.calification' => 'required|integer|between:1,5',
    ]);

    // Actualizar la revisión y la calificación del asistente
    $asistent->review->review = $validatedData['review']['review'];
    $asistent->review->calification = $validatedData['review']['calification'];
    $asistent->review->save();

    // Devolver la respuesta
    return response()->json(['message' => 'Review updated successfully']);
}



    // Dentro del modelo Asistent
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function companie()
    {
        return $this->belongsTo(Companie::class);
    }

    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
