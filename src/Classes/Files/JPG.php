<?php 
namespace App\Classes\Files;
use App\Classes\Exceptions;
use App\Classes\Exceptions\InvalidFileType;
use GdImage;

class JPG extends Image{

    public function __construct($file_path) {

        parent::__construct($file_path);
       
       if($this->type != "jpg" && $this->type != "jgep"){
            throw new InvalidFileType("Invalid file type {$this->type}. JPG or JPEG needed.");
       }

       $this->data = imagecreatefromjpeg($this->path);
    }

    public static function create_file(int $width, int $height, string $path){
        $image =  imagecreatetruecolor($width, $height);
        imagejpeg($image, $path);
    }

    public function overwrite_file(): void{
        imagejpeg($this->data,  $this->path);
    }

    public function colour_at(int $x, int $y){
      return imagecolorat($this->data, $x, $y);
    }

    public function set_char_at(int $x, int $y, $true_colour, string $char, int $font=1){
      imagechar($this->data, $font, $x, $y, $char, $true_colour);
    }
}
