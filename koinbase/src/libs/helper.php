<?php
    function checkLoginRedirectToHome() {
        if (isset($_SESSION['username'])) {
            die(header("Location: /?page=1"));
        }
    }

    function checkNotLoginRedirectToAuth() {
        if (!isset($_SESSION['username'])) {
            die(header("Location: /auth.php"));
        }
    }

    function checkNotLoginReturnError() {
        if (!isset($_SESSION['username'])) {
            echo msgToJSON(403, "Please login first");
            die();
        }
    }

    function xorString($string, $key) {
        for($i = 0; $i < strlen($string); $i++) 
            $string[$i] = ($string[$i] ^ $key[$i % strlen($key)]);
        return $string;
    }

    function msgToJSON($stt, $msg) {
        return json_encode(["status_code" => $stt, "message" => $msg]);
    }

?>