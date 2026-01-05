<?php
	namespace App\Classes\Files;

  use App\Classes\Exceptions\InvalidFileType;

class GIF extends Image {
  
  public function __construct($file_path){
	
		parent::__construct($file_path);
		if($this->type != "gif"){
      throw new InvalidFileType("Invalid file type {$this->type}. GIF needed.");
    }
    $gif = imagecreatefromgif($this->path);

    $width  = imagesx($gif);
    $height = imagesy($gif);

    $this->data = imagecreatetruecolor($width, $height);
    imagecopy($this->data, $gif, 0, 0, 0, 0, $width, $height);
  }

  public static function create_file(int $width, int $height, string $path){
    $image =  imagecreatetruecolor($width, $height);
    imagegif($image, $path);
  }

  public function overwrite_file(): void{
    $status =  imagetruecolortopalette($this->data, true, 256);
    if(!$status){
      die(var_dump($status));
    }
    imagegif($this->data,  $this->path);
  }
    
  public function colour_at(int $x, int $y){
    $rgb = imagecolorat($this->data, $x, $y);
    $this->rgb_to_palette($rgb);
  }

  public function rgb_to_palette($true_colour){
    $r = ($true_colour >> 16) & 0xFF;
    $g = ($true_colour >> 8) & 0xFF;
    $b = $true_colour & 0xFF;
    return imagecolorallocate($this->data, $r, $g, $b);
  }

  public function set_char_at(int $x, int $y, $true_colour, string $char, int $font=1){
    imagechar($this->data, $font, $x, $y, $char, $true_colour);
  }

}
