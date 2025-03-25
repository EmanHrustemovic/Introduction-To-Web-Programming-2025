<?php

Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;


});







?>