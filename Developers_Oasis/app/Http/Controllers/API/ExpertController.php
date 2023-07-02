<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Http\Resources\ExpertResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class ExpertController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $searchInput = $request->input('search');

    //     $postsQuery = $searchInput
    //         ? Post::where('title', 'like', '%' . $searchInput . '%')
    //         ->orWhere('body', 'like', '%' . $searchInput . '%')
    //         : Post::query();

    //     $posts = $postsQuery->paginate(5);

    //     return response()->json([
    //         "status" => 'success',
    //         'message' => 'Posts fetched successfully.',
    //         'posts' => $posts,
    //         'loggeduser' => $user
    //     ]);
    // }
public function index(): JsonResponse
{
$experts = Expert::with('department', 'user', 'services')->get();
return response()->json($experts);
}

public function store(Request $request): JsonResponse
{
$user = User::create([
'name' => $request->input('name'),
'email' => $request->input('email'),
'password' => bcrypt($request->input('password')),
]);

$expert = Expert::create([
'dept_id' => $request->input('dept_id'),
'bio' => $request->input('bio'),
'user_id' => $user->id,
]);

return response()->json($expert, 201);
}

    public function show($id): JsonResponse
    {
        $expert = Expert::with('user', 'department', 'services')->findOrFail($id);
        return response()->json(['expert' => $expert]);
    }


public function update(Request $request, $id): JsonResponse
{
$expert = Expert::findOrFail($id);
$expert->update($request->all());
return response()->json($expert);
}

public function destroy($id): JsonResponse
{
$expert = Expert::findOrFail($id);
$expert->delete();
return response()->json(null, 204);
}
}
