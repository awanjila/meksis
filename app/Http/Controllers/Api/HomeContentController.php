<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\About;
use App\Models\BackOffice\HomeSlider;
use Illuminate\Http\JsonResponse;

class HomeContentController extends Controller
{
    public function slides(): JsonResponse
    {
        $slides = HomeSlider::query()
            ->orderBy('id')
            ->get()
            ->map(fn (HomeSlider $slide) => [
                'id' => $slide->id,
                'title' => $slide->title,
                'description' => $slide->short_description,
                'image' => $this->imageUrl($slide->home_slide),
            ]);

        return response()->json(['slides' => $slides]);
    }

    public function about(): JsonResponse
    {
        $about = About::query()->first();
        $defaults = config('home_content.about');

        $value = fn (string $field) => $about?->{$field} ?? $defaults[$field];

        return response()->json([
            'section_label' => $value('section_label'),
            'headline' => $value('headline'),
            'highlight_word' => $value('highlight_word'),
            'paragraph_one' => $value('paragraph_one'),
            'paragraph_two' => $value('paragraph_two'),
            'image' => $this->imageUrl($about?->image) ?? $this->imageUrl($defaults['image']),
            'stats' => [
                [
                    'number' => $value('stat_one_number'),
                    'label' => $value('stat_one_label'),
                ],
                [
                    'number' => $value('stat_two_number'),
                    'label' => $value('stat_two_label'),
                ],
            ],
        ]);
    }

    private function imageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}
