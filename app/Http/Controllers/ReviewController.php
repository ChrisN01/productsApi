<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService=$reviewService;

        $this->middleware('auth:api');
        $this->middleware('product.owner')->only(['update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request, Product $product)
    {

       $review = $this->reviewService->createReview($product, $request->validated());

       return response(new ReviewResource($review), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Review $review)
    {
        if ($review->product_id !== $product->id) {

            return response(['error' => 'Review does not belong to this product.'], Response::HTTP_NOT_FOUND);
        }

        return new ReviewResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request,Product $product, Review $review)
    {
        $updatedReview= $this->reviewService->updateReview($review, $request->validated());

        /*return response([
        
            'data'=> new ReviewResource($updatedReview)
        ], Response::HTTP_CREATED);*/
        return response(new ReviewResource($updatedReview), Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {

        $this->reviewService->deleteReview($review);

        return response(null,Response::HTTP_NO_CONTENT);
    }
}
