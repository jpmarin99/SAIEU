<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIEU-UT</title>
    <link rel="shortcut icon" href="images/png/favicon.png" type="image/x-icon">
    <!-- Bootstrap , fonts & icons  -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icon-font/css/style.css">
    <link rel="stylesheet" href="fonts/typography-font/typo.css">
    <link rel="stylesheet" href="fonts/typography-font/lucida-grande/typo.css">
    <link rel="stylesheet" href="fonts/fontawesome-5/css/all.css">
    <!-- Plugin'stylesheets  -->
    <link rel="stylesheet" href="js/aos/aos.min.css">
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="js/nice-select/nice-select.min.css">
    <link rel="stylesheet" href="js/slick/slick.min.css">
    <!-- Vendor stylesheets  -->
    <link rel="stylesheet" href="./js/theme-mode-switcher/switcher-panel.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Custom stylesheet -->
</head>
<body data-theme="light">
<div class="site-wrapper overflow-hidden">
    <!-- Header start  -->
    <!-- Header Area -->
    <header class="site-header l8-site-header site-header--menu-center dynamic-sticky-bg dark-mode-texts px-9 site-header--absolute site-header--sticky">
        <div class="container-fluid-fluid">
            <nav class="navbar site-navbar offcanvas-active navbar-expand-lg px-0">
                <!-- Brand Logo-->
                <div class="brand-logo d-inline-block">
                    <a href="#">
                        <!-- light version logo (logo must be black)-->
                        <img src="./images/png/logo-green-white.png" alt="">
                        <!-- Dark version logo (logo must be White)-->
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="mobile-menu">
                    <div class="navbar-nav-wrapper">
                        <ul class="navbar-nav main-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#features">Caracteristicas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.utchetumal.edu.mx/index/" role="button" aria-expanded="false">Tramites de la universidad</a>
                            </li>
                        </ul>
                    </div>
                    <button class="d-block d-lg-none offcanvas-btn-close" type="button" data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="true" aria-label="Toggle navigation">
                        <i class="gr-cross-icon"></i>
                    </button>
                </div>
                <div class="header-btns ml-auto pr-2 ml-lg-9 d-none d-xs-flex">
                    <a class="btn btn-transparent-2 btn-small border-0 font-size-5 font-weight-normal text-periwinkle-gray focus-reset mr-6" href="{{ route('login') }}">
                        Inicia Sesión
                    </a>
                    <a class="btn btn-2 btn-turquoise border border-turquoise font-size-5 text-firefly" href="{{ route('register') }}">
                        Registrate ahora
                    </a>
                </div>
                <!-- Mobile Menu Hamburger-->
                <button class="navbar-toggler btn-close-off-canvas  hamburger-icon border-0" type="button" data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <i class="icon icon-simple-remove icon-close"></i> -->
                    <span class="hamburger hamburger--squeeze js-hamburger">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
            </span>
            </span>
                </button>
                <!--/.Mobile Menu Hamburger Ends-->
            </nav>
        </div>
    </header>
    <!-- navbar- -->
    <!-- Header start end -->
    <!-- hero area -->
    <div class="gradient-bg-1 pt-23 pt-sm-25 pt-md-25 pt-lg-31 pb-lg-0 pb-md-15 pb-11 position-relative z-index-1 font-family-5">
        <div class="section-bg-img-2 pos-abs-tl w-100 h-100 z-index-n1"></div>
        <div class="container">
            <div class="row position-relative justify-content-center">
                <!-- hero area content start -->
                <div class="col-xl-6 col-lg-7 col-md-10 pb-lg-20 pb-10 pr-0" data-aos="fade-right" data-aos-duration="800" data-aos-once="true">
                    <div class="hero-content text-center">
                        <!-- hero area section title start -->
                        <h1 class="font-size-22 font-family-5 text-white letter-spacing-np3 mb-6 ">Bienvenido al SAIEU!</h1>
                        <p class="font-size-8 text-periwinkle-gray letter-spacing-np4 font-family-5 pr-xl-15 pr-lg-0 pr-md-15 pr-0 mb-11">Sistema Automatizado de Integración Escolar Universal</p>
                        <p class="font-size-8 text-periwinkle-gray letter-spacing-np4 font-family-5 pr-xl-15 pr-lg-0 pr-md-15 pr-0 mb-11">Crea avisos para tus alumnos y tutores y envía notificaciones a tus dispositivos</p>
                        <!-- hero area section title end -->
                    </div>
                </div>
                <div class="col-xl-8 col-lg-9">
                    <!-- abs img start -->
                    <div class="abs-img-1 mb-xl-n34 mb-lg-n30 mb-md-n32 mb-n5 mr-n1 w-100 shadow-9 z-index-1">
                        <img src="images/png/SAIEU.png" alt="" class="w-100 light-shape default-shape">
                    </div>
                    <!-- abs img end -->
                </div>
                <!-- hero area content end -->
            </div>
        </div>
    </div>
    <!-- features-section start -->
    <div class=" pt-xl-35 pt-md-28 pt-9 pb-lg-12 pb-0 position-relative font-family-5 ">
        <div class="container">
            <div class="row pr-xl-16 pr-0 pt-lg-15 justify-content-center text-center">
                <!-- single-features start -->
                <div class="col-lg-4 col-md-6 col-sm-9 mb-lg-0 mb-9">
                    <div class="single-features position-relative after-border border-0 px-xl-7 px-lg-5 px-md-4 px-8 py-9 rounded-5">
                        <!-- card texts start -->
                        <div class="circle-50 bg-froly-opacity-1 flex-all-center mx-auto mb-10">
                            <div class="circle-9 bg-carnation"></div>
                        </div>
                        <h4 class="font-size-19 text-default-color-2 font-weight-bold mb-6 line-height-1p63 font-family-5">Una sola plataforma</h4>
                        <p class="text-dovegray font-size-7 font-family-5 mb-8">Crea avisos y emite notificaciones acerca de ellos .</p>
                        <!-- card texts end -->
                    </div>
                </div>
                <!-- single-features End -->
                <!-- single-features start -->
                <div class="col-lg-4 col-md-6 col-sm-9 mb-lg-0 mb-9">
                    <div class="single-features position-relative after-border border-0 px-xl-7 px-lg-5 px-md-4 px-8 py-9 rounded-5">
                        <!-- card texts start -->
                        <div class="circle-50 bg-turquoise-opacity-1 flex-all-center mx-auto mb-10">
                            <div class="circle-9 bg-turquoise"></div>
                            <!-- <img src="image/l1/svg/chat-46.svg" alt=""> -->
                        </div>
                        <h4 class="font-size-19 text-default-color-2 font-weight-bold mb-6 line-height-1p63 font-family-5">Rápida Comunicación</h4>
                        <p class="text-dovegray font-size-7 font-family-5 mb-8">Aclara tus dudas con nuestro Chatbox Integrado :)</p>
                        <!-- card texts start -->
                    </div>
                </div>
                <!-- single-features end -->
                <!-- single-features start -->
                <div class="col-lg-4 col-md-6 col-sm-9 mb-lg-0 mb-0">
                    <div class="single-features border-0 px-xl-7 px-lg-5 px-md-4 px-8 py-9 rounded-5">
                        <!-- card texts start -->
                        <div class="circle-50 bg-heliotrope-opacity-1 flex-all-center mx-auto mb-10">
                            <div class="circle-9 bg-heliotrope"></div>
                            <!-- <img src="image/l1/svg/settings-gear-64.svg" alt=""> -->
                        </div>
                        <h4 class="font-size-19 text-default-color-2 font-weight-bold mb-6 line-height-1p63 font-family-5">Todo en un solo lugar</h4>
                        <p class="text-dovegray font-size-7 font-family-5 mb-8">Crea avisos y obten avisos en nuestra app movíl.</p>
                        <!-- card texts start -->
                    </div>
                </div>
                <!-- single-features end -->
            </div>
        </div>
    </div>
    <!-- content-1 section start -->
    <div class="bg-selago-3 pt-lg-25 pt-15 pb-lg-21 pb-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8" data-aos="fade-right" data-aos-duration="800" data-aos-once="true">
                    <!-- content img start -->
                    <div class="content-img">
                        <img src="images/l8/svg/content-img-1.svg" alt="" class="w-100">
                    </div>
                    <!-- content img end -->
                </div>
                <div class="col-lg-6 col-md-9" data-aos="fade-left" data-aos-duration="800" data-aos-once="true">
                    <!-- content-1 start -->
                    <div class="d-flex flex-column justify-content-center text-lg-left text-center h-100 pl-xl-21 pl-0 pr-lg-7 pr-xxl-25 pr-0 ">
                        <!-- content-1 section-title start -->
                        <h2 class="font-size-20 font-family-5 letter-spacing-np3 text-default-color-2 mb-7">
                            Administra todo rápidamente en un sólo lugar.
                        </h2>
                        <p class="font-size-7 text-default-color-4 font-family-5 mb-10 mb-lg-11 pr-lg-12"> Crea avisos, emite notificaciones a la app, consulta calificaciones y haz tramites todo desde una sola app.</p>
                        <!-- content-1 section-title end -->
                        <!-- text btn end -->
                    </div>
                    <!-- content-1 end -->
                </div>
            </div>
        </div>
    </div>
    <!-- content-2 section start -->
    <div class="position-relative pt-lg-25 pt-15 pb-lg-21 pb-15 z-index-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-9" data-aos="fade-right" data-aos-duration="800" data-aos-once="true">
                    <!-- content-2 start -->
                    <div class="d-flex flex-column justify-content-center text-lg-left text-center h-100 pb-lg-0 pb-15">
                        <!-- content-1 section-title start -->
                        <h2 class="font-size-20 font-family-5 letter-spacing-np3 text-default-color-2 mb-7">
                            Recibe notificaciones en tiempo real, cuando surga algún aviso relacionado a tu carrera
                        </h2>
                        <!-- content-1 section-title end -->
                        <!-- text btn start -->
                        <!-- text btn end -->
                    </div>
                    <!-- content-2 end -->
                </div>
                <div class="col-lg-6 col-md-8 pl-0 offset-xl-1" data-aos="fade-left" data-aos-duration="800" data-aos-once="true">
                    <!-- content img start -->
                    <div class="content-img">
                        <img src="images/l8/svg/content-img-2.svg" alt="" class="w-100">
                    </div>
                    <!-- content img end -->
                </div>
            </div>
        </div>
    </div>
    <div class="video-area section-bg-img-3 pt-lg-23 pt-19 pb-lg-21 pb-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                </div>
            </div>
        </div>
    </div>


    <!-- brand-area start -->
    <div class="bg-default pt-lg-15 pt-sm-9 pt-15 pb-lg-15 pb-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 px-lg-0 text-center" data-aos="fade-down" data-aos-duration="800" data-aos-once="true">
                    <!-- features-1 section-title start -->
                    <p class="text-default-color-4 font-size-7 line-height-1p714 mb-10">Estamos tan orgullosos de trabajar con estas escuelas</p>
                    <!-- features-1 section-title end -->
                </div>
            </div>
            <!-- brand-logos start -->
            <div class="brand-logos row justify-content-center justify-content-lg-between align-items-center px-xl-23">
                <!-- single-brand start -->
                <div class="single-brand mx-7 py-4" data-aos="fade-right" data-aos-duration="500" data-aos-once="true">
                    <img src="images/jpg/UT.jpg" alt="">
                </div>
                <!-- single-brand end -->
                <!-- single-brand start -->
                <div class="single-brand mx-7 py-4" data-aos="fade-right" data-aos-duration="700" data-aos-once="true">
                    <img src="images/jpg/UNID.jpg" alt="">
                </div>
                <!-- single-brand end -->
                <!-- single-brand start -->
                <div class="single-brand mx-7 py-4" data-aos="fade-right" data-aos-duration="900" data-aos-once="true">
                    <img src="images/jpg/CBTIS.jpg" alt="">
                </div>
                <!-- single-brand end -->
                <!-- single-brand start -->
                <div class="single-brand mx-7 py-4" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                    <img src="images/jpg/COBACH.jpg" alt="">
                </div>
                <!-- single-brand end -->
            </div>
            <!-- brand-logos end -->
        </div>
    </div>
    <!-- brand-area end -->
    <!-- testimonial-area start -->
    <div class="testimonial-area pt-7">
        <div class="container">
            <div class="row no-gutters border-collapse-1">
                <div class="col-lg-4 col-md-6 col-sm-9 pr-lg-0">
                    <div class="testimonial-card pt-10 pb-12 border px-xl-13 px-9">
                        <img src="images/l8/png/quote.png" alt="" class="mb-12">
                        <p class="font-size-7 letter-spacing-np4 line-height-1p7 text-default-color-3 mb-0 pb-5 pr-lg-7 pr-sm-9 h-190 font-family-inter">
                            “You made it so simple. My new site is so much faster and
                            easier to work with than my old site. I just choose the page, make the change and click save.”
                        </p>
                        <!-- media start -->
                        <div class="media ml-1 align-items-center">
                            <!-- customer-img start -->
                            <div class="customer-img mr-4">
                                <img src="images/l8/png/client-img-1.png" alt="" class="circle-size-43 w-100">
                            </div>
                            <!-- customer-img end -->
                            <!-- media-body start -->
                            <div class="media-body pl-4 pt-md-0 pt-9">
                                <h5 class="font-size-5 font-family-1 line-height-1p86 font-weight-bold text-default-color-2 mb-0">Sallie Lawson</h5>
                                <p class="font-size-4 letter-spacing-np64 line-height-1p86 font-weight-normal text-dovegray mb-0">Founder of Crips</p>
                            </div>
                            <!-- media-body end -->
                        </div>
                        <!-- media end -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9 px-lg-0">
                    <div class="testimonial-card pt-10 pb-12 border px-xl-13 px-9">
                        <img src="images/l8/png/quote.png" alt="" class="mb-12">
                        <p class="font-size-7 letter-spacing-np4 line-height-1p7 text-default-color-3 mb-0 pb-5 pr-lg-7 pr-sm-9 h-190 font-family-inter">
                            “Simply the best. Better than all the rest. I’d recommend this product to beginners and advanced users.”
                        </p>
                        <!-- media start -->
                        <div class="media ml-1 align-items-center">
                            <!-- customer-img start -->
                            <div class="customer-img mr-4">
                                <img src="images/l8/png/client-img-2.png" alt="" class="circle-size-43 w-100">
                            </div>
                            <!-- customer-img end -->
                            <!-- media-body start -->
                            <div class="media-body pl-4">
                                <h5 class="font-size-5 font-family-1 line-height-1p86 font-weight-bold text-default-color-2 mb-0">Sallie Lawson</h5>
                                <p class="font-size-4 letter-spacing-np64 line-height-1p86 font-weight-normal text-dovegray mb-0">Founder of Crips</p>
                            </div>
                            <!-- media-body end -->
                        </div>
                        <!-- media end -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9 pl-lg-0">
                    <div class="testimonial-card pt-10 pb-12 border px-xl-13 px-9">
                        <img src="images/l8/png/quote.png" alt="" class="mb-12">
                        <p class="font-size-7 letter-spacing-np4 line-height-1p7 text-default-color-3 mb-0 pb-5 pr-lg-7 pr-md-9 pr-sm-11 h-190 font-family-inter">
                            “This is a top quality product. No need to think twice before purchasing, you simply could not go wrong”
                        </p>
                        <!-- media start -->
                        <div class="media ml-1 align-items-center">
                            <!-- customer-img start -->
                            <div class="customer-img mr-4">
                                <img src="images/l8/png/client-img-3.png" alt="" class="circle-size-43 w-100">
                            </div>
                            <!-- customer-img end -->
                            <!-- media-body start -->
                            <div class="media-body pl-4">
                                <h5 class="font-size-5 font-family-1 line-height-1p86 font-weight-bold text-default-color-2 mb-0">Sallie Lawson</h5>
                                <p class="font-size-4 letter-spacing-np64 line-height-1p86 font-weight-normal text-dovegray mb-0">Founder of Crips</p>
                            </div>
                            <!-- media-body end -->
                        </div>
                        <!-- media end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial-area end -->
    <!-- cta area -->
    <div class="cta-area pt-lg-19 pt-15 pb-lg-21 pb-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-md-flex justify-content-between text-align-lg-left text-center align-items-center font-inter-wrapper">
                        <h2 class="font-size-12 mb-lg-0 mb-9">Administra todo en un solo lugar</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section -->
    <footer class="gradient-bg-6 position-relative l8-footer">
        <div class="shape l8-footer-shape-top-left">
            <img src="images/l8/svg/footer-shape.svg" alt="" class="w-100 light-shape default-shape z-index-n2">
        </div>

        <!-- footer-bottom start -->
        <div class="pt-6 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-0">
                        <div class="navbar site-navbar d-md-flex d-block text-center px-0">
                            <!-- DO NOT DELETE THIS CREDIT. TO DELETE, PLEASE BUY PRO LICENSE -->
                            <div class="copyright">
                                <p class="font-size-1 font-family-5 text-periwinkle-gray line-height-1p5 mb-0 font-family-inter"> &copy; SAIEU 2021 Todos los derechos resevados. </p>
                            </div>
                            <!-- copyright end-->
                            <!-- footer-menu start-->
                            <div class="footer-menu">
                                <!-- navbar-nav-wrapper start-->
                                <div class="navbar-nav-wrapper">
                                    <!-- main-menu start-->
                                    <ul class="mb-0 list-unstyled d-flex flex-row justify-content-center">
                                        <li class="mx-3">
                                            <a class="text-periwinkle-gray font-size-1 font-weight-normal font-family-inter" href="#">Politica de privacidad</a>
                                        </li>
                                        <li class="mx-3">
                                            <a class="text-periwinkle-gray font-size-1 font-weight-normal font-family-inter" href="#features">Terminos y condiciones</a>
                                        </li>
                                        <li class="mx-3">
                                            <a class="text-periwinkle-gray font-size-1 font-weight-normal font-family-inter" href="/public/sitemap.pdf">Mapa de sitio</a>
                                        </li>
                                    </ul>
                                    <!-- main-menu end-->
                                </div>
                                <!-- navbar-nav-wrapper end-->
                            </div>
                            <!-- footer-menu end-->
                            <div class="ml-auto pr-2 ml-lg-12 ml-md-0">
                                <!-- widget social icon start -->
                                <div class="social-icons">
                                    <!-- widget social icon list start -->
                                    <ul class="pl-0 list-unstyled mb-lg-0 mb-0">
                                        <li class="d-inline-block px-3 ml-3"><a href="https://www.facebook.com/UTChetumal/" class="hover-color-primary text-white"><i class="fab fa-facebook-f font-size-3 pt-2"></i></a></li>
                                        <li class="d-inline-block px-3 ml-3"><a href="https://twitter.com/UTChetumal" class="hover-color-primary text-white"><i class="fab fa-twitter font-size-3 pt-2"></i></a></li>
                                        <li class="d-inline-block px-3 ml-3"><a href="#" class="hover-color-primary text-white"><i class="fab fa-linkedin-in font-size-3 pt-2"></i></a></li>
                                    </ul>
                                    <!-- widget social icon list end -->
                                </div>
                                <!-- widget social icon end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- cta section -->
</div>
<!-- Vendor Scripts -->
<script src="js/vendor.min.js"></script>
<!-- Plugin's Scripts -->
<script src="js/fancybox/jquery.fancybox.min.js"></script>
<script src="js/nice-select/jquery.nice-select.min.js"></script>
<script src="js/aos/aos.min.js"></script>
<script src="js/slick/slick.min.js"></script>
<script src="./js/counter-up/jquery.waypoints.js"></script>
<script src="./js/counter-up/jquery.counterup.js"></script>
<script src="js/theme-mode-switcher/gr-theme-mode-switcher.js"></script>
<!-- Activation Script -->
<script src="js/custom.js"></script>
</body>

</html>

