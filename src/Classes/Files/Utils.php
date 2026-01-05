<?php 

namespace App\Classes\Files;
use App\Classes\Exceptions\InvalidFileType;
use App\Classes\Config;

function validate_file(File $file) :bool{	

	$type = $file->get_type();
	if(Config::VALID_FILE_TYPE == null || !is_array(Config::VALID_FILE_TYPE)){
		throw new InvalidFileType("No file types set in .env VALID_FILE_TYPE.");	
	}

	if(!in_array($type, Config::VALID_FILE_TYPE)){
		throw new InvalidFileType("The file has a type that is not in the Config::VALID_FILE_TYPE.");	
	}
	return true;
}
