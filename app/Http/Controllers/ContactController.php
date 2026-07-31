<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($request->filled('bot-field')) {
            return response()->json(['message' => 'Thank you!'], 200);
        }

        return response()->json(['message' => 'Message sent successfully!'], 200);
    }
}
