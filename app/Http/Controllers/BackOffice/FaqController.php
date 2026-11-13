<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function FaqPage()
    {
        return view('client.faqs');
    }

    public function EditSettings()
    {
        $settings = FaqSetting::current();

        return view('admin.backOffice.faq.edit_faq_settings', compact('settings'));
    }

    public function UpdateSettings(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        FaqSetting::current()->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
        ]);

        return redirect()->back()->with([
            'message' => 'FAQ settings have been updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function AddFaq()
    {
        $nextOrder = (int) Faq::max('sort_order') + 1;

        return view('admin.backOffice.faq.add_faq', compact('nextOrder'));
    }

    public function StoreFaq(Request $request)
    {
        $validated = $this->validateFaq($request);

        $validated['sort_order'] = $request->filled('sort_order')
            ? (int) $request->sort_order
            : ((int) Faq::max('sort_order') + 1);
        $validated['is_active'] = $request->boolean('is_active');

        Faq::create($validated);

        return redirect()->route('faq.index')->with([
            'message' => 'FAQ has been added successfully',
            'alert-type' => 'success',
        ]);
    }

    public function IndexOfFaqs()
    {
        $faqs = Faq::query()->ordered()->get();

        return view('admin.backOffice.faq.index_faq', compact('faqs'));
    }

    public function EditFaq($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.backOffice.faq.edit_faq', compact('faq'));
    }

    public function UpdateFaq(Request $request)
    {
        $validated = $this->validateFaq($request);

        $validated['sort_order'] = $request->filled('sort_order')
            ? (int) $request->sort_order
            : 0;
        $validated['is_active'] = $request->boolean('is_active');

        Faq::findOrFail($request->id)->update($validated);

        return redirect()->route('faq.index')->with([
            'message' => 'FAQ has been updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function DeleteFaq($id)
    {
        Faq::findOrFail($id)->delete();

        return redirect()->back()->with([
            'message' => 'FAQ has been deleted successfully',
            'alert-type' => 'success',
        ]);
    }

    private function validateFaq(Request $request): array
    {
        return $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
