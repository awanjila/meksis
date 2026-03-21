<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use App\Mail\ContactMail;
use Illuminate\Http\Request;

use App\Models\Contact;

use Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'subject' => 'nullable|string|max:255',
            'g-recaptcha-response' => 'nullable|string'
        ]);

        // Verify reCAPTCHA only if provided
        if ($request->input('g-recaptcha-response')) {
            $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]);

            if (!$recaptcha->json('success')) {
                return response()->json([
                    'errors' => ['g-recaptcha-response' => ['reCAPTCHA verification failed']]
                ], 422);
            }
        }

        // Create contact record
        $contact = Contact::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => $request->subject ?? 'New Contact Form Submission from ' . $request->name,
        ]);

        // Send email notification to support
        try {
            $admin_email = 'support@wabestudio.co.ke';
            Mail::to($admin_email)->send(new ContactMail($request->all()));
        } catch (\Exception $e) {
            \Log::error('Contact email failed: ' . $e->getMessage());
        }

        // Return JSON response for API
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you, ' . $contact->name . '! Your message has been sent successfully. We\'ll get back to you within 24 hours.',
                'data' => $contact
            ], 201);
        }

        // Display Toastr notification for traditional form
        $notification = [
            'message' => $contact->name . ' Your Message has been sent successfully.',
            'type' => 'success'
        ];

        return redirect()->back()->with('notification', $notification);
    }// endmethod


      public function contactView($id){

        $contact = Contact::findOrFail($id);

        return view('admin.contact', compact('contact'));

    }//endmethod


     public function contactInbox(){

        $contacts = Contact::latest()->get();

        return view('admin.contact.inbox', compact('contacts'));

    }//endmethod

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }//endmethod


    public function contactFrontend()
    {
        return view('client.contact');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'nullable|string',
        ]);

        // Verify reCAPTCHA only if provided
        if ($request->input('g-recaptcha-response')) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            if (!$response->json('success')) {
                return back()->with('error', 'reCAPTCHA verification failed. Please try again.');
            }
        }

        // Send email logic
        try {
            $admin_email = 'support@wabestudio.co.ke';
            Mail::to($admin_email)->send(new ContactMail($request->all()));
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Contact email failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send message. Please try again.');
        }
    }
}
