<?php

Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;


});

Flight::route('GET /test/doctors', function() {
    
    $doctorDao = new DoctorDao();

    $doctors = $doctorDao->getAllDoctors();

    
    echo '<pre>';
    print_r($doctors);
    echo '</pre>';
});



Flight::start();
?>