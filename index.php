<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Foundation 4</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/colorbox.css">
    <link rel="stylesheet" href="lib/jquery.fancybox.css">
    <link rel="stylesheet" href="lib/Fancybox/helpers/jquery.fancybox-buttons.css">
    <link rel="stylesheet" href="lib/Fancybox/helpers/jquery.fancybox-thumbs.css">

    <script src="js/vendor/custom.modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/jquery.colorbox-min.js"></script>

    <script>
        document.write('<script src=' +
            ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
            '.js><\/script>')
    </script>
    <script src="js/foundation.min.js"></script>
    <script type="text/javascript">
        $(document).foundation();
    </script>
    <?php
        require './lib/facebook.php';
    ?>
</head>
<body>
<div class="row">
    <div class="large-12 columns">
        <div class="large-10 columns">
            <h2>Welcome to Foundation</h2>
            <p>This is version 4.3.2.</p>
        </div>
        <div class="large-2 columns">
            <p onclick="getLogout(this);" id="logout_button" style="cursor: pointer;">Logout</p>
        </div>
    </div>
    <hr />
</div>
<div class="row">
    <div class="large-12 columns">
    </div>
    <div class="large-12 columns">
        <h3>The Grid</h3>
        <!-- Grid Example -->
        <!--<div class="row">
            <div class="large-12 columns">
                <div class="panel">
                    <p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it's not required at all for the grid.</p>
                </div>
            </div>
        </div>-->
        <!--<div class="row">
            <div class="large-6 columns">
                <div class="panel">
                    <p>Six columns</p>
                </div>
            </div>
            <div class="large-6 columns">
                <div class="panel">
                    <p>Six columns</p>
                </div>
            </div>
        </div>-->
        <div class="row" id="thumbnail_list">
            <div class="large-4 columns">
                <div class="panel img-shadow">
                    <img id="coverpic" src="img/default.png" />
                    <p>Iron Man</p>
                </div>
            </div>
            <div class="large-4 columns">
                <div class="panel">
                    <p>Four columns</p>
                </div>
            </div>
            <div class="large-4 columns">
                <div class="panel">
                    <p>Four columns</p>
                </div>
            </div>
        </div>
        <h3>Buttons</h3>
        <div class="row">
            <div class="large-6 columns">
                <p><a href="javascript:void(0);" class="small button" onclick="goLogin();">Facebook Login</a></p>
                <p><a href="#" class="button">Medium Button</a></p>
                <p><a href="#" class="large button">Large Button</a></p>
            </div>
            <div class="large-6 columns">
                <p><a href="#" class="small alert button">Small Alert Button</a></p>
                <p><a href="#" class="success button">Medium Success Button</a></p>
                <p><a href="#" class="large secondary button">Large Secondary Button</a></p>
            </div>
        </div>
    </div>
</div>
<div style="display: none;" id="album_photos">

</div>
</body>
</html>