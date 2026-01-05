<?php

namespace App\Classes;

use App\Classes\Pixel\Pixel;
use App\Classes\Config;
use App\Classes\Files\Image;
use App\Classes\Files\JPG;
use Exception;

class Ascii{

    protected string $characters;

    protected int  $no_of_chars;

    protected array $char_index;

    protected int $font = Config::Font;

    public int $font_width;

    public int $font_height;


    public function __construct()
    {
        if(Config::PIXEL_CHARS == null ){
            throw new Exception("Config::PIXEL_CHARS has no value");
        }
        if($this->font == null ){
            throw new Exception("Config::Font has no value");
        }

        $this->characters = Config::PIXEL_CHARS;
        $this->no_of_chars = strlen($this->characters);
        $this->char_index = array_reverse(str_split($this->characters));
        $this->font_width = imagefontwidth($this->font);
        $this->font_height = imagefontheight($this->font);
    }

    public function nomalize_pixel(Pixel $pixel) :string{
        $brightness = ($pixel->r + $pixel->g + $pixel->b) / 3;
        $brightness = $brightness / 255;
        $index = round(($this->no_of_chars - 1) * $brightness);
        return $this->char_index[$index];
    }

    public function image_to_ascii(Image $src_image, Image $dest_image){
        $max_x = $src_image->get_x_size();
        $max_y = $src_image->get_y_size();
       
        if(Config::backlit){
            $white = imagecolorallocate($dest_image->get_data(), 127, 127, 127);
            imagefill($dest_image->get_data(), 0, 0,  $white);
        }
        
        for( $x = 0; $x < $max_x; $x++){
            for( $y = 0; $y < $max_y; $y++){
                $rgb = $src_image->colour_at($x, $y); //3 Byte colour value 10101010 | 10101010 | 10101010 RGB
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $pixel = new Pixel($x, $y, $r, $g, $b);
                $char = $this->nomalize_pixel($pixel);
                $dest_image->set_char_at($this->font_width * $x, $this->font_height * $y, $rgb, $char, $this->font);            
            }
        }
        $dest_image->overwrite_file();
    }

}
