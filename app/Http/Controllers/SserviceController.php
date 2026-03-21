<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Storage;

class ServiceController extends Controller
{

   
    public function service_index(){  //creating our models here.
        $services=Service::orderBy('created_at', 'desc')->get();
        return view('client.services.service')->with('services', $services);

    }


    public function create(){  //creating our models here.

        return view('admin.service.create');
    }

    public function edit($id){  //creating our models here.
        $services=Service::orderBy('created_at', 'desc')->get();
        $service =Service::findorfail($id);

        return view('admin.service.edit', compact('service', 'services'));


    }

    

    public function update(Request $request,$id) {
        $service=Service::findorfail($id);
        if($request->hasFile('cover_image')){
//

            if (File::exists("/cover_image/".$service->cover_image))
            {
                File::delete("/cover_image/".$service->cover_image);
            }

            $file=$request->file('cover_image');
            $service->cover_image=time()."".$file->getClientOriginalName();
            $file->move(\public_path('cover_image/'),$service->cover_image);
            $request['cover_image']=$service->cover_image;

        } else{
            $service->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description,
                'cover_image'=> $service->cover_image,
            ]);
        }

        return redirect('/index_service');

    }

    public function destroy($id)
    {

        $service = Service::findorfail($id);


        $service->delete();

        return redirect()->route('index.service')->with('status1', 'The ' . $service->name . ' Service has been deleted');


    }

    public function show($slug){

        $service=Service::where('slug', $slug)->firstOrFail();
        $services=Service::get();

//        dd($images);
        return view('client.services.service_detail')->with('service', $service)->with('services', $services);
    }






    public function deleteCoverImage($id){
        $cover_image = Service::findOrFail($id)->cover_image;

        //dd($cover_image);

        if(File::exists('cover_image/'.$cover_image)){
            File::delete('cover_image/'.$cover_image);
        }
        return back();
    }


}
