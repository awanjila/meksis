<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function FaqPage()
    {
        return view('client.faqs');
    }
}
