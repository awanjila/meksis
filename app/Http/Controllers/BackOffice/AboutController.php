<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use App\Models\BackOffice\About;
use App\Models\PricingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class AboutController extends Controller
{
     //About PageController//
    public function AboutPage(){

        $about = About::query()->firstOrCreate([], config('home_content.about'));

        return view('admin.backOffice.about.add_about', compact('about'));

    }//endmethod

 public function UpdateAbout(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|integer',
        'title' => 'nullable|string|max:255',
        'vision' => 'nullable|string|max:255',
        'mission' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'section_label' => 'nullable|string|max:255',
        'headline' => 'nullable|string|max:255',
        'highlight_word' => 'nullable|string|max:255',
        'paragraph_one' => 'nullable|string',
        'paragraph_two' => 'nullable|string',
        'stat_one_number' => 'nullable|string|max:50',
        'stat_one_label' => 'nullable|string|max:100',
        'stat_two_number' => 'nullable|string|max:50',
        'stat_two_label' => 'nullable|string|max:100',
        'about_image' => 'nullable|image',
    ]);

    $about_id = $validated['id'];
    unset($validated['id'], $validated['about_image']);

    $about = About::findOrFail($about_id);

    if ($request->file('about_image')) {
        $image = $request->file('about_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        File::ensureDirectoryExists(public_path('upload/about_image'));
        Image::make($image)->resize(669, 499)->save(public_path('upload/about_image/' . $name_gen));

        $save_url = 'upload/about_image/' . $name_gen;
        $about->update(array_merge($validated, ['image' => $save_url]));

        $notification = array(
            'message' => 'About Page With Image has been Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } else {
        $about->update($validated);

        $notification = array(
            'message' => 'About Page without an Image has been Updated Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
} //endmethod



     //About PageController//


///frontend

public function About(){

  return view('client.about');
}//endmethod



public function Pricing(){

    $packages=PricingPackage::orderBy('created_at', 'desc')->get();


    return view('client.pricing.pricing_list', compact('packages'));

    
}//endmethod


}
