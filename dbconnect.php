<?php
    $server = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "twitter";

    $mysqli = new mysqli("$server", "$dbUserName", "$dbPassword", "$dbName");

    if($mysqli -> connect_errno){
        echo $mysqli -> connect_error;
        exit();
    }

    function encryption($str){
        $str = md5("DFG^&65767" . $str . "%^%$$#sddfdsDDFRR" . $str);
        return $str;
    }
    // include , include_once , require , require_once
?>