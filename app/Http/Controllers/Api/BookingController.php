<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookingRequest;
use App\Mail\BookingConfirmation;
use App\Mail\BookingNotification;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = Booking::create([
            'name'           => $request->name,
            'business_name'  => $request->business,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'service'        => $request->service,
            'preferred_date' => $request->date,
            'preferred_time' => $request->time,
            'description'    => $request->message,
        ]);

        Mail::to($booking->email)->send(new BookingConfirmation($booking));
        Mail::to(config('mail.from.address'))->send(new BookingNotification($booking));

        return response()->json([
            'message' => 'Your booking has been received. We\'ll be in touch within one working day.',
        ], 201);
    }
}
