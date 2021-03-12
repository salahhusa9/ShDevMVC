<?php
    $connect = mysqli_connect(
        $configApp['database']['host'],
        $configApp['database']['username'],
        $configApp['database']['password'],
        $configApp['database']['database'],
    );
    
    if(mysqli_connect_error()){
        die("error:". mysqli_connect_error());
    }
?>