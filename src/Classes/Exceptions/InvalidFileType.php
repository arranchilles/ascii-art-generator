<?php 
    namespace App\Classes\Exceptions;
    use Exception;

    class InvalidFileType extends Exception {

        protected $message = "The file type used in not valid.";
        
    }