<?php
    if (getenv('APP_ENV') === 'dev') {
        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    } else {
        error_reporting(0);
    }
 
    $maxlifetime = 1000000000;
    $secure = True;
    $httponly = True;
    $samesite = 'None';
    session_set_cookie_params([
        'lifetime' => $maxlifetime,
        'path' => '/',
        //'secure' => $secure,
        //'samesite' => $samesite
    ]);
    session_start();
    
    $XOR_KEY = getenv('XOR_KEY');

    include_once( $_SERVER["DOCUMENT_ROOT"] . '/libs/helper.php' );
    include_once( $_SERVER["DOCUMENT_ROOT"] . '/libs/database.php' );
 
    function validate($array) {
        foreach($array as $data) {
            if (gettype($data) !== 'string')
                die("Hack detected");
            elseif (strpos($data, "'") !== False)
                die("Hack detected");
        }
    }

    // Validate untrusted data
    validate($_POST);
    validate($_GET);
