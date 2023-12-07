<?php

    //$database= new mysqli("localhost","root","","edoc");
    //if ($database->connect_error){
      //  die("Connection failed:  ".$database->connect_error);
    //}

    $database= new mysqli("sql200.infinityfree.com","if0_35566373","7DqWUAC3Zq4","if0_35566373_edoc");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }
?>
