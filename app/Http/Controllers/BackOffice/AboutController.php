<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use App\Models\BackOffice\About;
use App\Models\PricingPackage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class AboutController extends Controller
{
     //About PageController//
    public function AboutPage(){

        $about = About::find(1);

        return view('admin.backOffice.about.add_about', compact('about'));

    }//endmethod

 public function UpdateAbout(Request $request)
{
    $about_id = $request->id;

    if ($request->file('about_image')) {
        $image = $request->file('about_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(669, 499)->save('upload/about_image/' . $name_gen);
        $save_url = 'upload/about_image/' . $name_gen;
        About::findOrFail($about_id)->update([
            'title' => $request->title,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'description' => $request->description,
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'About Page With Image has been Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } else {
        About::findOrFail($about_id)->update([
           'title' => $request->title,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'description' => $request->description,
        ]);

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
