<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Resources\Review\ReviewsResource;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ReviewsResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request, Product $product)
    {
        $form_request = $request->all();
        $form_request['user_id'] = auth()->id();
        $review = $product->reviews()->create($form_request);
        return response([new ReviewsResource($review)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            return response()->json(['errors' => 'This action is unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $review->update($request->all());
        return response(['data' => new ReviewResource($review)], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            return response()->json(['errors' => 'This action is unauthorized'], Response::HTTP_FORBIDDEN);
        }
        $review->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
