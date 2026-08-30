<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'website' => 'nullable|string|max:255', // honeypot
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Honeypot check
        if ($request->filled('website')) {
            return response()->json(['success' => true], 200);
        }

        // Send email
        try {
            Mail::raw(
                "Name: {$request->name}
Email: {$request->email}
Subject: {$request->subject}

Message:
{$request->message}",
                function ($message) use ($request) {
                    $message->to('hello@chadadigital.com')
                            ->subject("Contact Form: {$request->subject}")
                            ->replyTo($request->email, $request->name);
                }
            );

            return response()->json([
                'success' => true,
                'message' => 'Thank you! We will reply within 24 hours.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please email us directly at hello@chadadigital.com',
            ], 500);
        }
    }
}
