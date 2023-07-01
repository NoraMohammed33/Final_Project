<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
public function user(): JsonResponse
{
// Retrieve user data
$user = User::findOrFail(auth()->user()->id);

// Return the user data as a JSON response
return response()->json($user);
}

public function expert(): JsonResponse
{
// Retrieve expert data with services relationship
$expert = Expert::with('services')->where('user_id', auth()->user()->id)->firstOrFail();

// Return the expert data as a JSON response
return response()->json($expert);
}
}
