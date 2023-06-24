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
        //
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
        // Validate the request data
        $validatedData = $request->validate([
            'service_id' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Create a new rating record
        $rating = new ServiceRating();
        $rating->service_id = $validatedData['service_id'];
        $rating->rating = $validatedData['rating'];
        $rating->comment = $validatedData['comment'];
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRating $serviceRating)
    {
        //
    }
}
