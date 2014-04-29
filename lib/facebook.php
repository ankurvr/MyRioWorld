<?php

    require __DIR__ . '/facebook_src/facebook.php';

    $facebook = new Facebook(array(
        'appId'  => '697462916966654',
        'secret' => '050ed09e8b63c32f511d9376a24ba55d',
    ));

?>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?php echo $facebook->getAppID() ?>',
            cookie: true,
            xfbml: true,
            oauth: true
        });
        FB.Event.subscribe('auth.login', function (response) {
            // do something with response
        });
    };

    (function () {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());

    function goLogin() {
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                $('#logout_button').show();
                getAlbums();
            }
            else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook,
                // but has not authenticated your app
            }
            else {
                FB.login(function (response) {
                    if (response.authResponse) {
                        $('#logout_button').show();
                        getAlbums();
                    }
                    else {
                        // The person cancelled the login dialog
                    }
                }, {scope: 'user_photos'});
            }
        });
    }



    function getAlbums() {
        FB.api('/me?fields=albums', function (response) {
            console.dir(response);
            if (typeof response.albums != "undefined") {

                setAlbums(response.albums.data);

            } else {
                $('#thumbnail_list').html('<div class="large-12 columns"><div class="panel"><p>No Albums Found</p></div></div>');
                return;
            }
        });
    }

    function setAlbums(data)
    {
        var size = data.length;
        var div = '';
        var i = 0;
        if (size > 0) {
            $('#thumbnail_list').html('');
            for (i = 0; i < size; i++)
            {
                div = '<div class="large-4 columns"><div class="panel img-shadow"><img id="'+ data[i].cover_photo +'" src="img/default.png" /><p>'+data[i]['name']+'</p></div></div>';
                $('#thumbnail_list').append(div);
                FB.api('/' + data[i].cover_photo, function (response)
                {
                    console.dir(response);
                    if (response && !response.error)
                    {
                        $('#'+response.id).attr('src', response.images[0]['source']);
                    }
                });
            }
        }
        else {
            $('#thumbnail_list').html('<div class="large-12 columns"><div class="panel"><p>No Albums Found</p></div></div>');
        }
    }

    function getLogout(element) {
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                FB.logout(function (response) {
                    $('#thumbnail_list').html('');
                    $('#thumbnail_list').append('<div class="large-4 columns"><div class="panel img-shadow"><p>You are successfully logged out.</p></div></div>');
                    $(element).hide();
                });
            }
            else
            {
                $(element).hide();
            }
        });
    }
</script>
