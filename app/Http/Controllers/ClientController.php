<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DemoPlans;
use App\Models\BackOffice\Blog;
use App\Models\Service;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller


{

    public function index()

    {

//        $response = Http::get('https://restcountries.com/v3.1/all');
//       // dd($response->json());
//        $countries = collect($response->json())->map(function ($item) {
//            return [
//                'name' => $item['name']['common'],
//                'code' => $item['cca2'],
////              'flag' => $item['flags'][0],
////                'flag' => $item->flags,
//            ];
//        });

        $contacts=Contact::all();
        $projects=Product::all();
        $services=Service::all();
        $blog_posts =Blog::take(3)->get();
        return view('client.landing', compact('blog_posts', 'services', 'projects', 'contacts'));
    }

    public function pricing()

    {
        return view('client.pricing');
    }
    public function about()
    {
        return view('client.about');
    }

    public function services()
    {
        $services=Service::all();
        return view('client.services', compact('services'));
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






}
