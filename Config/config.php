<?php
    /* PHP DEBUG */
    //error_reporting(E_ERROR | E_WARNING | E_PARSE);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /* Setup the correct timezone */
    date_default_timezone_set("Australia/Sydney");

    /* Start the session */
    session_start();

    /* Setup Error Handling */
    set_error_handler(array((new Matheos\App\Error), "errorHandler"));
    set_exception_handler(array((new Matheos\App\Error), "exceptionHandler"));
    register_shutdown_function(array((new Matheos\App\Error), "shutdownHandler"));
