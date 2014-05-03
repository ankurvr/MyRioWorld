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

    var albums = new Array();

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
            //console.dir(response);
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
                div = '<div class="large-4 columns" onclick="getAlbumPhotos('+ data[i].id +', \'popup\')"><div class="panel img-shadow"><img id="'+ data[i].cover_photo +'" src="img/default.png" /><p style="float: left;margin-top:7px;">'+data[i]['name']+'</p><input style="float: right;" type="checkbox" id="'+data[i].id+'"><div class="clear"></div><p><a href="#" class="small button">Download This Album</a></p></div></div>';
                $('#thumbnail_list').append(div);
                FB.api('/' + data[i].cover_photo, function (response)
                {
                    if (response && !response.error)
                    {
                        $('img#'+response.id).attr('src', response.images[0]['source']);
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

    function getAlbumPhotos(album_id, type)
    {
        FB.api('/' + album_id+'/photos', function (response)
        {
            if (response && !response.error)
            {
                var count = response.data.length;
                var album_images, i;

                if(type == 'popup')
                {
                    $('#album_photos').html('');
                }
                else
                {
                    albums['abl_'+album_id] = [];
                }
                for(i=0;i<count;i++)
                {
                    if(type == 'popup')
                    {
                        album_images = '<a class="my_album" href=":src" title=""></a>';
                        album_images = album_images.replace(':src', response.data[i]['source']);
                        $('#album_photos').append(album_images);
                    }
                    else
                    {
                        albums[album_id].push(response.data[i]['source']);
                    }
                }
                if(type == 'popup')
                {
                    $(".my_album").colorbox({
                        rel:'my_album',
                        loop: true,
                        slideshow: true,
                        slideshowSpeed: 2500,
                        slideshowAuto: true,
                        slideshowStart: 'Start',
                        slideshowStop: 'Stop'
                    });
                    $('#album_photos > a:first').click();
                }
            }
        });
    }

    function getSelected()
    {
        var n = $('input:checkbox:checked').length;
        if(n > 0)
        {
            $('input:checkbox:checked').each(function()
            {
                getAlbumPhotos($(this).attr("id"), 'array');
            });
            document.getElementById('array').innerHTML = albums;
            console.log(albums);
        }
        else
        {
            alert("Please select any one album to download");
        }
    }
</script>