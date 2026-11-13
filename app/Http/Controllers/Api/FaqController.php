<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->only('limit'), [
            'limit' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $settings = FaqSetting::current();

        $query = Faq::query()->active()->ordered();

        if (isset($validated['limit'])) {
            $query->limit((int) $validated['limit']);
        }

        return response()->json([
            'title' => $settings->title,
            'subtitle' => $settings->subtitle,
            'faqs' => $query->get(['id', 'question', 'answer']),
        ]);
    }
}
