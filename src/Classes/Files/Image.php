<?php

namespace App\Classes\Files;

use GdImage;
use App\Classes\Pixel\Pixel;
use App\Classes\Ascii;
use Exception;

abstract class Image extends File implements ImageInterface{
    
    protected GdImage $data;

    public function get_pixel(int $x, int $y)
    {
        throw new \Exception('Not implemented');
    }

    public function get_size() :string
    {
        return "x: {$this->get_x_size()} By Y:{$this->get_y_size()}";
    }

    public function get_x_size() :int
    {
       return imagesx($this->data);
    }
    
    public function get_y_size() :int
    {
       return imagesy($this->data);
    }

    public function get_data(): GdImage{
        return $this->data;
    }

    public static function create_file(int $heigh, int $width, string $path){
        throw new Exception("Method Create File not added to Class");
    }

    public function color_at(int $x, int $y){
      throw new Exception("Method Create File not added to Class");
      return imagecolorat($this->data, $x, $y);
    }
}
