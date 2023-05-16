<?php

include 'classes/connection.php' ;
include 'classes/User.php' ;
include 'classes/postIdea.php' ;
include 'classes/postProb.php' ;

session_start();

global $pdo;

define("BASE_URL" , "http://localhost/01_ideaStorager/");