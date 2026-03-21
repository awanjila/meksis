@extends('client.layout.app')
@section('title')
    Contact | Wabestudio Contact Us  IT solutions Company
@endsection

@section('content')<!--Page Header Start-->
<section id="subheader" data-bgimage="url(images/background/subheader-3.jpg)" data-stellar-background-ratio=".2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Talk To Us</h1>
                <ul class="crumb">
                    <li><a href="/">Home</a></li>
                    <li class="sep">/</li>
                    <li>Talk To Us</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div id="content" class="no-top">
    <section id="de-map" class="no-top" aria-label="map-container">
        <div class="map-container map-fullwidth">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8579855083995!2d36.80951831475401!3d-1.2571326990830791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f134f6924b939%3A0x9497581070a52098!2sWabeStudio%20%7C%20Modern%20Website%20Design%20In%20Kenya%20%7C%20Custom%20Software%20Development%20%7C%20Branding%20I%20Digital%20Marketing%20%7C%20Safaricom%20Mpesa%20Intergration!5e0!3m2!1sen!2ske!4v1648839163886!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">

            <div class="col-md-8">
                <form name="contactForm" id='contact_form' method="post" action="{{route('sendmail')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb10">
                            <h3>Send Us Message</h3>
                        </div>
                        <div class="col-md-6">
                            <div id='name_error' class='error'>Please enter your name.</div>
                            <div>
                                <input type='text' name='name' id='name' class="form-control" placeholder="Your Name" required>
                            </div>

                            <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                            <div>
                                <input type='email' name='email' id='email' class="form-control" placeholder="Your Email" required>
                            </div>

                            <div id='phone_error' class='error'>Please enter your phone number.</div>
                            <div>
                                <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id='message_error' class='error'>Please enter your message.</div>
                            <div>
                                <textarea name='message' id='message' class="form-control" placeholder="Your Message" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
{{--                            <div class="g-recaptcha" data-sitekey="6LfHDjsdAAAAANyZQJeyAUNIjTPCB-5PodXpdloe"></div>--}}
                            <p id='' class="mt20">
                                <input type='submit' id='#' value='Submit Form' class="btn btn-line">
                            </p>
                        </div>
                    </div>
                </form>


                    @if (session('status'))
                        <div id="success_message" class='success'>
                            {{ session('status') }}
                        </div>
                    @endif

                <div id="error_message" class='error'>
                    Sorry there was an error sending your form.
                </div>

            </div>

            <div id="sidebar" class="col-md-4">

                <div class="widget widget_text">
                    <h3>Contact Info</h3>
                    <address>
                        <span><strong>Address:</strong>3rd Parklands Avenue, Nairobi</span>
                        <span><strong>Phone:</strong>254 781 312 070</span>
                        <span><strong>Email:</strong><a href="mailto:needhelp@wabestudio.co.ke">needhelp@wabestudio.co.ke</a></span>
                        <span><strong>Web:</strong><a href="https://wabestudio.co.ke">https://wabestudio.co.ke</a></span>
                        <span><strong>Open</strong>Monday - Saturday 08:00 - 17:00</span>
                    </address>
                </div>









            </div>
        </div>
    </div>
</div>
<!--Google Map End-->
@endsection
