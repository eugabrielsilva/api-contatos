<?php
    use Glowie\Core\Application;

    /*
        --------------------------------
        Application index
        --------------------------------
        This file is responsible for loading Composer packages and running Glowie bootstrapper.

        ---------------------------------------------
        We do not recommend editing below this line.
        ---------------------------------------------
    */

    // Check Composer files
    if(!file_exists('../../vendor/autoload.php')){
        die('<strong>Composer packages were not found!</strong><br>
        Have you tried running <i>composer install</i>?');
    }

    // Load Composer packages
    require('../../vendor/autoload.php');

    // Run Glowie bootstrapper
    Application::run();
    
?>