<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselItemsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CarouselItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Show data based on logged user
        $carouselItems = CarouselItems::where('user_id', $request->user()->id);

        // Cater Search use "keyword"
        if ($request->keyword) {
            $carouselItems->where(function ($query) use ($request) {
                $query->where('carousel_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        // Pagination based on number set; You can change the number below
        return $carouselItems->paginate(3);

        // Show all date; Uncomment if necessary
        // return CarouselItems::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(CarouselItemsRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Store in carousel folder the image
        $validated['image_path'] = $request->file('image_path')->storePublicly('carousel', 'public');

        $carouselItem = CarouselItems::create($validated);

        return $carouselItem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CarouselItems::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CarouselItemsRequest $request, string $id)
    {
        $validated = $request->validated();

        // Upload Image to Backend and Store Image Path
        $validated['image_path'] = $request->file('image_path')->storePublicly('carousel', 'public');

        // Get Info by Id 
        $carouselItem = CarouselItems::findOrFail($id);

        // Delete Previous Image
        if (!is_null($carouselItem->image_path)) {
            Storage::disk('public')->delete($carouselItem->image_path);
        }

        // Update New Info
        $carouselItem->update($validated);

        return $carouselItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carouselItem = CarouselItems::findOrFail($id);

        if (!is_null($carouselItem->image_path)) {
            Storage::disk('public')->delete($carouselItem->image_path);
        }

        $carouselItem->delete();

        return $carouselItem;
    }
}
