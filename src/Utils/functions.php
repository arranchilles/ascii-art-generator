<?php
namespace App\Utils;

use App\Classes\Files\JPG;
use App\Classes\Files\PNG;
use App\Classes\Files\GIF;
use App\Classes\Files\Image;


function get_env(string $file_path): array | bool{
	if(!check_file_type($file_path, "env")){
		return false; 
	}
	$dir_path = pathinfo($file_path)["dirname"];	
	$dotenv = \Dotenv\Dotenv::createImmutable($dir_path);
	$dotenv->load();
	return $_ENV;
}

function check_file_type(string $file_path, string $file_type) :bool{
	return is_file($file_path) && pathinfo($file_path)['extension'] == $file_type;
}

function create_file(string $path, int $width, int $height): Image{
  
  $type = pathinfo($path)["extension"];

  switch($type){
    case "jpg":
      JPG::create_file($width, $height, $path);
			$file = new JPG($path);
		break;

    case "png":
      PNG::create_file($width, $height, $path);
			$file = new PNG($path);
		break;

    case "gif":
      GIF::create_file($width, $height, $path);
      $file = new GIF($path);
		break;

		default:
			throw new InvalidFileType;

  }

  return $file;
}

function get_file($file_path){

  $file_type = pathinfo($file_path)["extension"];

  switch($file_type){
    
    case "jpg":
    case "jpeg":
      
      return new JPG($file_path);
    
    case "png":

      return new PNG($file_path);

    case "gif":

      return new GIF($file_path);

    default:
      throw new InvalidFileType;
  }
}
