<?php

require_once __DIR__."/vendor/autoload.php";
use App\Classes\Files\File;
use function App\Classes\Files\validate_file;
use function App\Utils\get_env;
use function App\Utils\create_file;
use function App\Utils\get_file;
use App\Classes\Exceptions\InvalidFileType;
use App\Classes\Files\JPG;
use App\Classes\Files\PNG;
use App\Classes\Files\GIF;
use App\Classes\Exceptions\FileNotFound;
use App\Classes\Ascii;



function main($argv): int {

  $source_file_path = isset($argv[1]) ? $argv[1]: null;

  if(!$source_file_path){
      throw new ArgumentCountError("Needs file source argument");
  }

  $dest_file_path = isset($argv[2]) ? $argv[2]: null;

  if(!$dest_file_path){
      throw new ArgumentCountError("Needs file destination argument");
  }
	
  if(!is_file($source_file_path)){  
    throw new FileNotFound("file not found at ${source_file_path}");
  }

  $source_file = get_file($source_file_path);

	$service = new Ascii;
  $height = $service->font_height * $source_file->get_y_size();
  $width = $service->font_width * $source_file->get_x_size(); 

  $dest_file = create_file($dest_file_path, $width, $height); 
  
	$service->image_to_ascii($source_file, $dest_file);
	print("Ascii image created successfully at {$dest_file_path}");
	return 0;
}

main($argv);

