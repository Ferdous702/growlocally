<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactInquiryRequest;
use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;

class ContactInquiryController extends Controller
{
    public function store(StoreContactInquiryRequest $request): JsonResponse
    {
        ContactInquiry::create($request->validated());

        return response()->json(['message' => 'Your message has been sent successfully.'], 201);
    }
}
