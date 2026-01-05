<?php
namespace App\Classes\Files;

interface ImageInterface{
    public function get_pixel(int $x, int $y);

    public function get_size();

    public static function create_file(int $width, int $heigh, string $path);

    public function colour_at(int $x, int $y);

    public function set_char_at(int $x, int $y, $true_colour, string $char, int $font=1);

    public function overwrite_file(): void;
}
