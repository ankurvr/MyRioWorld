<?php

    set_include_path('./lib');

    require_once './lib/Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata_Photos');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_AuthSub');

    $serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
    $user = "ankur@kintudesigns.com";
    $pass = "Ank@r101";

    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);

    // update the second argument to be CompanyName-ProductName-Version
    $gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");

    // In version 1.5+, you can enable a debug logging mode to see the
    // underlying HTTP requests being made, as long as you're not using
    // a proxy server
    // $gp->enableRequestDebugLogging('/tmp/gp_requests.log');

    function getCurrentUrl()
    {
        return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    function getAuthSubUrl()
    {
        // the $next variable should represent the URL of the PHP script
        // an example implementation for getCurrentUrl is in the sample code
        $next = getCurrentUrl();
        $scope = 'https://picasaweb.google.com/data';
        $secure = false;
        $session = true;
        return Zend_Gdata_AuthSub::getAuthSubTokenUri($next, $scope, $secure,
            $session);
    }


    session_start();

    function getAuthSubHttpClient()
    {
        if (!isset($_SESSION['sessionToken']) && !isset($_GET['token']) ){
            echo '<a href="' . getAuthSubUrl() . '">Login!</a>';
            exit;
        } else if (!isset($_SESSION['sessionToken']) && isset($_GET['token'])) {
            $_SESSION['sessionToken'] =
                Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
        }
        $client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
        return $client;
    }
    // update the second argument to be CompanyName-ProductName-Version
    $gp = new Zend_Gdata_Photos(getAuthSubHttpClient(), "Google-DevelopersGuide-1.0");

    // In version 1.5+, you can enable a debug logging mode to see the
    // underlying HTTP requests being made, as long as you're not using
    // a proxy server
    // $gp->enableRequestDebugLogging('/tmp/gp_requests.log');

    function getAlbums($user, $pass)
    {
        $serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);

        // update the second argument to be CompanyName-ProductName-Version
        $gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");

        try {
            $userFeed = $gp->getUserFeed("default");
            foreach ($userFeed as $userEntry) {
                echo $userEntry->title->text . "<br />\n";
            }
        } catch (Zend_Gdata_App_HttpException $e) {
            echo "Error: " . $e->getMessage() . "<br />\n";
            if ($e->getResponse() != null) {
                echo "Body: <br />\n" . $e->getResponse()->getBody() .
                    "<br />\n";
            }
            // In new versions of Zend Framework, you also have the option
            // to print out the request that was made.  As the request
            // includes Auth credentials, it's not advised to print out
            // this data unless doing debugging
            // echo "Request: <br />\n" . $e->getRequest() . "<br />\n";
        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getMessage() . "<br />\n";
        }
    }

    function insertAlbum($gp)
    {
        $entry = new Zend_Gdata_Photos_AlbumEntry();
        $entry->setTitle($gp->newTitle("Test Album"));
        $entry->setSummary($gp->newSummary("This is an album."));

        $createdEntry = $gp->insertAlbumEntry($entry);
    }
    insertAlbum($gp);
    getAlbums($user, $pass);
?>