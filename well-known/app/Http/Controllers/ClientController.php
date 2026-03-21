<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemoPlans;
use App\Models\Blog;
use App\Models\Service;

class ClientController extends Controller


{

    public function index()

    {

        $services=Service::take(3)->get();
        $blog_posts =Blog::take(3)->get();
        return view('client.landing')->with('blog_posts', $blog_posts)->with('services', $services);
    }
    public function about()
    {
        return view('client.about');
    }

    public function services()
    {
        return view('client.services');
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function web_design()
    {
        return view('client.services.web_design');
    }
    public function e_commerce()
    {
        $blog =Blog::get();
        return view('client.services.e_commerce')->with('blog', $blog);

    }

        public function mpesa_integration()

    {
        $demo_plans=DemoPlans::get();

        return view('client.services.mpesa_integration')->with('demo_plans', $demo_plans);
    }

    public function branding_digital()

    {
        return view('client.services.branding_digital');
    }

    public function time_attendance()

    {
        return view('client.services.time_attendance');
    }

    public function custom_software(){
        return view('client.services.custom_software');
    }



}
