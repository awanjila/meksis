<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use App\Models\BackOffice\HomeSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function Index(){


        return view('admin.index');

    }//endmethod


    public function IndexOfHomeSlider(){
        $homeslides = HomeSlider::all();
        return view('admin.backOffice.homeslider.index_homeslider')->with('homeslides', $homeslides);
   } //endmethod





//Home Slide Controller//

   public function HomeSlider(){

    $homeslides = HomeSlider::all();

    return view('admin.backOffice.homeslider.add_homeslider');
    } //End 


    public function StoreSlider(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'short_title' => 'required',
        ]);

        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1700, 700)->save('upload/home_slide/' . $name_gen);
            $save_url = 'upload/home_slide/' . $name_gen;
            $home_slider = new HomeSlider();
            $home_slider->title = $request->title;
            $home_slider->short_description = $request->short_title;
            $home_slider->home_slide = $save_url;
            $home_slider->save();

            $notification = [
                'message' => 'Home Slider with Image has been Created Successfully',
                'alert-type' => 'info'
            ];

           return redirect()->route('index.slider')->with($notification);

        } else {

            $home_slider = new HomeSlider();
            $home_slider->title = $request->title;
            $home_slider->short_description = $request->short_title;
            $home_slider->save();

            $notification = [
                'message' => 'Home Slider without Image has been Created Successfully',
                'alert-type' => 'warning'
            ];

             return redirect()->route('index.slider')->with($notification);
        }
    }//endmethod


    public function EditSlider($id){

      
    $homeslide=HomeSlider::findOrfail($id);

    return view('admin.backOffice.homeslider.edit_homeslider', compact('homeslide'));
    }//endmethod



        public function UpdateSlider(Request $request){

            $validateData = $request->validate([
            'title' => 'required',
            'short_title' => 'required',
        ]);


        $homeslider_id=$request->id;

       if ($request->file('home_slide')) {

            $image = $request->file('home_slide');
             $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1700, 700)->save('upload/home_slide/' . $name_gen);

             $save_url = 'upload/home_slide/' . $name_gen;

            HomeSlider::findOrfail($homeslider_id)->update([ 
                'title'=> $request->title,
                'short_description'=> $request->short_title,
                'video_url'=> $request->video_url,
                'home_slide'=> $save_url,
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'HomeSlider Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('index.slider')->with($notification);

        } else{
            Customer::findOrfail($customer_id)->update([
                'title'=> $request->title,
                'short_description'=> $request->short_title,
                'video_url'=> $request->video_url,
                // 'home_slide'=> $save_url,
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'HomeSlider Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('index.slider')->with($notification);


        } //endelse


    }//End Method



     public function DeleteSlider($id){
        HomeSlider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'HomeSlider Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }//endmethod


    //Home Slide Controller//


    public function ServicePage(){

    }//endmethod





/// Admin Methods/////

     public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User has Logged out Successfully',
            'alert-type' => 'success'
        );

        return redirect('/jamalhaji')->with($notification);
    }//End Method



    ///////Admin Methods//////
}
