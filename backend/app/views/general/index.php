<?php
header("Location: https://insuranceperfectrades.com");
exit();
?>

<!doctype html>
<html lang="en">

<head>
    <title><?= SITE_TITLE; ?> - <?= $this->Util_model->get_option("site_tagline"); ?> </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/general/images/favicon.png" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/general/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/general/css/typography.css">
    <!-- style CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/general/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/general/css/responsive.css">
    <!-- Style customizer (Remove these two lines please) -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/general/javascript:void(0)" data-style="styles">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/general/css/style-customizer.css" />
    <!-- gsap -->
    <script src="<?= base_url(); ?>assets/general/gsap/gsap.min.js"></script>
    <!-- gsap -->
    <!-- swiper -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/general/swiper/swiper.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/general/swiper/swiper.min.css">
    <script src="<?= base_url(); ?>assets/general/swiper/swiper.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="<?= base_url(); ?>assets/general/https://www.googletagmanager.com/gtag/js?id=UA-113778816-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-113778816-1');
    </script> -->
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <style type="text/css">
        #trans-wrap {
            position: fixed;
            left: 0;
            padding: 10px 20px 0px;
            border-radius: 0px 20px 20px 0px;
            bottom: 17%;
            box-shadow: 0px 0px 10px #000;
            background: rgb(251, 185, 21);
            background: linear-gradient(to bottom, #FBB915, #C58E00);
            /* background: linear-gradient(90deg, 
            rgba(2, 0, 36, 1) 0%,
            rgba(16, 15, 96, 1) 0%,
            rgba(27, 27, 143, 1) 0%,
            rgba(40, 39, 128, 1) 0%,
            rgba(84, 135, 204, 1) 64%); */
            color: #ffffff;
            z-index: 1000;
            display: none;
        }

        #trans-wrap img {
            float: left;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        #trans-wrap p {
            float: left;
            margin-left: 10px;
            color: #ffffff;
            font-size: 12px;
        }

        #translator-wrap {
            position: fixed;
            left: -180px;
            padding: 5px 20px;
            border-radius: 0px 20px 20px 0px;
            bottom: 31%;
            box-shadow: 0px 0px 10px #000;
            background: rgb(255, 255, 255);
            background: linear-gradient(90deg,
                    rgba(2, 0, 36, 1) 0%,
                    rgba(16, 15, 96, 1) 0%,
                    rgba(27, 27, 143, 1) 0%,
                    rgba(40, 39, 128, 1) 0%,
                    rgba(84, 135, 204, 1) 64%);
            color: #ffffff;
            z-index: 1000;
        }

        #translator-wrap:hover {
            left: 0;
        }

        #translator-wrap #translator-element {
            position: relative;
            float: left;
            margin: 10px 20px 10px 0px;
        }

        #translator-wrap #translator-icon {
            position: relative;
            float: left;
            font-size: 8px;
            width: 30px;
        }
    </style>
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
_smartsupp.key = '21aba9a2ad84b7a6f6bdbbda711b2471628b11cc';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
</head>
<!-- onclick="show_trans()" onscroll="show_trans()" -->
<body >
    <!-- loading -->
    <div id="loading">
        <div id="loading-center">
            <img src="<?= base_url(); ?>assets/general/images/loader.gif" alt="loder">
        </div>
    </div>
    <!-- loading End -->
    <!-- Translator and transactions -->
    <div id="trans-wrap"></div>
    <!-- translator -->
    <div id="translator-wrap">
        <div id="translator-element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({ pageLanguage: 'en' }, 'translator-element');
                jQuery('.goog-logo-link').css('display', 'none');
                jQuery('.goog-te-gadget').css('font-size', '0');
            }
        </script>
        <div id="translator-icon">
            <img src="https://cdn0.iconfinder.com/data/icons/tuts/256/google_translate.png" width="30px"
                height="30px"><br>
            Translate
        </div>
    </div>
    <!-- Translator and transactions ends -->
    <!-- Header -->
    <header class="transparent">
        <div class="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="topbar-left">
                            <ul class="list-inline">
                                <li class="list-inline-item"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.60995 9.39382C11.9342 12.7171 12.6883 8.87243 14.8049 10.9875C16.8454 13.0275 18.0182 13.4362 15.4329 16.0208C15.109 16.281 13.0515 19.412 5.82067 12.1832C-1.41107 4.9535 1.71815 2.89387 1.97847 2.57012C4.57005 -0.0216324 4.97171 1.15798 7.01224 3.19794C9.1288 5.31391 5.28571 6.07051 8.60995 9.39382Z"
                                            stroke="#f9b707" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg> <?= $this->Util_model->get_option("site_phone"); ?></li>
                                <li class="list-inline-item ms-2"><svg width="16" viewBox="0 0 20 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.9188 6.37598L11.2161 9.38684C10.5165 9.94184 9.5322 9.94184 8.83262 9.38684L5.09863 6.37598"
                                            stroke="#f9b707" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.0906 16.5C16.625 16.507 18.3332 14.4246 18.3332 11.8653V6.14168C18.3332 3.58235 16.625 1.5 14.0906 1.5H5.90912C3.37466 1.5 1.6665 3.58235 1.6665 6.14168V11.8653C1.6665 14.4246 3.37466 16.507 5.90912 16.5H14.0906Z"
                                            stroke="#f9b707" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    customercare@<?= $this->Util_model->get_option("site_url"); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="topbar-right text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <ul class="list-inline iq-left">
                                        <li class="list-inline-item  d-flex">
                                            <?php if ($this->session->has_userdata(UID)): ?>
                                                <a href="<?= base_url(); ?>home">My Account</a>
                                            <?php else: ?>
                                                <a href="<?= base_url(); ?>sign-in">
                                                    <svg width="16" class="me-2" viewBox="0 0 17 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1772 9.01823H1.14307" stroke="#f9b707"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.7373 6.58838L11.1773 9.01838L8.7373 11.4484"
                                                            stroke="#f9b707" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M5.08691 5.15756V4.38006C5.08691 2.68423 6.46108 1.31006 8.15775 1.31006H12.2277C13.9194 1.31006 15.2902 2.68089 15.2902 4.37256V13.6559C15.2902 15.3517 13.9152 16.7267 12.2194 16.7267H8.14858C6.45775 16.7267 5.08691 15.3551 5.08691 13.6642V12.8792"
                                                            stroke="#f9b707" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>Sign In </a>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="<?= base_url(); ?>assets/general/home-1.html"><img id="logo_img" class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/logo-white.png" alt="logo"></a>
                        </div>
                        <nav> <a id="resp-menu" class="responsive-menu"
                                href="<?= base_url(); ?>assets/general/javascript:void(0)"><i class="fa fa-reorder"></i>
                                Menu</a>
                            <ul class="menu text-end">
                                <li><a class="active" href="<?= base_url(); ?>">HOME</a></li>
                                <li><a href="#features">FEATURES</a></li>
                                <li><a href="#market">MARKET</a></li>
                                <li><a href="#plan">PLANS</a></li>
                                <li><a href="#faq">FAQ</a></li>
                                <li><a href="#contact">CONTACT US</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Banner -->


    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide justify-content-around align-items-center">
                <div class="ban1-bgimg">
                    <img class="img-fluid banner-bg" src="<?= base_url(); ?>assets/general/images/banner/11.png" alt="">
                </div>
                <div class="banner-header">
                    <div class="iq-mb-20">
                        <h2 class="d-flex text-white" data-iq-gsap="onStart" data-iq-position-x="0"
                            data-iq-position-y="50" data-iq-duration="1" data-iq-delay=".7">Your Best Moves Now!</h2>
                        <h2 class="banner-title d-flex" data-iq-gsap="onStart" data-iq-position-x="0"
                            data-iq-position-y="50" data-iq-duration="1" data-iq-delay=".7">Easy And Secure.</h2>
                    </div>
                    <small class="banner-dec" data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50"
                        data-iq-duration="1" data-iq-delay=".8" class="my-5 iq-mt-20">Discover boundless opportunities
                        with our crypto investment platform. <br>Seamlessly navigate the dynamic world of digital
                        assets, making informed decisions <br>has never been easier. Experience unparalleled security as
                        you explore the future of finance. <br>Your best moves start here.</small>
                    <div class="iq-mt-20 d-flex banner-button" data-iq-gsap="onStart" data-iq-position-x="0"
                        data-iq-position-y="50" data-iq-duration="1" data-iq-delay="1.3" class="iq-mt-20">
                        <?php if ($this->session->has_userdata(UID)): ?>
                            <a href="<?= base_url(); ?>home" class="button">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">My Account</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url(); ?>sign-up" class="button m-1">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">Sign up</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>

                            <a href="<?= base_url(); ?>sign-in" class="button m-1">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">Sign in</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="banner-img-1">
                    <img data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1.2"
                        data-iq-delay="1.5" src="<?= base_url(); ?>assets/general/images/banner/03.png" alt="image">
                </div>
            </div>
            <!-- <div class="swiper-slide">
            <div class="ban1-bgimg">
                <img class="img-fluid banner-bg" src="<?= base_url(); ?>assets/general/images/banner/11.png" alt="">
            </div>
            <div class="banner-header-2">
                <h2 data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1" data-iq-delay=".6" class="future text-white">what are future</h2>
                <h2 data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1" data-iq-delay=".9" class="my-4 text-white">Buy, Sell, Exchange Bitcoins with CoinEx ! </h2>
                <div class="d-flex justify-content-center banner-img-3" data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1.5" data-iq-delay="1.2">
                    <img class="img-fluid  me-4" src="<?= base_url(); ?>assets/general/images/banner/05.png" alt="">
                    <img class="img-fluid  me-4" src="<?= base_url(); ?>assets/general/images/banner/06.png" alt="">
                    <img class="img-fluid  me-4" src="<?= base_url(); ?>assets/general/images/banner/05.png" alt="">
                    <img class="img-fluid " src="<?= base_url(); ?>assets/general/images/banner/05.png" alt="">
                </div>
            </div>
        </div> -->
            <div class="swiper-slide d-flex justify-content-around align-items-center">
                <div class="ban1-bgimg">
                    <img class="img-fluid banner-bg" src="<?= base_url(); ?>assets/general/images/banner/11.png" alt="">
                </div>
                <div class="banner-header-3">
                    <div class="banner-title-3 iq-mb-20">
                        <h2 data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1"
                            data-iq-delay=".7" class="d-flex text-white">Be Ready to fly with</h2>
                        <h2 data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50" data-iq-duration="1"
                            data-iq-delay=".7" class="banner-title d-flex"><?= SITE_TITLE; ?>.</h2>
                    </div>
                    <small class=" banner-dec" data-iq-gsap="onStart" data-iq-position-x="0" data-iq-position-y="50"
                        data-iq-duration="1" data-iq-delay="1">Unlock the potential of the digital frontier with
                        <?= SITE_TITLE; ?>. <br>Our cutting-edge crypto investment platform empowers you to soar to new
                        financial heights. <br>Seamlessly navigate the world of cryptocurrencies and seize opportunities
                        for growth with confidence and ease.</small>
                    <div class="d-flex iq-mt-20 banner-button" data-iq-gsap="onStart" data-iq-position-x="0"
                        data-iq-position-y="50" data-iq-duration="1.2" data-iq-delay="2">
                        <?php if ($this->session->has_userdata(UID)): ?>
                            <a href="<?= base_url(); ?>home" class="button">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">My Account</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url(); ?>sign-up" class="button m-1">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">Sign up</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                            <a href="<?= base_url(); ?>sign-in" class="button m-1">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">Sign in</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="banner-img-2">
                    <img data-iq-gsap="onStart" data-iq-position-y="50" data-iq-position-y="-50" data-iq-duration="2"
                        data-iq-delay="1" src="<?= base_url(); ?>assets/general/images/banner/04.png" alt="image">
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <!-- Banner End -->
    <!-- Topbar Chart -->
    <div class="topbar-chart iq-chart">
        <div class="container-fluid">
            <div class="row">
                <script>
                    baseUrl = "https://widgets.cryptocompare.com/";
                    var scripts = document.getElementsByTagName("script");
                    var embedder = scripts[scripts.length - 1];
                    var cccTheme = { "General": { "enableMarquee": true } };
                    (function () {
                        var appName = encodeURIComponent(window.location.hostname);
                        if (appName == "") { appName = "local"; }
                        var s = document.createElement("script");
                        s.type = "text/javascript";
                        s.async = true;
                        var theUrl = baseUrl + 'serve/v3/coin/header?fsyms=BTC,ETH,XMR,LTC,DASH&tsyms=BTC,USD,CNY,EUR';
                        s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                        embedder.parentNode.appendChild(s);
                    })();
                </script>
            </div>
        </div>
    </div>
    <!-- Topbar Chart End -->
    <!-- Main Content -->
    <div class="main-content">
        <!-- Easy Steps -->
        <section class="overview-block-ptb easy-step">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                Get Started</small>
                        </div>
                        <div class=" iq-mb-70">
                            <h2 class="title iq-mb-25">3 Easy Steps to Get Started</h2>
                            <p>Start Investing Today with 3 Simple Steps on Our User-Friendly Platform. Your Journey
                                Begins Here!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 iq-mt-20">
                        <div class="iq-features1">
                            <div class="iq-bg" style="background-image: url('images/feature/01.jpg');"></div>
                            <div class="iq-blog">
                                <div class="step">1</div>
                                <div class="icon mb-2"><img class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/home/icon/03.png" alt=""></div>
                                <h4 class="mt-4 mb-3"><a
                                        href="<?= base_url(); ?>assets/general/javascript:void(0)">Create An Account</a>
                                </h4>
                                <p>Create your account quickly to access our crypto investment platform and seize new
                                    opportunities.</p>
                                <a href="<?= base_url(); ?>sign-up">Sign Up <i aria-hidden="true"
                                        class="ion-ios-arrow-forward"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 iq-mt-20">
                        <div class="iq-features1">
                            <div class="iq-bg" style="background-image: url('images/feature/01.jpg');"></div>
                            <div class="iq-blog">
                                <div class="step">2</div>
                                <div class="icon mb-2"><img class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/home/icon/01.png" alt=""></div>
                                <h4 class="mt-4 mb-3"><a href="<?= base_url(); ?>assets/general/javascript:void(0)">Fund
                                        Your Account</a></h4>
                                <p>Easily deposit funds into your account using a range of trusted payment methods,
                                    ensuring hassle-free transactions.</p>
                                <a href="<?= base_url(); ?>fund">Fund Account <i aria-hidden="true"
                                        class="ion-ios-arrow-forward"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 iq-mt-20">
                        <div class="iq-features1">
                            <div class="iq-bg" style="background-image: url('images/feature/01.jpg');"></div>
                            <div class="iq-blog">
                                <div class="step">3</div>
                                <div class="icon mb-2"><img class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/home/icon/02.png" alt=""></div>
                                <h4 class="mt-4 mb-3"><a
                                        href="<?= base_url(); ?>assets/general/javascript:void(0)">Invest Your Funds</a>
                                </h4>
                                <p>Put your money to work by exploring a diverse selection of our investment options.
                                </p>
                                <a href="<?= base_url(); ?>forex-plan">Invest <i aria-hidden="true"
                                        class="ion-ios-arrow-forward"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Easy Steps -->
        <!-- About Us -->
        <section id="about" class="overview-block-ptb iq-bg iq-over-black-80 jarallax iq-about-us"
            style="background-image: url('<?= base_url(); ?>assets/general/images/bg/bg-13.jpg'); background-position: left center;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-md-12 iq-mb-80">
                        <div class="subtitle d-flex align-items-center  iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                About Us</small>
                        </div>
                        <h2 class="text-white ">Everything <br>
                            <span class="iq-font-yellow">You Need To Know!</span>
                        </h2>
                        <p class="text-white iq-mt-25">At <?= SITE_TITLE; ?>, we serve as your gateway to the exciting
                            world of cryptocurrency investments. With our blend of expertise and innovation, we provide
                            a secure and user-friendly platform for you to explore, invest, and nurture the growth of
                            your digital assets. Join us on this transformative financial journey and be a part of
                            shaping the future of global finance.</p>
                        <ul class="listing-hand text-white">
                            <li class="iq-mt-20">Registered under the UK Company House as a LLC</li>
                            <li class="iq-mt-20">Company registration number
                                <?= $this->Util_model->get_option("cert_no"); ?>
                            </li><br>
                            <li class="iq-mt-20">Incorporated on
                                <b><?= $this->Util_model->get_option("cert_date"); ?></b>
                            </li>

                        </ul>

                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12 iq-about1 iq-mb-80" style="padding:0px;">
                        <div class="calculator white-bg" style="padding:0px;">
                            <!-- <h3 class="iq-font-yellow mb-4">Bitcoin</h3>
                        <h5 class="mb-3">To Currency Calculator</h5>
                        <p>Lorem Idivsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p> -->
                            <a href="<?= base_url(); ?>assets/certificate.pdf" target="_blank">
                                <img src="<?= base_url(); ?>assets/img/certificate.jpg"
                                    style="width:100%; height:auto;">
                            </a>
                            <a class="button mt-4 text-center" href="<?= $this->Util_model->get_option("cert_link"); ?>"
                                target="_blank" style="width:100%">
                                <span class="button-inner-box">
                                    <span class="icon-one icon"><svg aria-hidden="true" focusable="false"
                                            data-prefix="fas" data-icon="long-arrow-alt-right" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                    <span class="text-btn">Verify Company Registration</span>
                                    <span class="icon-two icon"><svg aria-hidden="true" focusable="false"
                                            data-prefix="fas" data-icon="long-arrow-alt-right" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                            </path>
                                        </svg></span>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- About Us -->
        <!-- Features -->
        <section id="features" class="overview-block-ptb iq-feature-aria">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                Features</small>
                        </div>
                        <div class="text-center">
                            <h2 class="title iq-mb-25">Our Unique Features</h2>
                            <p>Explore our array of distinctive features designed to elevate your crypto investment
                                experience and unlock new opportunities in the ever-evolving digital landscape.</p>
                        </div>
                    </div>
                </div>
                <div class="row h-100">
                    <div class="col-lg-4 col-md-12 text-end">
                        <div class="d-flex align-items-center">
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a href="<?= base_url(); ?>assets/general/services-details.html"> Swift
                                        Transactions</a></h4>
                                <p>Enjoy rapid and seamless cryptocurrency transactions, ensuring your investments
                                    respond to market opportunities promptly.</p>
                            </div>
                            <div class="ms-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/01.png" alt="">
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a href="<?= base_url(); ?>assets/general/services-details.html">
                                        Robust Security</a></h4>
                                <p>Your investments are safeguarded by state-of-the-art measures, providing stability
                                    and peace of mind.</p>
                            </div>
                            <div class="ms-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/02.png" alt="">
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a href="<?= base_url(); ?>assets/general/services-details.html">
                                        Exceptional ROI</a></h4>
                                <p>Experience enticing returns on investment, fueled by our strategic approach to crypto
                                    opportunities.</p>
                            </div>
                            <div class="ms-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/03.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 align-self-center text-center">
                        <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/feature/features-img1.png"
                            alt="">
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/04.png" alt="">
                            </div>
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a
                                        href="<?= base_url(); ?>assets/general/services-details.html">Intuitive
                                        Interface</a></h4>
                                <p>Our user-friendly platform simplifies investing, making your investing journey
                                    accessible to all levels of experience.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/05.png" alt="">
                            </div>
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a
                                        href="<?= base_url(); ?>assets/general/services-details.html">Referral
                                        Rewards</a></h4>
                                <p>Invite others to join and earn rewards through our referral commission program,
                                    expanding your gains.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img class="img-fluid"
                                    src="<?= base_url(); ?>assets/general/images/services/icon/06.png" alt="">
                            </div>
                            <div class="iq-feature2 iq-mtb-20">
                                <h4 class="mb-3"><a href="<?= base_url(); ?>assets/general/services-details.html">24/7
                                        Support</a></h4>
                                <p>Our dedicated support team is available around the clock to address your inquiries
                                    and ensure a smooth experience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="particles text-center"><img class="img-fluid"
                            src="<?= base_url(); ?>assets/general/images/particles.png" alt=""></div>
                </div>
            </div>
        </section>
        <!-- Features -->
        <!-- Bitcoin Charts -->
        <section id="market" class="overview-block-ptb  grey-bg coinex-charts">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="subtitle d-flex align-items-center  iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                Market</small>
                        </div>
                        <div class="">
                            <h2 class="title  iq-mb-25">Crypto Market</h2>
                        </div>
                        <p>The cryptocurrency market continues to captivate global attention, with its dynamic and
                            ever-changing landscape. As new projects emerge and established coins assert their
                            dominance, investors are navigating a realm of potential and risk. The market's volatility
                            remains a defining trait, prompting both excitement and caution. Regulatory developments,
                            technological advancements, and shifting investor sentiment play pivotal roles in shaping
                            its trajectory. Whether you're an enthusiast, trader, or investor, staying informed and
                            adopting a strategic approach are essential in navigating the exciting yet unpredictable
                            world of cryptocurrencies.</p>
                        <a class="button mt-4" href="https://bitcoin.com" target="_blank">
                            <span class="button-inner-box">
                                <span class="icon-one icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                        </path>
                                    </svg></span>
                                <span class="text-btn">Buy Bitcoin</span>
                                <span class="icon-two icon"><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="long-arrow-alt-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                        </path>
                                    </svg></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 chart-img">
                        <!-- <div class="btcwdgt-chart" ></div> -->

                        <iframe src="./transaction-history-pane" style="width: 100%; border: 0; height: 250px;"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bitcoin Charts -->
        <!-- Counter -->
        <section class="overview-block-ptb iq-bg iq-over-black-80 jarallax iq-we-happy"
            style="background-image: url('<?= base_url(); ?>assets/general/images/bg/bg-5.png'); background-position: center center;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="text-white">We are the <span class="iq-font-yellow">best choice</span> for you
                            because:</h2>
                        <ul class="listing-hand iq-mt-30 text-white">
                            <li class="iq-mt-20">Our system crafts personalized portfolios, optimizing your investments
                                across a spectrum of assets to mitigate risk and enhance returns.</li>
                            <li class="iq-mt-20">Provides seamless navigation and intuitive controls, making managing
                                your portfolio effortless for investors of all backgrounds.</li>
                            <li class="iq-mt-20">Backed by a track record of consistent performance, our system's
                                strategies have delivered sustainable growth and stability, earning the trust of our
                                satisfied clients.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12 counter-blog">
                        <div class=" text-white">
                            <h3 class="title iq-mb-25 text-white">We're Fulfilled</h3>
                            <p>Empowering countless individuals like you, our system has been instrumental in staying
                                ahead of financial commitments, ensuring stability and progress in an ever-evolving
                                financial landscape.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-6 iq-mt-50">
                                <div class="counter"><i class="ion-ios-folder-outline iq-font-yellow"
                                        aria-hidden="true"></i>
                                    <div class="right text-start">
                                        <h3 class="timer text-white" data-to="1540" data-speed="10000">15140</h3>
                                        <small class="text-white">TRANSACTIONS</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6 iq-mt-50">
                                <div class="counter"> <i class="ion-ios-paper-outline iq-font-yellow"
                                        aria-hidden="true"></i>
                                    <div class="right text-start">
                                        <h3 class="timer text-white" data-to="2530" data-speed="10000">130</h3>
                                        <small class="text-white">AWARDS</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6 iq-mt-50">
                                <div class="counter"> <i class="ion-ios-person-outline iq-font-yellow"
                                        aria-hidden="true"></i>
                                    <div class="right text-start">
                                        <h3 class="timer text-white" data-to="8120" data-speed="10000">7820</h3>
                                        <small class="text-white">INVESTORS</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6 iq-mt-50">
                                <div class="counter"> <i class="ion-ios-star-outline iq-font-yellow"
                                        aria-hidden="true"></i>
                                    <div class="right text-start">
                                        <h3 class="timer text-white" data-to="1620" data-speed="10000">87</h3>
                                        <small class="text-white">COUNTRIES</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter -->
        <!-- Why us -->
        <section id="bonus" class="overview-block-ptb iq-why-us">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-6 col-md-12 ">
                        <div class="">
                            <div class="subtitle d-flex align-items-center  iq-font-yellow">
                                <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="4" height="4" fill="currentColor" />
                                    <rect y="6" width="4" height="4" fill="currentColor" />
                                    <rect x="6" width="4" height="4" fill="currentColor" />
                                    <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                                </svg>

                                <small class="text text-uppercase fw-bold iq-font-yellow">
                                    Bonuses</small>
                            </div>
                            <h2 class="title  iq-mb-25">Extra Rewards</h2>
                            <p>Outside our mouthwatering ROI, our users enjoy extra rewards in order to earn them more
                                money.</p>
                        </div>
                        <div class="iq-feature3 iq-mt-60">
                            <div class="iq-icon yellow-bg">
                                01
                            </div>
                            <div class="fancy-content">
                                <h4 class=" mb-3">Referral Bonus</h4>
                                <p>You will get <?= $this->Util_model->get_option("referral1"); ?>% of every investment
                                    by anyone you invited in the <?= SITE_TITLE; ?> platform.</p>
                            </div>
                        </div>
                        <div class="iq-feature3 iq-mtb-40">
                            <div class="iq-icon yellow-bg">
                                02
                            </div>
                            <div class="fancy-content">
                                <h4 class=" mb-3">Ranking Bonus</h4>
                                <p>You will get huge profit up to $75,000 when your networth (the total amount invested
                                    by your referrals) reaches a particular milestone.</p>
                            </div>
                        </div>
                        <div class="iq-feature3 iq-mb-80">
                            <div class="iq-icon yellow-bg">
                                03
                            </div>
                            <div class="fancy-content">
                                <h4 class=" mb-3">Reinvestment Bonus</h4>
                                <p>When you reinvest your capital after the duration of an investment,
                                    <?= $this->Util_model->get_option("reinvest_comm"); ?>% of the capital will be given
                                    to you as bonus.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <img src="<?= base_url(); ?>assets/general/images/about-us/about-img2.png" class="img-fluid"
                            alt="#">
                        <div class="iq-coin scrollme">
                            <span class="coin-01 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="0" data-translatey="-200" data-rotatez="180">
                                <img src="<?= base_url(); ?>assets/general/images/coin/01.png" class="img-fluid"
                                    alt="#">
                            </span>
                            <span class="coin-02 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="0" data-translatey="-250" data-rotatey="180">
                                <img src="<?= base_url(); ?>assets/general/images/coin/02.png" class="img-fluid"
                                    alt="#">
                            </span>
                            <span class="coin-03 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="50" data-translatey="-100">
                                <img src="<?= base_url(); ?>assets/general/images/coin/03.png" class="img-fluid"
                                    alt="#">
                            </span>
                            <span class="coin-04 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="0" data-translatey="-300" data-rotatez="180">
                                <img src="<?= base_url(); ?>assets/general/images/coin/04.png" class="img-fluid"
                                    alt="#">
                            </span>
                            <span class="coin-05 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="0" data-translatey="-100" data-rotatez="180">
                                <img src="<?= base_url(); ?>assets/general/images/coin/05.png" class="img-fluid"
                                    alt="#">
                            </span>
                            <span class="coin-06 animateme" data-when="span" data-from="0.9" data-to="0.1"
                                data-translatex="0" data-translatey="-100" data-rotatez="180">
                                <img src="<?= base_url(); ?>assets/general/images/coin/06.png" class="img-fluid"
                                    alt="#">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why us -->
        <!-- Team -->
        <!-- <section class="overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow"> 
                        <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="4" height="4" fill="currentColor"/>
                            <rect y="6" width="4" height="4" fill="currentColor"/>
                            <rect x="6" width="4" height="4" fill="currentColor"/>
                            <rect x="6" y="6" width="4" height="4" fill="currentColor"/>
                            </svg>
                            
                        <small class="text text-uppercase fw-bold iq-font-yellow"> 
                            Team</small>
                   </div>
                   <div class="text-center iq-mb-70">
                        <h2 class="title iq-mb-25">Our Investors</h2>
                        <p>Here is 3 Easy Steps to Busy & Sell Bitcoin. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="iq-team1 text-center iq-mtb-15">
                        <div class="team-blog">
                            <div class="team-images"> <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/team/01.jpg" alt=""> </div>
                            <div class="team-description">
                                <div class="mt-10">+0123 456 789</div>
                                <div class="text-white">support@bitcoin.com</div>
                            </div>
                            <div class="team-social">
                                <ul>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-facebook-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-twitter-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-rss-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-googleplus-outline"></i> </a> </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class=" iq-mt-10"><a href="<?= base_url(); ?>assets/general/team-details.html">Rinks Cooper</a></h5>
                        <small>CEO, CoinEx</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="iq-team1 text-center iq-mtb-15">
                        <div class="team-blog">
                            <div class="team-images"> <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/team/02.jpg" alt=""> </div>
                            <div class="team-description">
                                <div class="mt-10">+0123 456 789</div>
                                <div class="text-white">support@bitcoin.com</div>
                            </div>
                            <div class="team-social">
                                <ul>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-facebook-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-twitter-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-rss-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-googleplus-outline"></i> </a> </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class=" iq-mt-10"><a href="<?= base_url(); ?>assets/general/team-details.html">JD Scot</a></h5>
                        <small>CEO, CoinEx</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="iq-team1 text-center iq-mtb-15">
                        <div class="team-blog">
                            <div class="team-images"> <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/team/03.jpg" alt=""> </div>
                            <div class="team-description">
                                <div class="mt-10">+0123 456 789</div>
                                <div class="text-white">support@bitcoin.com</div>
                            </div>
                            <div class="team-social">
                                <ul>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-facebook-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-twitter-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-rss-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-googleplus-outline"></i> </a> </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class=" iq-mt-10"><a href="<?= base_url(); ?>assets/general/team-details.html">Haris Morgan</a></h5>
                        <small>CEO, CoinEx</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="iq-team1 text-center iq-mtb-15">
                        <div class="team-blog">
                            <div class="team-images"> <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/team/04.jpg" alt=""> </div>
                            <div class="team-description">
                                <div class="mt-10">+0123 456 789</div>
                                <div class="text-white">support@bitcoin.com</div>
                            </div>
                            <div class="team-social">
                                <ul>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-facebook-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-twitter-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-rss-outline"></i> </a> </li>
                                    <li> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"> <i class="ion-social-googleplus-outline"></i> </a> </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class=" iq-mt-10"><a href="<?= base_url(); ?>assets/general/team-details.html">Nik Jorden</a></h5>
                        <small>CEO, CoinEx</small>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
        <!-- Team -->
        <!-- Plan -->
        <section id="plan" class="overview-block-ptb iq-bg iq-over-black-80 jarallax"
            style="background-image: url('<?= base_url(); ?>assets/general/images/bg/bg-7.jpg'); background-position: center center;">
            <div class="container">
                <div class="row" style="color:#ffffff;">
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                Plans</small>
                        </div>
                        <div class="text-center iq-mb-70">
                            <h2 class="title  iq-mb-25" style="color:#ffffff;">Investment Plans</h2>
                            <p class="mb-0">Explore Our Tailored Investment Plans for Your Financial Growth and
                                Prosperity.</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php
                    $s = $this->Db_model->selectGroup("*", "plans", "WHERE fid=0 AND status=1");
                    foreach ($s->result_array() as $row):
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="position-relative mb-4 mb-md-0">
                                <div class="pricing <?php echo ($row["id"] == 3) ? "active" : ""; ?>">
                                    <h2 class="mb-2"><?php echo $row['roi']; ?>%<small>/day</small></h2>
                                    <p class="mb-0"><?php echo $row['short_desc']; ?></p>

                                    <div class="sale-box">
                                        <span class="sale-text">FEATURED</span>
                                    </div>
                                </div>
                                <div class="pricing-btn">
                                    <button type="submit"
                                        class="button <?php echo ($row["id"] == 3) ? "bg-primary" : ""; ?> dark white rounded-pill text-uppercase"><?php echo strtoupper($row['name']); ?></button>
                                </div>
                                <div class="iq-pricing-detail text-center">
                                    <p><i class="fa fa-dollar"></i><?php echo number_format($row['min_amt']); ?> - <i
                                            class="fa fa-dollar"></i><?php echo number_format($row['max_amt']); ?></p>
                                    <hr>
                                    <p style="margin-top:10px">Duration <?php echo $row['duration']; ?> Days <i
                                            class="fa fa-info-circle"
                                            title="The investment will last for a period of 120 forex days (Mon. to Fri.) before the you can cashout your capital"
                                            data-toggle="tooltip"></i></p>
                                    <hr>
                                    <p style="margin-top:10px">Total Cashout <?php echo $row['cashout']; ?>% <i
                                            class="fa fa-info-circle"
                                            title="While cashing out your capital, you can only get <?php echo $row['cashout']; ?>% of the invested capital"
                                            data-toggle="tooltip"></i></p>
                                    <!-- <a class="button" href="javascript:void(0)">Purchase now</a> -->
                                    <a class="button mt-4" href="<?php echo base_url(); ?>forex-plan">
                                        <span class="button-inner-box">
                                            <span class="icon-one icon"><svg aria-hidden="true" focusable="false"
                                                    data-prefix="fas" data-icon="long-arrow-alt-right" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                                    </path>
                                                </svg></span>
                                            <span class="text-btn">Invest now</span>
                                            <span class="icon-two icon"><svg aria-hidden="true" focusable="false"
                                                    data-prefix="fas" data-icon="long-arrow-alt-right" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                                                    </path>
                                                </svg></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Plan -->
        <!-- Testimonial -->
        <!-- <div class=" overview-block-ptb grey-bg" style="background-image: url('images/bg/bg-15.png'); background-position: center center;background-size: contain;background-repeat: no-repeat;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 text-center">
                    <img src="<?= base_url(); ?>assets/general/images/speack.png" alt="">
                    <div class="iq-testimonial text-center">
                        <div id="testimonial-slider" class="owl-carousel owl-theme owl-loaded" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="30">
                            <div class="testimonial ">
                                <p class="description ">
                                    “Bitcoin has no physical form - it technically exists online as a complete digital asset. If you do see it, it is in the form of lines of code in an alphanumeric string. But the bottom line is, it is a store of value void of manipulation by government.”
                                </p>
                                <h5 class="fw-bold ">Rinks Cooper</h5>
                                <small>CEO, CoinEx</small>
                            </div>
                            <div class="testimonial ">
                                <p class="description ">
                                    “Bitcoin has no physical form - it technically exists online as a complete digital asset. If you do see it, it is in the form of lines of code in an alphanumeric string. But the bottom line is, it is a store of value void of manipulation by government.”
                                </p>
                                <h5 class=" fw-bold">JD Scot</h5>
                                <small>CEO, CoinEx</small>
                            </div>
                            <div class="testimonial ">
                                <p class="description ">
                                    “Bitcoin has no physical form - it technically exists online as a complete digital asset. If you do see it, it is in the form of lines of code in an alphanumeric string. But the bottom line is, it is a store of value void of manipulation by government.”
                                </p>
                                <h5 class=" fw-bold">Haris Morgan</h5>
                                <small>CEO, CoinEx</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <!-- Testimonial -->
        <!-- Latest News -->
        <!-- <div class="iq-news overview-block-ptb ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                        <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow"> 
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor"/>
                                <rect y="6" width="4" height="4" fill="currentColor"/>
                                <rect x="6" width="4" height="4" fill="currentColor"/>
                                <rect x="6" y="6" width="4" height="4" fill="currentColor"/>
                                </svg>
                                
                            <small class="text text-uppercase fw-bold iq-font-yellow"> 
                                Blogs</small>
                       </div>
                       <div class="text-center iq-mb-70">
                            <h2 class="title  iq-mb-25">Latest News</h2>
                            <p class="mb-0">Here is 3 Easy Steps to Busy & Sell Bitcoin. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                       </div>
                        
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="iq-news-box">
                        <div class="iq-news-image clearfix">
                            <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/blog/01.jpg" alt="#">
                            <div class="news-date"><small><i class="fa fa-calendar" aria-hidden="true"></i> 12 Aug</small></div>
                        </div>
                        <div class="iq-news-detail iq-pall-30 grey-bg">
                            <div class="news-title mb-4 mt-3"> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"><h5 class="">How One Fund Used the Carry Trade to Beat</h5> </a> </div>
                            <div class="d-flex align-items-center mt-2">
                                <small class="border-end pe-2">Power by:Michale Scott</small>
                                <small class="iq-font-yellow  ms-2 ">Business</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="iq-news-box">
                        <div class="iq-news-image clearfix">
                            <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/blog/02.jpg" alt="#">
                            <div class="news-date"><small><i class="fa fa-calendar" aria-hidden="true"></i> 13 Aug </small></div>
                        </div>
                        <div class="iq-news-detail iq-pall-30 grey-bg">
                            <div class="news-title mb-4 mt-3"> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"><h5 class="">The Best Set and Forget Strategies for Investing</h5> </a> </div>
                            <div class="d-flex align-items-center mt-2">
                                <small class="border-end pe-2">Power by:Michale Scott</small>
                                <small class="iq-font-yellow  ms-2 ">Business</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="iq-news-box">
                        <div class="iq-news-image clearfix">
                            <img class="img-fluid" src="<?= base_url(); ?>assets/general/images/blog/03.jpg" alt="#">
                            <div class="news-date"><small><i class="fa fa-calendar" aria-hidden="true"></i> 14 Aug</small></div>
                        </div>
                        <div class="iq-news-detail iq-pall-30 grey-bg">
                            <div class="news-title mb-4 mt-2"> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"><h5 class="">What is Central Bank Digital Currency (CBDC)?</h5> </a> </div>
                            <div class="d-flex align-items-center mt-2">
                                <small class="border-end pe-2">Power by:Michale Scott</small>
                                <small class="iq-font-yellow  ms-2 ">Business</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <!-- Latest News -->
        <!-- Faq's -->
        <section id="faq" class="iq-faqs overview-block-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="subtitle d-flex align-items-center  justify-content-center iq-font-yellow">
                            <svg width="10" class="me-2" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="currentColor" />
                                <rect y="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" width="4" height="4" fill="currentColor" />
                                <rect x="6" y="6" width="4" height="4" fill="currentColor" />
                            </svg>

                            <small class="text text-uppercase fw-bold iq-font-yellow">
                                FAQ</small>
                        </div>
                        <div class="text-center iq-mb-70">
                            <h2 class="title  iq-mb-25">Frequently Asked Questions</h2>
                            <p class="mb-0">We have provided the answers to the most common questions asked by our users
                                in order to answer most of your questions.</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <div>
                                        <a data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            What is <?php echo SITE_TITLE; ?>?
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p style="margin-top: 20px;"><?php echo SITE_TITLE; ?> is a wealth management
                                            and capital investment company located in
                                            <?php echo $this->Util_model->get_option('site_address'); ?>. Incorporated
                                            in the year 2018.
                                        </p>
                                        <p style="margin-top: 20px;">We indulge ourselves with Real Estate Investment,
                                            Crypto Currency Investment, Forex Trading.</p>
                                        <p style="margin-top: 20px;"><?php echo SITE_TITLE; ?> allow investors to
                                            participate and benefit from the company using cryptocurrency as mode of
                                            payment.</p>
                                        <p style="margin-top: 20px;"><?php echo SITE_TITLE; ?> have three(4) major
                                            investment packages; All packages mature within the package interval</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <div>
                                        <a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            How Do I Get Started?
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>To get started with <?php echo SITE_TITLE; ?>, simply navigate or click on <a
                                                href="<?php echo base_url(); ?>sign-up">Sign Up</a> fill in your
                                            details. >>> verify your email address and login to your dashbaord.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <div>
                                        <a class="collapsed" data-bs-toggle="collapse" href="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            How Do I Make Deposit To My Account After Sign Up?
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>To deposit into your <?php echo SITE_TITLE; ?> account follow the steps
                                            below:</p>
                                        <ol>
                                            <li>Sign into your account</li>
                                            <li>Click the <a href="<?php echo base_url(); ?>fund"><b>Fund
                                                        Account</b></a> link</li>
                                            <li>Enter the amount you wish to deposit and proceed</li>
                                            <li>Copy the wallet address or scan the QR code and send the bitcoin to it
                                            </li>
                                            <li>You deposited amount will be funded automatically</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <div>
                                        <a class="collapsed" data-bs-toggle="collapse" href="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            How Can I Invest?
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <ol>
                                            <li>Ensure you have money in your balance</li>
                                            <li>Click the <b>Invest</b> button or link in the menu</li>
                                            <li>Select your preferred plan</li>
                                            <li>Enter the amount you wish to invest</li>
                                            <li>Click the <b>Invest</b> button and that's all</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingFive">
                                    <div>
                                        <a class="collapsed" data-bs-toggle="collapse" href="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            How Long Will It Take To Withdraw My Earnings?
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p>In <?php echo SITE_TITLE; ?> withdrawal interval depends on the plan of your
                                            investment. You will always have continuous withdrawal as long as you have
                                            active investment in the system.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Faq's -->
        <!-- Contact Us -->
        <section id="contact" class="overview-block-ptb iq-bg iq-over-black-80 jarallax"
            style="background-image: url('<?= base_url(); ?>assets/general/images/bg/bg-2.jpg'); background-position: center center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-8 text-center iq-need-help">
                        <img src="<?= base_url(); ?>assets/general/images/need-help.png" alt="">
                        <h2 class="iq-font-yellow iq-mt-25">Any Query? Contact Us</h2>
                        <ul class="list-inline iq-mt-60 mb-4">
                            <li class="list-inline-item iq-font-yellow"><i class="fa fa-phone me-2"
                                    aria-hidden="true"></i> <?= $this->Util_model->get_option("site_phone"); ?></li>
                            <li class="list-inline-item text-white ms-3"><i class="fa fa-envelope-open me-2"
                                    aria-hidden="true"></i>customercare@<?= $this->Util_model->get_option("site_url"); ?></li>
                        </ul>
                        <div class="text-white iq-mt-10">Our trained and dedicated team of support are available 247 to
                            answer your questions and assist you in case of any difficulty on the live chat.</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us -->
        <!-- Clients -->
        <div class="iq-our-clients particles-bg yellow-bg iq-ptb-60">
            <canvas id="canvas"></canvas>
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false"
                            data-dots="false" data-items="5" data-items-laptop="4" data-items-tab="3"
                            data-items-mobile="2" data-items-mobile-sm="1" data-margin="30">
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/mastercard-1.png"
                                        alt="#"></a></div>
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/visa.png"
                                        alt="#"></a></div>
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/paypal.png"
                                        alt="#"></a></div>
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/comodo-secure.png"
                                        alt="#"></a></div>
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/bitcoin.png"
                                        alt="#"></a></div>
                            <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img
                                        class="img-fluid"
                                        src="<?= base_url(); ?>assets/general/images/clients/white/commission.png"
                                        alt="#"></a></div>
                            <!-- <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/01.png" alt="#"></a></div>
                        <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/02.png" alt="#"></a></div>
                        <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/03.png" alt="#"></a></div>
                        <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/04.png" alt="#"></a></div>
                        <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/05.png" alt="#"></a></div>
                        <div class="item"> <a href="<?= base_url(); ?>assets/general/clients.html"><img class="img-fluid" src="<?= base_url(); ?>assets/general/images/clients/white/06.png" alt="#"></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Clients -->
    </div>
    <!-- Main Content End -->
    <!--=================================
Footer -->
    <footer class="iq-footer dark-bg iq-footer-2">
        <div class="footer-top iq-bg-fixed ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 iq-mtb-90">
                        <div class="logo">
                            <img id="logo_img_2" class="img-fluid"
                                src="<?= base_url(); ?>assets/general/images/logo-white.png" alt="# ">
                            <div class="text-white iq-mt-25 ">Partnering with us ensures your daily cryptocurrency
                                profits, backed by our expertise and commitment to financial growth.</div>
                            <ul class="iq-media-blog iq-mt-30 float-start">
                                <li><a href="<?= base_url(); ?>assets/general/javascript:void(0)" class="rounded"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a href="<?= base_url(); ?>assets/general/javascript:void(0)" class="rounded"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="<?= base_url(); ?>assets/general/javascript:void(0)" class="rounded"><i
                                            class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12  iq-contact iq-mtb-90 footer-menu-list">
                        <h5 class="small-title text-white widget-title">USEFUL LINKS</h5>
                        <div class="d-flex align-items-center flex-wrap">
                            <ul class="iq-pl-0 ">
                                <li><a href="#about"><i class="fa fa-angle-right me-2" aria-hidden="true"></i>About
                                        Us</a></li>
                                <li><a href="#feature"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Features</a></li>
                                <li><a href="#market"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Market</a></li>
                                <li><a href="#plan"><i class="fa fa-angle-right me-2" aria-hidden="true"></i>Plan</a>
                                </li>
                                <li><a href="#faq"><i class="fa fa-angle-right me-2" aria-hidden="true"></i>FAQ</a></li>
                                <li><a href="#contact"><i class="fa fa-angle-right me-2" aria-hidden="true"></i>Contact
                                        Us</a></li>
                            </ul>
                            <ul class="ms-5">
                                <li><a href="<?= base_url(); ?>home"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>My Account</a></li>
                                <li><a href="<?= base_url(); ?>fund"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Deposit</a></li>
                                <li><a href="<?= base_url(); ?>forex-plan"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Invest</a></li>
                                <li><a href="<?= base_url(); ?>withdraw"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Withdraw</a></li>
                                <li><a href="<?= base_url(); ?>fund-list"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>Transactions</a></li>
                                <li><a href="<?= base_url(); ?>info"><i class="fa fa-angle-right me-2"
                                            aria-hidden="true"></i>My Profile</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 iq-contact iq-mtb-90">
                        <h5 class="small-title text-white widget-title">CONTACT</h5>
                        <div class="iq-mb-30">
                            <div class="blog"><i class="ion-ios-telephone-outline"></i>
                                <div class="content ">
                                    <div class=" title ">Phone</div> <?= $this->Util_model->get_option("site_phone"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="iq-mb-30">
                            <div class="blog "><i class="ion-ios-email-outline"></i>
                                <div class="content ">
                                    <div class=" title ">Mail</div>
                                    customercare@<?= $this->Util_model->get_option("site_url"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="blog"><i class="ion-ios-location-outline"></i>
                            <div class="content ">
                                <div class=" title ">Address</div> <?= $this->Util_model->get_option("site_address"); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom iq-ptb-20 ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="iq-copyright iq-mt-10 text-white text-center">&copy; Copyright <span id="copyright">
                                <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                            </span> <a href="<?= base_url(); ?>assets/general/javascript:void(0)"><?= SITE_TITLE; ?></a>
                            All Rights Reserved </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=================================
Footer -->

    <!-- back-to-top -->
    <div id="back-to-top">
        <a class="top" id="top" href="<?= base_url(); ?>assets/general/#top"> <i class="ion-ios-upload-outline"></i>
        </a>
    </div>
    <!-- back-to-top End -->

    <!-- style-customizer -->
    <!-- <div class="iq-customizer closed">
        <div class="buy-button"> <a class="opener" href="<?= base_url(); ?>assets/general/javascript:void(0)"><i class="fa fa-spinner fa-spin"></i></a> </div>
        <div class="clearfix content-chooser">
            <h3 class="iq-font-black">CoinEX Awesome Color</h3>
            <p>With coinex, you can buy, sell, trade, and earn cryptocurrencies and manage your Transaction most efficiently and securely. </p>
            <ul class="iq-colorChange clearfix">
                <li class="color-1 selected" data-style="color-1"></li>
                <li class="color-2" data-style="color-2"></li>
                <li class="color-3" data-style="color-3"></li>
                <li class="color-4" data-style="color-4"></li>
                <li class="color-5" data-style="color-5"></li>
                <li class="color-6" data-style="color-6"></li>
                <li class="color-7" data-style="color-7"></li>
                <li class="color-8" data-style="color-8"></li>
                <li class="color-9" data-style="color-9"></li>
                <li class="color-10" data-style="color-10"></li>
            </ul>
            <a target="_blank" class="button" href="<?= base_url(); ?>assets/general/https://1.envato.market/MXNo22?u=https%3A%2F%2Fthemeforest.net%2Fcheckout%2Ffrom_item%2F21176834%3Flicense%3Dregular">Purchase Now</a>
        </div>
    </div> -->
    <!-- style-customizer END -->
    <!-- jquery-min JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/jquery-min.js"></script>
    <!-- popper JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/bootstrap.min.js"></script>
    <!-- Bitcoin widget JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/widget.js"></script>
    <!-- owl carousel JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/owl.carousel.min.js"></script>
    <!-- All-plugins JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/all-plugins.js"></script>
    <!-- particles JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/particles.js"></script>
    <!-- Style Customizer -->
    <script src="<?= base_url(); ?>assets/general/js/style-customizer.js"></script>
    <!-- REVOLUTION JS FILES -->
    <!-- Custom JavaScript -->
    <script src="<?= base_url(); ?>assets/general/js/custom.js"></script>
    <!-- Gsap animation -->

    <script>
        if (typeof ScrollTrigger !== typeof undefined) {
            gsap.registerPlugin(ScrollTrigger);
        }

        const gsapAnimate = {
            getData: (elem) => {
                const option = {
                    opacity: 0,
                    scale: 1,
                    position: {
                        x: 0,
                        y: 0,
                    },
                    ease: "",
                    duration: 1,
                    delay: .4,
                    rotate: 0
                }
                if (elem !== undefined) {
                    option.position.x = gsapAnimate.validValue(elem.dataset.iqPositionX, 0)

                    option.position.y = gsapAnimate.validValue(elem.dataset.iqPositionY, 0)

                    option.rotate = gsapAnimate.validValue(elem.dataset.iqRotate, 0)

                    option.scale = gsapAnimate.validValue(elem.dataset.iqScale, 1)

                    option.opacity = gsapAnimate.validValue(elem.dataset.iqOpacity, 0)

                    option.delay = gsapAnimate.validValue(elem.dataset.iqDelay, .4)

                    option.duration = gsapAnimate.validValue(elem.dataset.iqDuration, 1.5)

                    option.ease = gsapAnimate.validValue(elem.dataset.iqEase, '')

                    const setOption = { opacity: option.opacity, scale: option.scale, x: option.position.x, y: option.position.y, ease: option.ease, rotate: option.rotate, duration: option.duration, delay: option.delay }

                    if (typeof ScrollTrigger !== typeof undefined) {
                        if (elem.dataset.iqTrigger == 'scroll') {
                            const scrub = elem.dataset.iqScrollScrub === 'true' ? true : false

                            setOption.scrollTrigger = {
                                trigger: elem,
                                start: () => "top 90%",
                                end: () => "bottom 10%",
                                scrub: scrub,
                                markers: false
                            }
                        }
                    }

                    return setOption
                } else {
                    return { opacity: 0 }
                }
            },
            onStart: (elem) => {

                const setOption = gsapAnimate.getData(elem)

                gsap.from(elem, setOption)

            },

            onEnd: (elem) => {

                const setOption = gsapAnimate.getData(elem)

                gsap.to(elem, setOption)

            },

            onStartEnd: (elem) => {

                const setOption = gsapAnimate.getData(elem)

                const setEndOption = gsapAnimate.getData(elem)

                setEndOption.opacity = 1

                setEndOption.x = 0

                setEndOption.y = 0

                setEndOption.rotate = 0

                setEndOption.scale = 1

                gsap.fromTo(elem, setOption, setEndOption)
            },
            validValue: (attr, defaultVal) => {
                if (attr !== undefined && attr !== null) {
                    return Number(attr)
                }
                return Number(defaultVal)
            }
        }


        function animationInit() {

            const gsapElem = document.querySelector('.swiper .swiper-slide-active').querySelectorAll('[data-iq-gsap="onStart"]')

            Array.from(gsapElem, (elem) => {
                gsapAnimate.onStartEnd(elem)
            })
        }

        // Init Code

    </script>

    <!-- Initialize Swiper -->
    <script src="<?= base_url(); ?>assets/general/swiper/swiper.js"></script>

    <script>
        var transStarted = 0;

        function show_trans() {
            if (transStarted == 0) {
                $.post("<?php echo base_url(); ?>ajax/list-ex-trans", "", function (data) {
                    var trans = data;
                    if (data.length > 0) {
                        var count = 0;
                        $("#trans-wrap").html(data[count]);
                        $("#trans-wrap").fadeIn(500);
                        setInterval(function () {
                            $("#trans-wrap").fadeOut(500, function () {
                                $("#trans-wrap").html(data[count]);
                            });
                            $("#trans-wrap").fadeIn(500);
                            count++;
                            if (count == data.length) {
                                clearInterval();
                            }
                        }, 6000);
                    }
                    transStarted = 1;
                }, "json");
            }

        }
    </script>
</body>

</html>