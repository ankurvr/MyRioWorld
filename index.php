<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Foundation 4</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/lightGallery.css">
    <link rel="stylesheet" type="text/css" href="css/sevenslider.css">
    <link href="css/slider/transformer.css" rel="stylesheet" />

    <script src="js/vendor/custom.modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script type="text/javascript" src="js/lightGallery.min.js"></script>
    <script type="text/javascript" src="js/masonry.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type='text/javascript' src='js/slider/jquery.flexslider-min.js'></script>
    <script type='text/javascript' src='js/slider/jquery.seven.min.js'></script>
    <script type='text/javascript' src='js/slider/jquery.reference.js'></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            var tb = $("#seven_container_home").superseven({width: 1920, height: 600, autoplay: false, interval: 5, fullwidth: true, responsive: true, progressbar: true, swipe: true, keyboard: false, scrollmode: false, animation: 300, navtype: 1, repeat_mode: true, lightbox: true, pause_on_hover: true});
        });
    </script>

    <script>
        document.write('<script src=' +
            ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
            '.js><\/script>')
    </script>
    <script src="js/foundation.min.js"></script>
    <script type="text/javascript">
        $(document).foundation();

        $(document).ready(function(){
            setTimeout(function(){
                $('#FBLoginBtn').click();
            }, 1000);
        });
    </script>
    <?php
        require './lib/facebook.php';
    ?>
</head>
<body>
<div class="fixed">
    <div class="row">
        <nav class="top-bar" data-topbar>
            <div class="contain-to-grid row">
                <ul class="title-area">
                    <li class="name"><a href="#"><img src="img/my_rio_logo.png" /></a></li>
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                    <li class="toggle-topbar menu-icon left"><a href="#"><span>Menu</span></a></li>
                </ul>
                <section class="top-bar-section"> <!-- Right Nav Section -->
                    <ul class="right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">About me</a></li>
                        <li class="has-dropdown"><a href="#">FB Gallery</a>
                            <ul class="dropdown">
                                <li><a href="#">Album-1</a></li>
                                <li><a href="#">Album-2</a></li>
                                <li><a href="#">Album-3</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Contact me</a></li>
                    </ul>
                </section>
            </div>
        </nav>
    </div>
</div>
<div id="wrapper">
    <div id="sliders-container"></div>
    <div id="main" style="overflow:hidden !important;">
        <div class="avada-row">
            <div id="content" class="full-width">
                <div id="post-5" class="post-5 page type-page status-publish hentry">
                    <div class="post-content">
                        <div class="wpb_row vc_row-fluid">
                            <div class="vc_span12 wpb_column column_container">
                                <div class="wpb_wrapper">
                                    <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                                        <div class="wpb_wrapper"></div>
                                    </div>
                                    <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                                        <div class="wpb_wrapper">
                                            <style type="text/css">
                                                #main{padding:0 !important;background-color:#fff !important}#main .avada-row{max-width:100% !important;padding:0 !important;margin:0 !important}
                                            </style>
                                            <div class="seven_container" id="seven_container_home" style="margin-top:-30px;">
                                                <div id="seven_viewport" class="seven_viewport">
                                                    <div class="seven_slider">
                                                        <div class="seven_slide" data-animation="117" data-caption="We are watchers and protectors" image-src="img/slider/26.jpg"></div>
                                                        <div class="seven_slide" data-animation="118" data-caption="We will defend the world at all the cost" image-src="img/slider/27.jpg"></div>
                                                        <div class="seven_slide" data-animation="119" data-caption="I love Rock & Roll" image-src="img/slider/28.jpg"></div>
                                                        <div class="seven_slide" data-animation="120" data-caption="Who will own the world?" image-src="img/slider/29.jpg"></div>
                                                        <div class="seven_slide" data-animation="116" data-caption="We are watchers and protectors" image-src="img/slider/30.jpg"></div>
                                                    </div>
                                                </div>
                                                <a id="left_btn" class="seven_nav">Previous Slide</a> <a id="right_btn" class="seven_nav right_btn">Next Slide</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>The Grid</h3>
        <div class="row" id="thumbnail_list">
            <div class="large-4 columns">
                <div class="panel img-shadow">
                    <img id="coverpic" src="img/default.png" />
                    <p style="float: left;">Iron Man</p>
                    <input style="float: right;" type="checkbox">
                    <div class="clear"></div>
                    <p><a href="javascript:void(0);" class="small button">Download This Album</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="large-12 columns">
        <p><a href="javascript:void(0);" class="button" onclick="getSelected()">Download Selected Albums</a></p>
        <p><a href="javascript:void(0);" class="small button" id="FBLoginBtn" onclick="goLogin();">Facebook Login</a></p>
    </div>
</div>
<div id="array"></div>
<div style="display: none;" id="album_photos">
    <ul id="my_slideshow"></ul>
</div>
</body>
</html>