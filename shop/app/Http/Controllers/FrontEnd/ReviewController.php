<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function send(Request $request)
    {
        $user = Auth::guard('frontend')->user();
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $file = app(UploadService::class)->store($request, "image", "review");
        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->review,
        ]);
        if (!empty($file["url"])) {
            ReviewImage::create([
                'review_id' => $review->id,
                'path' => $file["url"],
            ]);
        }
        return back()->with([
            'success' => 'Đánh giá của bạn đã được gửi đi',
        ]);
    }
}
