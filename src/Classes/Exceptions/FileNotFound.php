<?php
namespace App\Classes\Exceptions;
use RuntimeException;

class FileNotFound extends RuntimeException{
    protected $message = "File not found.";
}