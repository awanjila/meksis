<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackOffice\Service;
use Illuminate\Support\Facades\File;
use Storage;

class ServiceController extends Controller
{
    public function service_index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('client.services.service')->with('services', $services);
    }

    public function IndexOfServices()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.backOffice.service.index_service')->with('services', $services);
    }

    public function AddService()
    {
        return view('admin.backOffice.service.add_service');
    }

    public function StoreService(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            if (!file_exists('upload/service_image')) {
                mkdir('upload/service_image', 0777, true);
            }
            
            // Save image directly without GD library
            $image->move('upload/service_image', $name_gen);
            $save_url = 'upload/service_image/' . $name_gen;
            
            $service = new Service();
            $service->name = $request->title;
            $service->meta_title = $request->meta_title;
            $service->meta_description = $request->meta_description;
            $service->description = $request->description;
            $service->image = $save_url;
            $service->save();

            $notification = [
                'message' => 'Service with Image has been Created Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('index.service')->with($notification);
        } else {
            $service = new Service();
            $service->name = $request->title;
            $service->description = $request->short_title;
            $service->meta_title = $request->meta_title;
            $service->meta_description = $request->meta_description;
            $service->save();

            $notification = [
                'message' => 'Service without Image has been Created Successfully',
                'alert-type' => 'warning'
            ];

            return redirect()->route('index.service')->with($notification);
        }
    }

    public function EditService($id)
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        $service = Service::findorfail($id);
        return view('admin.backOffice.service.edit_service', compact('service', 'services'));
    }

    public function UpdateService(Request $request)
    {
        $service_id = $request->id;

        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            if (!file_exists('upload/service_image')) {
                mkdir('upload/service_image', 0777, true);
            }
            
            // Save image directly without GD library
            $image->move('upload/service_image', $name_gen);
            $save_url = 'upload/service_image/' . $name_gen;
            
            Service::findOrFail($service_id)->update([
                'name' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Service Page With Image has been Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('index.service')->with($notification);
        } else {
            Service::findOrFail($service_id)->update([
                'name' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]);

            $notification = array(
                'message' => 'Service Page without an Image has been Updated Successfully',
                'alert-type' => 'warning'
            );

            return redirect()->route('index.service')->with($notification);
        }
    }

    public function DeleteService($id)
    {
        $service = Service::findorfail($id);
        $service->delete();

        $notification = array(
            'message' => 'Service has been Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index.service')->with($notification);
    }

    public function showService($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $services = Service::get();
        return view('client.services.service_detail')->with('service', $service)->with('services', $services);
    }

    public function deleteCoverImage($id)
    {
        $cover_image = Service::findOrFail($id)->cover_image;

        if (File::exists('cover_image/' . $cover_image)) {
            File::delete('cover_image/' . $cover_image);
        }
        return back();
    }

    public function Services()
    {
        $services = Service::all();
        return view('client.services', compact('services'));
    }
}
