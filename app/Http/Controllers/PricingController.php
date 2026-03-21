<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use App\Models\FrontEnd\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Support\Str; // Make sure to include this at the top of your file

class PricingController extends Controller
{
    public function AddPricing(){

        // $price_package=PricingPackage::findOrfail($id);

        $pricepackage=PricingPackage::orderBy('created_at', 'desc')->get();

        return view('admin.backOffice.pricing.add_pricing', compact('pricepackage'));

    }//endmethod


    public function StorePricing(Request $request){

      //dd($request->all());

        $validateData = $request->validate([
           'name' => 'required',
           'description' => 'required',
       ]);
   
          
           $pricing = new Pricing();
           $pricing->title = $request->name;
           $pricing->description = $request->description;
           $pricing->meta_title = $request->meta_title;
           $pricing->meta_description = $request->meta_description;
           $pricing->pricing_package_id = $request->category;
           $pricing->pricing = $request->pricing;
           $pricing->duration = $request->duration;
           $pricing->save();
   
           $notification = [
               'message' => 'Price Package has been Created Successfully',
               'alert-type' => 'info'
           ];
   
           return redirect()->route('index.pricing')->with($notification);
   
       
   
   
       }//endmethod

    public function EditPricing($id){
        $price_package=PricingPackage::orderBy('created_at', 'desc')->get();
     $pricing_package=Pricing::findOrfail($id);

     return view('admin.backOffice.pricing.edit_pricing', compact('pricing_package', 'price_package'));

    }//endmethod


    public function EditPricingPackage($id){
        //  $blog_cats = BlogCategory::all();
    
         $price_package=PricingPackage::findOrfail($id);
    
         return view('admin.backOffice.pricing.edit_pricing_package', compact('price_package'));
    
        }//endmethod



    public function DeletePricing($id){

        Pricing::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Price Package Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);

}//endmethod


public function DeletePricingPackage($id){

    PricingPackage::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Price Package Deleted Successfully',
        'alert-type' => 'warning'
    );

    return redirect()->back()->with($notification);

}//endmethod





public function AddPricingPackage(){


 return view('admin.backOffice.pricing.add_pricing_package');

    }//endmethod




    public function UpdatePricing(Request $request){
        // Debug the request data
        //dd($request->all());
    
        $pricing_id = $request->id;
        $slug = Str::slug($request->name); // Generate slug from the blog name
    
        // Debug the pricing ID
        //dd($pricing_id);
    
        // Validate the incoming request data
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'pricing' => 'required', // Added validation for pricing
            // 'pricing_range' => 'required', // Added validation for pricing_range
            'duration' => 'required', // Added validation for duration
            'meta_title' => 'required', // Added validation for meta_title
            'meta_description' => 'required' // Added validation for meta_description
        ]);
    
        // Find the Pricing model by ID
        $pricing = Pricing::findOrFail($pricing_id);
    
        // Debug the found model
        //dd($pricing);
    
        // Update the pricing model with the new data
        $pricing->update([
            'pricing' => $request->pricing,
            'duration' => $request->duration,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'title' => $request->name,
            'description' => $request->description,
            'pricing_package_id' => $request->category
        ]);
    
        // Prepare the notification message
        $notification = array(
            'message' => 'Price Package has been Updated Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect to the pricing index route with the notification
        return redirect()->route('index.pricing')->with($notification);
    }// endmethod



    public function UpdatePricingPackage(Request $request){
        // Debug the request data
        // dd($request->all());
    
        $price_package_id = $request->id;
        $slug = Str::slug($request->name); // Generate slug from the blog name
    
        // Debug the pricing ID
        //dd($pricing_id);
    
        // Validate the incoming request data
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'pricing' => 'required', // Added validation for pricing
           
        ]);
    
        // Find the Pricing model by ID
        $price_package = PricingPackage::findOrFail($price_package_id);
    
        // Debug the found model
        //dd($pricing);
    
        // Update the pricing model with the new data
        $price_package->update([
            'price_range' => $request->pricing,
            'title' => $request->name,
            'slug' => $slug,
            'description' => $request->description
        ]);
    
        // Prepare the notification message
        $notification = array(
            'message' => 'Price Package has been Updated Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect to the pricing index route with the notification
        return redirect()->route('index.pricing.package')->with($notification);
    }// endmethod
    



    public function StorePricingPackage(Request $request){

        // dd($request->all());

        

     $validateData = $request->validate([
       
        'name' => 'required',
        'pricing_range' => 'required',
        'description' => 'required'
    ]);

    $slug = Str::slug($request->name); // Generate slug from the blog name
     $price_package = new PricingPackage();
     $price_package->title = $request->name;
     $price_package->slug = $slug;
     $price_package->description = $request->description;
     $price_package->price_range = $request->pricing_range;
     $price_package->save();

     $notification = [
        'message' => 'Pricing Package has been Created Successfully',
        'alert-type' => 'success'
    ];


           // dd($notification);

    return redirect()->route('index.pricing.package')->with($notification);
    

    }//endmethod


    public function IndexOfPricings(){

      $pricings=Pricing::orderBy('created_at', 'desc')->get();

      return view('admin.backOffice.pricing.index_pricing')->with('pricings', $pricings);
    }//endmethod

    public function IndexOfPricingPackages(){

      $pricing_package=PricingPackage::orderBy('created_at', 'desc')->get();

      return view('admin.backOffice.pricing.index_pricing_package')->with('pricing_package', $pricing_package);
    }//endmethod





    public function DeleteBlogCategory($id){
     BlogCategory::findOrFail($id)->delete();

     $notification = array(
        'message' => 'Blog Category Deleted Successfully',
        'alert-type' => 'warning'
    );

     return redirect()->back()->with($notification);


    }//endmethod


    public function IndexOfClientBlogs(){

        $blog_posts=Blog::get();
        $data = Blog::paginate(5);
        return view("client.blog.blog_list")->with('blog_posts', $blog_posts)->with('data', $data);
    }//endmethod



    public function ShowPricing($slug){
        $packageprice = PricingPackage::where('slug', $slug)->firstOrFail();
        
        // Get only the prices with the same package ID
        $prices = Pricing::where('pricing_package_id', $packageprice->id)->get();
        
        // Get all package prices
        $packageprices = PricingPackage::get();
        
        return view('client.pricing.pricing_details', compact('packageprice', 'packageprices', 'prices'));
    }//endmethod
    

}
