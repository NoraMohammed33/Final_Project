<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRatingRequest;
use App\Http\Requests\UpdateServiceRatingRequest;
use App\Models\ServiceRating;
use Illuminate\Support\Facades\Auth;

class ServiceRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all service ratings
        $serviceRatings = ServiceRating::all();

        // Return a response
        return response()->json($serviceRatings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRatingRequest $request)
    {
        // Create a new rating record
        $rating = new ServiceRating();
        $rating->service_id = $request->input('service_id');
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment');
        $rating->user_id = Auth::id();
        $rating->save();

        // Return a response
        return response()->json(['message' => 'Rating submitted successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceRating $serviceRating)
    {
        // Return the specific service rating
        return response()->json($serviceRating);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceRating $serviceRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRatingRequest $request, ServiceRating $serviceRating)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Update the rating record
        $serviceRating->rating = $validatedData['rating'];
        $serviceRating->comment = $validatedData['comment'];
        $serviceRating->save();

        // Return a response
        return response()->json(['message' => 'Rating updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRating $serviceRating)
    {
        // Delete the rating record
        $serviceRating->delete();

        // Return a response
        return response()->json(['message' => 'Rating deleted successfully']);
    }
}
