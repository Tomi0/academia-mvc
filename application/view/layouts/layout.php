<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Academia x2</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/simple-line-icons.css">
    <link rel="stylesheet" href="/css/slicknav.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<!-- Header Section Start -->
<header id="hero-area">
    <div class="overlay"></div>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navba bg-faded" id="white-bg">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/img/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <?php if (Mini\Libs\Sesion::userIsLoggedIn()) { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login/logout" class="nav-link">Cerrar sesión</a>
                    </li>

                    <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/pages/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/contact">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/whyus">Why us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>

                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Start -->
    <ul class="mobile-menu">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/about">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/contact">Contact us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/whyus">Why us</a>
        </li>
    </ul>
    <!-- Mobile Menu End -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="carousel-slider owl-carousel owl-theme">
                    <div class="item active">
                        <div class="contents text-center">
                            <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">Academia x2</h1>
                            <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">La educación es un proceso que no termina nunca.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="contents text-center">
                            <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">Cursos online</h1>
                            <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">No les evitéis a vuestros hijos las dificultades de la vida, enseñadles más bien a superarlas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- Header Section End -->

<?= $this->section('content') ?>

<!-- Footer Section Start -->
<footer>
    <!-- Footer Area Start -->
    <section class="footer-Content">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h3 class="logo-title">Basic</h3>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="widget">
                        <div class="textwidget">
                            <p>Lorem ipsum dolor sit amet, con sectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.Lorem ipsum dolor sit amet, con sectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                        <form class="subscribe-box">
                            <input placeholder="Your email" type="text">
                            <input class="btn-system" value="Send" type="submit">
                        </form>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">Links</h3>
                        <ul class="menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Works</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">Services</h3>
                        <ul class="menu">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Graphics Design</a></li>
                            <li><a href="#">Branding</a></li>
                            <li><a href="#">UX Consulting</a></li>
                            <li><a href="#">Mobile Apps</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">Flicker Gallery</h3>
                        <ul class="featured-list">
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img1.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img2.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img3.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img4.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img5.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img6.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img7.jpg"></a>
                            </li>
                            <li>
                                <a href="#"><img alt="" src="/img/featured/img8.jpg"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer area End -->

    <!-- Copyright Start  -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info pull-left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <p>Template by <a rel="nofollow" href="http://graygrids.com">GrayGrids</a></p>
                    </div>
                    <div class="bottom-social-icons social-icon pull-right  wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <a class="twitter" href="https://twitter.com/GrayGrids"><i class="fa fa-twitter"></i></a>
                        <a class="facebook" href="https://web.facebook.com/GrayGrids"><i class="fa fa-facebook"></i></a>
                        <a class="google-plus" href="https://plus.google.com/+GrayGrids"><i class="fa fa-google-plus"></i></a>
                        <a class="linkedin" href="https://www.linkedin.com/GrayGrids"><i class="fa fa-linkedin"></i></a>
                        <a class="dribble" href="https://dribbble.com/GrayGrids"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

</footer>
<!-- Footer Section End -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

<div id="loader">
    <div class="cssload-thecube">
        <div class="cssload-cube cssload-c1"></div>
        <div class="cssload-cube cssload-c2"></div>
        <div class="cssload-cube cssload-c4"></div>
        <div class="cssload-cube cssload-c3"></div>
    </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="/js/jquery-min.js"></script>
<script src="/js/tether.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/mixitup.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.slicknav.js"></script>
<script src="/js/jquery.nav.js"></script>
<script src="/js/smooth-scroll.js"></script>
<script src="/js/smooth-on-scroll.js"></script>
<script src="/js/wow.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>