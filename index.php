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

    <script src="js/vendor/custom.modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script type="text/javascript" src="js/lightGallery.min.js"></script>
    <script type="text/javascript" src="js/masonry.min.js"></script>
    <script type="text/javascript" src="js/custom.js">  </script>


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