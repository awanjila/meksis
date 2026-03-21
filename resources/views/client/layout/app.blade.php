<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="oDD8YsBbjZc6ulckTqOWVxJEWolGPLFDFRZkDMai">

    <title>Meksis Engineering – Elevated Steel Water Tanks & Storage Solutions Kenya</title>

    <meta name="title" content="Elevated Steel Water Tanks, GRP Tanks & Steel Towers in Kenya | Meksis Engineering" />
    <meta name="description" content="Meksis Engineering is a leading water storage solutions provider in Kenya, specializing in elevated steel water tanks, galvanized steel tanks, GRP water tanks, steel towers, and industrial water storage systems for residential, commercial, and industrial environments." />
    <meta name="keywords" id="dynamic-keywords" content="Elevated Steel Water Tanks Kenya, Galvanized Steel Tanks, GRP Water Tanks Kenya, Steel Towers, Water Storage Solutions Kenya, Industrial Water Tanks">

    <!-- Open Graph -->
    <meta property="og:title" content="Elevated Steel Water Tanks, GRP Tanks & Steel Towers in Kenya | Meksis Engineering">
    <meta property="og:description" content="Meksis Engineering is a leading water storage solutions provider in Kenya, specializing in elevated steel water tanks, galvanized steel tanks, GRP water tanks, steel towers, and industrial water storage systems for residential, commercial, and industrial environments.">
    <meta property="og:image" content="https://www.meksis.co.ke/front-assets/images/meksis-og.jpg">
    <meta property="og:url" content="https://meksis.co.ke">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Elevated Steel Water Tanks, GRP Tanks & Steel Towers in Kenya | Meksis Engineering">
    <meta name="twitter:description" content="Meksis Engineering is a leading water storage solutions provider in Kenya, specializing in elevated steel water tanks, galvanized steel tanks, GRP water tanks, steel towers, and industrial water storage systems for residential, commercial, and industrial environments.">
    <meta name="twitter:image" content="https://www.meksis.co.ke/front-assets/images/meksis-og.jpg">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/images/fav.png') }}">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
        <!-- Font Awesome 6 CSS (CDN for latest icons) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- font-awesome css (legacy) -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/font-awesome.min.css') }}">
        <!-- flaticon css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/fonts/flaticon.css') }}">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/animate.css') }}">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/owl.carousel.css') }}">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/slick.css') }}">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/off-canvas.css') }}">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/magnific-popup.css') }}">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="{{ asset('front_assets/css/rsmenu-main.css') }}">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/rs-spacing.css') }}">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/style.css') }}">
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/responsive.css') }}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google tag -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-xxxxxxxxx"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-xxxxxxxxx');
    </script>
</head>
<body class="default-home">

    <!-- Main content Start -->
    <div class="main-content">

    <div id="app">    
        <!-- Header -->
        <div class="full-width-header">
            <header-component></header-component>
        </div>
    
    @yield('content')

    <!-- WhatsApp Button -->
    <whatsapp-button></whatsapp-button>

    <!-- Footer -->
    <footer-component></footer-component>
    </div>

    <!-- Scroll Up -->
    <div id="scrollUp" class="orange-color">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- Search Modal -->
    <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
        <button type="button" class="close" data-dismiss="modal">
            <span class="flaticon-cross"></span>
        </button>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="search-block clearfix">
                    <form>
                        <div class="form-group">
                            <input class="form-control" placeholder="Search tanks, towers &amp; structures..." type="text">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>


<!-- modernizr js -->
 <script src="{{ asset('front_assets/js/modernizr-2.8.3.min.js') }}"></script>
        <!-- jquery latest version -->
        <script src="{{ asset('front_assets/js/jquery.min.js') }}"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>

    
        <!-- Menu js -->
        <script src="{{ asset('front_assets/js/rsmenu-main.js') }}"></script> 
        <!-- op nav js -->
        <script src="{{ asset('front_assets/js/jquery.nav.js') }}"></script>
        <!-- Time Circle js -->
        <script src="{{ asset('front_assets/js/time-circle.js') }}"></script>
        <!-- owl.carousel js -->
        <script src="{{ asset('front_assets/js/owl.carousel.min.js') }}"></script>
        <!-- wow js -->
        <script src="{{ asset('front_assets/js/wow.min.js') }}"></script>
        <!-- Skill bar js -->
        <script src="{{ asset('front_assets/js/skill.bars.jquery.js') }}"></script>
        <script src="{{ asset('front_assets/js/jquery.counterup.min.js') }}"></script> 
         <!-- counter top js -->
        <script src="{{ asset('front_assets/js/waypoints.min.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('front_assets/js/swiper.min.js') }}"></script>   
        <!-- particles js -->
        <script src="{{ asset('front_assets/js/particles.min.js') }}"></script>  
        <!-- magnific popup js -->
        <script src="{{ asset('front_assets/js/jquery.magnific-popup.min.js') }}"></script>      
        <script src="{{ asset('front_assets/js/jquery.easypiechart.min.js') }}"></script>      
        <!-- plugins js -->
        <script src="{{ asset('front_assets/js/plugins.js') }}"></script>
        <!-- pointer js -->
        <script src="{{ asset('front_assets/js/pointer.js') }}"></script>
        <!-- contact form js -->
        <script src="{{ asset('front_assets/js/contact.form.js') }}"></script>
        <!-- main js -->
        <script src="{{ asset('front_assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- Dynamic Keywords by Country -->
<script>
    function updateMetaKeywords(country) {
        const baseKeywords = "Elevated Steel Water Tanks, Galvanized Steel Tanks, GRP Water Tanks, Steel Towers, Water Storage Solutions, Industrial Water Tanks";
        document.getElementById('dynamic-keywords')
            .setAttribute('content', `${baseKeywords}, ${country}`);
    }

    fetch('https://ipapi.co/json/')
        .then(response => response.json())
        .then(data => updateMetaKeywords(data.country_name))
        .catch(() => updateMetaKeywords('Kenya'));
</script>

<script>
    window.paypalClientId = "AZJWsPdpgCFr5r8e_PDPrWIHAAO1DGVZeooc-cpD8QvnoP_BrtEltCNTz62j8wvyJOU5a30zzgL9VPIh";
    window.paypalMode    = "live";
</script>

</html>