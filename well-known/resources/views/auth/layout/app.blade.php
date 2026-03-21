<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>


    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Web Design in Kenya, Custom Software Development In Kenya, Creative digital strategy in Kenya "/>
    <meta name="description" content="We are creative digital studio based in Nairobi Kenya, and we offer Web services that Include
    Modern Web development & design, Custom Software that is tailored to your needs, and a
     Creative Strategy for handling your online presence that will attract and maintain your clients. We are always happy to serve.
      We are WABESTUDIO." />
    <title>@yield('title') </title>
    <!-- favicons Icons -->
    <!-- CSS Files
    ================================================== -->
    <link id="bootstrap" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link id="bootstrap-grid" href="{{asset('css/bootstrap-grid.min.css')}}" rel="stylesheet" type="text/css" />
    <link id="bootstrap-reboot" href="{{asset('css/bootstrap-reboot.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/jpreloader.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/plugin.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.transitions.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/twentytwenty.css')}}" type="text/css">

    <!-- custom background -->
    <link rel="stylesheet" href="{{asset('css/bg.css')}}" type="text/css">

    <!-- color scheme -->
    <link rel="stylesheet" href="{{asset('css/colors/red.css')}}" type="text/css" id="colors">
    <link rel="stylesheet" href="{{asset('css/color.css')}}" type="text/css">

    <!-- load fonts -->
    <link rel="stylesheet" href="{{asset('fonts/font-awesome/css/font-awesome.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('fonts/elegant_font/HTML_CSS/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('fonts/et-line-font/style.css')}}" type="text/css">

    <!-- revolution slider -->
    <link rel="stylesheet" href="{{asset('rs-plugin/css/settings.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/rev-settings.css')}}" type="text/css">

    <!-- custom font -->
    <link rel="stylesheet" href="{{asset('css/font-style-2.css')}}" type="text/css">


</head>
<body>

<!-- /.preloader -->
<div class="page-wrapper">
    
    <div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content">

        </div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->
@yield('content')



</div>


{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>--}}
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+254710909198", // WhatsApp number
            sms: "+254710909198", // Sms phone number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "whatsapp,sms", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jpreLoader.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('js/easing.js')}}"></script>
<script src="{{asset('js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('js/jquery.scrollto.js')}}"></script>
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="{{asset('js/jquery.countTo.js')}}"></script>
<script src="{{asset('js/classie.js')}}"></script>
<script src="{{asset('js/video.resize.js')}}"></script>
<script src="{{asset('js/validation.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/enquire.min.js')}}"></script>
<script src="{{asset('js/designesia.js')}}"></script>
<script src="{{asset('js/jquery.event.move.js')}}"></script>
<script src="{{asset('js/jquery.twentytwenty.js')}}"></script>

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script src="{{asset('rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
<script src="{{asset('rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

<script>
    $(window).on("load", function(){
        $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
        $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
</script>


</body>
</html>
